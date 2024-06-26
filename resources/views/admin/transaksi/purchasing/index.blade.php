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

</style>
@endsection

@section('content')
<div class="page-inner"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purchasing Order</h4>
                </div>
                <div class="card-body">

                    <div class="container d-flex flex-wrap justify-content-between">
                       <div class="text-width mb-3">
                        <label for="formFile" class="form-label pb-1">Customer</label>
                        <select name="id_customer" class="form-control" id="id_customer-form"></select>
                    </div>
                       {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">No 1-10</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="No. 1-10" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Nama Customer</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Nama Customer" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Email</label>
                            <input class="form-control" type="email" value="" aria-label="readonly input example" placeholder="Alamat Email" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Alamat</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Alamat" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Kode Pos</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Kode Pos" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Kota</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Kota" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Nama Lengkap</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Provinsi" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Kelurahan</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Kelurahan" readonly>
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Kecamatan</label>
                            <input class="form-control" type="text" value="" aria-label="readonly input example" placeholder="Kecamatan" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex flex-wrap justify-content-between">
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">No. PO</label>
                            <input class="form-control" type="text" value="" aria-label="No.PO" placeholder="No. PO" >
                        </div>
                        {{--  --}}
                        <div class="text-width mb-3">
                            <label for="formFile" class="form-label pb-1">Tanggal</label>
                            <input class="form-control" type="date" value="" aria-label=" input example" placeholder="Tanggal" >
                        </div>
                    </div>

                    <div class="container d-flex justify-content-end mt-3">
                        <button type="button" id="btn-add" class="btn btn-primary btn-md">
                            Tambah Data
                        </button>
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

        dt = $("#table-data").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.master.barang.scopeData') }}",
                type: "post"
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: "false", orderable: "false" },
                { data: "nama_barang", name: "nama_barang" },
                { data: "kode_barang", name: "kode_barang" },
                { data: "supplier", name: "supplier" },
                { data: "lokasi", name: "lokasi" },
                { data: "harga", name: "harga" },
                { data: "stok", name: "stok" },
                { data: "satuan", name: "satuan" },
                { data: "action", name: "action", searchable: "false", orderable: "false" }
            ],
            order: [[ 1, "asc" ]],
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

        $("body").on("click",".btn-edit",function(){
            $("#modalDataLabel").text("Ubah Data Barang");
            formLoading("#form-data","#modal-body",true);
            let key = $(this).data("key");
            $.ajax({
                url: "{{ route('admin.master.barang.detail') }}",
                type: "POST",
                data: {key:key},
                success:function(res){
                    $("#key-form").val(key);
                    $.each(res.data,function(k,v){
                        console.log(res.data);
                        if(k == 'id_gudang' && v !== '-'){
                            $gudangForm.append(`<option value="${v}" selected="selected">${res.data.gudang.nama_gudang}</option>`);
                        }
                        if(k == 'id_supplier' && v !== '-'){
                            $customerForm.append(`<option value="${v}" selected="selected">${res.data.supplier.kode_supplier} - ${res.data.supplier.nama_supplier}</option>`);
                        }
                        $(`#${k}-form`).val(v).trigger("change");
                    });
                },
                error:function(err, status, message){
                    response = err.responseJSON;
                    message = (typeof response != "undefined") ? response.message : message;
                    notif("danger","fas fa-exclamation","Notifikasi Error",message,"error");
                },
                complete:function(){
                    formLoading("#form-data","#modal-body",false);
                }
            });
            $("#modalData").modal("show");
        });

        $("body").on("click",".btn-delete",function(){
            let key = $(this).data("key");
            swal({
                title: "Apakah anda yakin?",
                text: "Data yang dihapus tidak akan bisa dikembalikan!",
                icon: "warning",
                buttons:{
                    cancel: {
                        visible: true,
                        text : 'Batal',
                        className: 'btn btn-danger'
                    },
                    confirm: {
                        text : 'Yakin',
                        className : 'btn btn-primary'
                    }
                }
            }).then((willDelete) => {
                if (willDelete) {
                    notifLoading("Jangan tinggalkan halaman ini sampai proses penghapusan selesai !");
                    $.ajax({
                        url: "{{ route('admin.master.barang.destroy') }}",
                        type: "POST",
                        data: {key:key},
                        success:function(res){
                            notif("success","fas fa-check","Notifikasi Progress",res.message,"done");
                            dt.ajax.reload(null, false);
                        },
                        error:function(err, status, message){
                            response = err.responseJSON;
                            message = (typeof response != "undefined") ? response.message : message;
                            notif("danger","fas fa-exclamation","Notifikasi Error",message,"error");
                        },
                        complete:function(){
                            setTimeout(() => {
                                loadNotif.close();
                            }, 1000);
                        }
                    });
                }
            });
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
</script>
@endsection