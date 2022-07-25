@extends('backend.master')
@section('title', '- Pengaturan Pelatih')
@section('content')
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @can('trainer-setting-list')
                <a class="nav-item nav-link active" id="nav-sectionone-tab" data-toggle="tab" href="#nav-sectionone" role="tab"
                aria-controls="nav-sectionone" aria-selected="true">Status Pelatih</a>
                <a class="nav-item nav-link" id="nav-sectionsecond-tab" data-toggle="tab" href="#nav-sectionsecond"
                role="tab" aria-controls="nav-sectionsecond" aria-selected="false">Sertifikat Profesi</a>
                <a class="nav-item nav-link" id="nav-sectionthree-tab" data-toggle="tab" href="#nav-sectionthree" role="tab"
                aria-controls="nav-sectionthree" aria-selected="false">Pendukung Pelatih</a>
                <a class="nav-item nav-link" id="nav-sectionfour-tab" data-toggle="tab" href="#nav-sectionfour" role="tab"
                aria-controls="nav-sectionfour" aria-selected="false">Tempat Melatih</a>
                @endcan
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-sectionone" role="tabpanel" aria-labelledby="nav-sectionone-tab">
                <div class="wrapper-table p-3 bg-white rounded">
                    <div class="w-100 mt-3 mb-3">
                        @can('trainer-setting-create')
                        <a class="btn btn-danger" href="{{route('setting-status-trainner.create')}}">Tambah Status</a>
                        @endcan
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-striped dataTable_sectionone" id="dataTable_sectionone">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center">Kelola</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-sectionsecond" role="tabpanel" aria-labelledby="nav-sectionsecond-tab">
                <div class="wrapper-table p-3 bg-white rounded">
                    <div class="w-100 mt-3 mb-3">
                        @can('trainer-setting-create')
                        <a class="btn btn-danger" href="{{route('setting-certificate-trainner.create')}}">Tambah Sertifikat Profesi</a>
                        @endcan
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-hover table-striped dataTable_sectionsecond" id="dataTable_sectionsecond">
                            <thead>
                                <tr>
                                    <th>Sertifikat</th>
                                    <th class="text-center">Kelola</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-sectionthree" role="tabpanel" aria-labelledby="nav-sectionthree-tab">
                <div class="wrapper-table p-3 bg-white rounded">
                    <div class="w-100 mt-3 mb-3">
                        @can('trainer-setting-create')
                        <a class="btn btn-danger" href="{{route('setting-support-trainner.create')}}">Tambah Support Profesi</a>
                        @endcan
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-hover table-striped dataTable_sectionthree" id="dataTable_sectionthree">
                            <thead>
                                <tr>
                                    <th>Support</th>
                                    <th class="text-center">Kelola</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-sectionfour" role="tabpanel" aria-labelledby="nav-sectionfour-tab">
                <div class="wrapper-table p-3 bg-white rounded">
                    <div class="w-100 mt-3 mb-3">
                        @can('trainer-setting-create')
                        <a class="btn btn-danger" href="{{route('training-place.create')}}">Tambah Tempat Latihan</a>
                        @endcan
                    </div>

                    <div class="table-responsive-sm">
                        <table class="table table-hover table-striped dataTable_sectionfour" id="dataTable_sectionfour">
                            <thead>
                                <tr>
                                    <th>Tempat Latihan</th>
                                    <th class="text-center">Kelola</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script-footer')
    <script>
        $(function() {
            $('#dataTable_sectionone').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: "{{ route('setting-status-trainner.index') }}",
                    columns: [{
                            data: 'status_trainner',
                            name: 'status_trainner'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(dataField) {

                                return `@can('trainer-setting-edit')<a href="{{ url('setting-status-trainner/`+dataField+`/edit') }}" class='edit m-1'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>@endcan
                                        @can('trainer-setting-delete')
                                        <a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +
                                    dataField + `" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg
                                        </a>@endcan`;
                            }
                        },
                    ]
            });

            $('#nav-sectionone-tab').click(function(e) {
                let table = $('#dataTable_sectionone').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: "{{ route('setting-status-trainner.index') }}",
                    columns: [{
                            data: 'status_trainner',
                            name: 'status_trainner'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(dataField) {

                                return `@can('trainer-setting-edit')<a href="{{ url('setting-status-trainner/`+dataField+`/edit') }}" class='edit m-1'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        @endcan
                                        @can('trainer-setting-delete')<a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +
                                    dataField + `" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg
                                        </a>@endcan`;
                            }
                        },
                    ]
                });

                $('body').on('click', '.delete-record', function(e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let id = $(this).data("id");
                    let url = "{{ route('setting-status-trainner.index') }}";

                    $.ajax({
                        url: url + '/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success == true) {
                                table.draw();
                            } else {
                                alert(res.message);
                            }
                        }
                    })
                })
            })
            $('#nav-sectionsecond-tab').click(function(e) {
                
                let table = $('#dataTable_sectionsecond').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: "{{ route('setting-certificate-trainner.index') }}",
                    columns: [{
                            data: 'certificate_name',
                            name: 'certificate_name'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(dataField) {

                                return `@can('trainer-setting-edit')<a href="{{ url('setting-certificate-trainner/`+dataField+`/edit') }}" class='edit m-1'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>@endcan
                                        @can('trainer-setting-delete')
                                        <a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +
                                    dataField + `" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg
                                        </a>@endcan`;
                            }
                        },
                    ]
                });

                $('body').on('click', '.delete-record', function(e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let id = $(this).data("id");
                    let url = "{{ route('setting-certificate-trainner.index') }}";

                    $.ajax({
                        url: url + '/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success == true) {
                                table.draw();
                            } else {
                                alert(res.message);
                            }
                        }
                    })
                })
            })
            $('#nav-sectionthree-tab').click(function(e) {

                let table = $('#dataTable_sectionthree').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: "{{ route('setting-support-trainner.index') }}",
                    columns: [{
                            data: 'support_name',
                            name: 'support_name'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(dataField) {

                                return `@can('trainer-setting-edit')<a href="{{ url('setting-support-trainner/`+dataField+`/edit') }}" class='edit m-1'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        @endcan
                                        @can('trainer-setting-delete')
                                        <a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +
                                    dataField + `" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg
                                        </a>@endcan`;
                            }
                        },
                    ]
                });
                $('body').on('click', '.delete-record', function(e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let id = $(this).data("id");
                    let url = "{{ route('setting-support-trainner.index') }}";

                    $.ajax({
                        url: url + '/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success == true) {
                                table.draw();
                            } else {
                                alert(res.message);
                            }
                        }
                    })
                })
            })
            $('#nav-sectionfour-tab').click(function(e) {

                let table = $('#dataTable_sectionfour').DataTable({
                    processing: true,
                    serverSide: true,
                    bDestroy: true,
                    ajax: "{{ route('training-place.index') }}",
                    columns: [{
                            data: 'place_name',
                            name: 'place_name'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false,
                            render: function(dataField) {

                                return `@can('trainer-setting-edit')<a href="{{ url('training-place/`+dataField+`/edit') }}" class='edit m-1 pointer'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>@endcan
                                        @can('trainer-setting-delete')
                                        <a id="delete-record" class='edit m-1 border-0 delete-record pointer' data-id="` +
                                    dataField + `" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                            <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                            </svg
                                        </a>@endcan`;
                            }
                        },
                    ]
                });
                $('body').on('click', '.delete-record', function(e) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    let id = $(this).data("id");
                    let url = "{{ route('training-place.index') }}";

                    $.ajax({
                        url: url + '/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success == true) {
                                table.draw();
                            } else {
                                alert(res.message);
                            }
                        }
                    })
                })
            })
        });
    </script>
@endsection
@endsection
