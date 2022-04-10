@extends('tempelate.main')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection

@section('Content')
    <div class="container">

        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-layers text-primary"></i>
                    </span>
                    <h3 class="card-label">Daftar Kegiatan</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder" id="tambahkegiatan" data-toggle="modal"
                        data-target="#modalSaya">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Tambah Kegiatan</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table id="tabel" cellspacing="0"
                    class="table display table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
                    <thead>
                        <tr>
                            <th>ID BS</th>
                            <th>Jumlah BS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--begin::Modal-->
    <div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="/kegiatan/create" method="POST" class="was-validated">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nama Kegiatan</label>
                            <input type="T_nmkeg" name="nmkeg" class="form-control" required>
                        </div>
                        <div class="form-group mb-1">
                            <label for="exampleTextarea">Daftar IDBS (pisahkan dengan enter)
                                <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="listbs" id="T_list_bs" rows="3" style="height: 324px;" placeholder="                                7604020003005B
                                7604020009032B
                                7604020003038B
                                ....." required></textarea>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            getalldata();
        });


        function modaledit(id) {
            // var data = $.get("http://petawi.test/getkegiatanbyid/" + id, function() {

            // })

            $.getJSON('http://petawi.test/getkegiatanbyid/' + id, function(data) {
                // console.log(data);
                obj = JSON.parse(data);
                console.log(obj.nmkeg);
                // var string1 = JSON.stringify(data);
                // var obj = JSON.parse(string1);

                // // Accessing individual value from JS object
                // alert(obj.nmkeg); // Outputs: Peter
                // alert(obj.age); // Outputs: 22
                // alert(obj.country); // Outputs: United States
            });

            // list_bs =
            // $('#T_list_bs').text(data['list_bs']);
            // $('#T_nmkeg').text(nmkeg);
        }

        $('#tambahkegiatan').click(function() {
            $('#T_list_bs').text("");
            $('#T_nmkeg').text("");
        });


        function getalldata() {

            var myTable = $('#tabel').DataTable({
                processing: true,
                serverSide: true,
                "scrollX": true,
                "columnDefs": [{
                    "width": "100px",
                    "targets": "_all"
                }],
                scrollCollapse: true,
                ajax: "/kegiatan-tabel",

                columns: [{
                        data: 'nmkeg',
                        name: 'nmkeg',

                    },
                    {
                        data: 'jml_bs',
                        name: 'jml_bs',

                    },
                    {
                        data: 'idkeg',
                        name: 'idkeg',
                        "orderable": false,
                        render: function(data, type, row) {
                            return `<a href="/cetak/` + row.idkeg + `" class="btn btn-primary btn-sm" style="margin-right:7px;width:70px">Cetak</a>
                                    <a id="asasas" onclick="modaledit(` + row.idkeg + `)" data-toggle="modal" data-target="#modalSaya" class="btn btn-warning btn-sm" style="margin-right:7px;width:70px">Edit</a>
                                    <a href="/kegiatan/` + row.idkeg + `/delete" class="btn btn-danger btn-sm" style="margin-right:7px;width:70px">Hapus</a>
                                    `
                        }
                    }

                ]
            });

        }
    </script>
@stop
