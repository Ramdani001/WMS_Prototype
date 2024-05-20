@extends('admin.layouts.app')

@section('content')
<div class="page-inner"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Purcashing Order</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-1"> 
                        <a href="{{ route('admin.transaksi.po.create') }}" type="button" class="btn btn-primary btn-md">
                            <span class="fa fa-plus"></span>&nbsp;&nbsp;Tambah Data
                        </a>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="table-data" width="100%" class="table table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th width="40px"><center>No</center></th>
                                    <th><center>Nomor PO</center></th>
                                    <th><center>Customer</center></th>
                                    <th><center>Tanggal</center></th>
                                    <th><center>Status</center></th>
                                    <th width="80px"><center>Aksi</center></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    var dt;
    $(document).ready(function() {

        dt = $("#table-data").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.transaksi.po.scopeData') }}",
                type: "post"
            },
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", searchable: "false", orderable: "false" },
                { data: "nomor_po", name: "nomor_po" },
                { data: "customer", name: "customer" },
                { data: "created_at", name: "created_at" },
                { data: "status_po", name: "status_po" },
                { data: "action", name: "action", searchable: "false", orderable: "false" }
            ],
            order: [[ 1, "asc" ]],
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
                        url: "{{ route('admin.transaksi.po.destroy') }}",
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
    });

</script>
@endsection