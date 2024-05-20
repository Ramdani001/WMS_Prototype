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
                                    <th width="40px">No</th>
                                    <th>Nomor PO</th>
                                    <th>Customer</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total Harga</th>
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
                { data: "harga", name: "harga" },
                { data: "action", name: "action", searchable: "false", orderable: "false" }
            ],
            order: [[ 1, "asc" ]],
        });
    });

</script>
@endsection