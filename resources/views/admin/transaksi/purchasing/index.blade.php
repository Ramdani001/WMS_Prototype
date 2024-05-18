@extends('admin.layouts.app')

@section('css')
<style>
    #btn-add, #btn-add-multiple {
        margin: 0px -10px 20px 15px;
    }
    .btn-group button {
        margin: 0px 4px;
    }
    .icon-big {
        font-size: 2.1em;
    }
    #pwInfo {
        font-style: italic;
        font-size: 12.5px;
    }
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
    .swal-text {
        text-align: center !important;
    }

    .text-width{
        width: 40%;
    }

    .menuList{
        display: none;
        height: 0;
    }

    .activeSub{
        background: #1572e8;
        color: red;
    }

    .activeSub:hover{
        background: #1572e8;
        color: black;
    }

    @keyframes listMenu {
        0% {
          height: 0;  
        }
        25%{
            height: 25%;
        }
        50%{
            height: 50%;
        }
        75%{
            height: 75%;
        }
        100% {
            height: 100%;
        }
    }

</style>
@endsection

@section('content')
<div class="page-inner"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah PO</h4>
                </div>
                <div class="card-body">

                   
                    <div class="container d-flex justify-content-end mt-3">
                        <a href="{{ route('admin.master.tambahPO.index') }}" type="button" class="btn btn-primary btn-md">
                            Tambah Data
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table id="table-data" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="40px">No</th>
                                    <th>Nama Barang</th>
                                    <th>Kode</th>
                                    <th>Supplier</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th width="80px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalData" role="dialog" aria-labelledby="modalDataLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <form id="form-data" method="post" action="{{ route('admin.master.purchasing.store') }}">
              @csrf
              <input type="hidden" name="key" class="form-control" id="key-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDataLabel">Detail</h5>
                </div>
                <div class="modal-body" id="modal-body">
                    <div class="table-responsive">
                        <table id="table-list" class="table table-bordered table-hover w-100" >
                            <thead>
                                <tr>
                                    <th width="40px">No</th>
                                    <th>Gudang</th>
                                    <th>Supplier</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th width="80px">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script>
    var dt;
    var $gudangForm = $("#id_gudang-form");
    var $customerForm = $("#id_customer-form");
    $(document).ready(function() {

        $customerForm.select2({
            placeholder:"Pilih Customer",
            allowClear:true,
            language: "id",
            ajax: {
                url: "{{route('admin.getSelectSupplier')}}",
                dataType: 'json',
                delay: 500,
                cache: true,
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (res) {
                    return {
                        results: $.map(res.data, function (item) {
                            id = `${item.id}`;
                            text = `${item.kode_customer} - ${item.nama_customer}`;
                            return {
                                id: id,
                                text: text
                            }
                        })
                    };
                },
                error: function (err, textStatus, errorThrown) {
                    message = err.responseJSON.message;
                    notif("danger","fas fa-exclamation","Notifikasi Error",message,"error");
                }
            }
        });

        dt = $("#table-list").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.master.purchasing.scopeList') }}",
                type: "post"
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: "false", orderable: "false" },
                { data: "gudang", name: "gudang" },
                { data: "supplier", name: "supplier" },
                { data: "nama_barang", name: "nama_barang" },
                { data: "stok", name: "stok" },
                { data: "harga", name: "harga" },
                { data: "action", name: "action", searchable: "false", orderable: "false" }
            ],
            order: [[ 1, "asc" ]],
        });

        $("#btn-add").on("click",function(){
            $("#modalDataLabel").text("List Barang Barang");
            $("#modalData").modal("show");
        });

        $("#modalData").on("hidden.bs.modal",function(){
            $("#password-form").prop("required",true);
            $("#pwInfo").addClass("hidden");
            if($("#key-form").val()) $("#form-data .form-control").val("");
        });

        $("#form-data").ajaxForm({
            beforeSend:function(){
                formLoading("#form-data","#modal-body",true,true);
            },
            success:function(res){
                dt.ajax.reload(null, false);
                notif("success","fas fa-check","Notifikasi Progress",res.message,"done");
                $("#form-data .form-control").val("")
                $("#modalData").modal("hide");
            },
            error:function(err, status, message){
                response = err.responseJSON;
                title = "Notifikasi Error";
                message = (typeof response != "undefined") ? response.message : message;
                if(message == "Error validation"){
                    title = "Error Validasi";
                    $.each(response.data, function(k,v){
                        message = v[0];
                        return false;
                    });
                }
                notif("danger","fas fa-exclamation",title,message,"error");
            },
            complete:function(){
                formLoading("#form-data","#modal-body",false);
            }
        });
    });

    function menuPO($e){
            console.log($e);
            $actived = 0;
            if($e){
                $('#menuPO').attr('onClick', 'menuPO(2)');
                $actived = 1;
            }else{
                $('#menuPO').attr('onClick', 'menuPO(1)');
            }

            if($actived == 1){
                $('#menuPO').addClass('active');
                $('#dropPO').toggle('menuList');
                $('#dropPO').addClass('active');
            }else{
                $('#menuPO').removeClass('active');
                $('#dropPO').addClass('menuList');
                $('#dropPO').removeClass('active');
            }
        }
</script>
@endsection