@extends('tempelate.main')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('Content')
    <div class="container">
        <!--begin::Notice-->

        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-layers text-primary"></i>
                    </span>
                    <h3 class="card-label">Daftar Semua Peta WB-2020</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
                        <i class="flaticon-technology"></i>Cetak Semua</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table id="tabel"  cellspacing="0" class="table display table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>ID BS</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Desa/Kelurahan</th>
                            <th>Blok Sensus</th>
                            <th>Cetak</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            getalldata();
        });


        function getalldata() {

            var myTable = $('#tabel').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                scrollCollapse: true,
                ajax: "/petawb",

                columns: [{
                        data: 'idbs',
                        name: 'idbs',

                    },
                    {
                        data: 'nmprov',
                        name: 'nmprov'
                    },
                    {
                        data: 'nmkab',
                        name: 'nmkab'
                    },
                    {
                        data: 'nmkec',
                        name: 'nmkec'
                    },
                    {
                        data: 'nmdesa',
                        name: 'nmdesa'
                    },
                    {
                        data: 'kdbs',
                        name: 'kdbs'
                    },
                    {
                        data: 'idbs',
                        name: 'idbs',
                        "orderable": false,
                        render: function(data, type, row) {
                            return `<a href="/cetak/` + row.idbs +`" class="btn btn-warning btn-sm" style="margin-right:7px;width:70px">Lihat</a>
                                    <a href="/cetak/` + row.idbs  +`" class="btn btn-primary btn-sm"style="margin-right:7px;width:70px>Cetak</a>`
                        }
                    }

                ]
            });

        }
    </script>
@stop
