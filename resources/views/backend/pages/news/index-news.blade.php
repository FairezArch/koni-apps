@extends('backend.master')
@section('title', '- Berita')
@section('content')
    <div class="container-fluid">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @can('news-topnews-list')
                    <a class="nav-item nav-link active" id="nav-topnews-tab" data-toggle="tab" href="#nav-topnews" role="tab"
                        aria-controls="nav-topnews" aria-selected="true">Jadwal Berita</a>
                @endcan
                @hasanyrole('superadmin|koni|humaskoni')
                    <a class="nav-item nav-link" id="nav-requestnews-tab" data-toggle="tab" href="#nav-requestnews" role="tab"
                        aria-controls="nav-requestnews" aria-selected="false">
                        Request Berita
                        <span class="notif-circle"></span>
                    </a>
                @else
                @endhasanyrole
                @can('news-newsscheduled-list')
                    <a class="nav-item nav-link" id="nav-newsscheduled-tab" data-toggle="tab" href="#nav-newsscheduled"
                        role="tab" aria-controls="nav-newsscheduled" aria-selected="false">Semua Berita</a>
                @endcan
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @can('news-topnews-list')
                <div class="tab-pane fade show active" id="nav-topnews" role="tabpanel" aria-labelledby="nav-topnews-tab">
                    <div class="wrapper-table p-3 bg-white rounded">
                        <div class="w-100 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-2">Tanggal</div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                value="{{ \Carbon\Carbon::today()->startOfMonth()->format('Y-m-d') }}"
                                                    name="datefrom-topnews" id="datefrom-topnews"
                                                    class="datefrom date-picker input_text_custom rounded datefrom-topnews filter-dataTable">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                    value="{{ \Carbon\Carbon::today()->startOfMonth()->copy()->endOfMonth()->format('Y-m-d') }}"
                                                    name="dateto-topnews" id="dateto-topnews"
                                                    class="dateto date-picker input_text_custom rounded dateto-topnews filter-dataTable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    Kategori
                                    <select name="category_select-topnews" id="category_select-topnews"
                                        class="category_select category_select-topnews select_custom filter-dataTable w-50">
                                        <option value="all">Semua</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 text-right">
                                    @can('news-topnews-create')
                                        <a class="btn btn-danger" href="{{ url('tidings/1/create') }}">Tambah berita</a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped dataTable_topnews" id="dataTable_topnews">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Pembuat</th>
                                        <th>Status</th>
                                        <th class="text-center">Kelola</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
            @hasanyrole('superadmin|koni|humaskoni')
                <div class="tab-pane fade" id="nav-requestnews" role="tabpanel" aria-labelledby="nav-requestnews-tab">
                    <div class="wrapper-table p-3 bg-white rounded">
                        <div class="w-100 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-2">Tanggal</div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                    value="{{ \Carbon\Carbon::today()->startOfMonth()->format('Y-m-d') }}"
                                                    name="datefrom-requestnews" id="datefrom-requestnews"
                                                    class="datefrom datefrom-requestnews date-picker input_text_custom rounded filter-dataTable">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                    value="{{ \Carbon\Carbon::today()->startOfMonth()->copy()->endOfMonth()->format('Y-m-d') }}"
                                                    name="dateto-requestnews" id="dateto-requestnews"
                                                    class="dateto dateto-requestnews date-picker input_text_custom rounded filter-dataTable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    Kategori
                                    <select name="category_select-requestnews" id="category_select-requestnews"
                                        class="category_select category_select-requestnews select_custom filter-dataTable w-50">
                                        <option value="all">Semua</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 text-right">
                                    <a class="btn btn-danger" href="{{ url('tidings/4/create') }}">Tambah berita</a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped dataTable_requestnews" id="dataTable_requestnews">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Pembuat</th>
                                        <th>Status</th>
                                        <th class="text-center">Kelola</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
            @endhasanyrole
            @can('news-newsscheduled-list')
                <div class="tab-pane fade" id="nav-newsscheduled" role="tabpanel" aria-labelledby="nav-newsscheduled-tab">
                    <div class="wrapper-table p-3 bg-white rounded">
                        <div class="w-100 mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="row">
                                        <div class="col-md-2">Tanggal</div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                    value="{{ \Carbon\Carbon::today()->startOfMonth()->format('Y-m-d') }}"
                                                    name="datefrom-newsscheduled" id="datefrom-newsscheduled"
                                                    class="datefrom datefrom-newsscheduled date-picker input_text_custom rounded filter-dataTable">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="position-relative">
                                                <input type="date"
                                                    value="{{ \Carbon\Carbon::today()->startOfMonth()->copy()->endOfMonth()->format('Y-m-d') }}"
                                                    name="dateto-newsscheduled" id="dateto-newsscheduled"
                                                    class="dateto dateto-newsscheduled date-picker input_text_custom rounded filter-dataTable">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    Kategori
                                    <select name="category_select-newsscheduled" id="category_select-newsscheduled"
                                        class="category_select category_select-newsscheduled select_custom filter-dataTable w-50">
                                        <option value="all">Semua</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 text-right d-none">
                                    @can('news-newsscheduled-create')
                                        <a class="btn btn-danger" href="{{ url('tidings/2/create') }}">Tambah berita</a>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-hover table-striped dataTable_newsscheduled" id="dataTable_newsscheduled">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Pembuat</th>
                                        <th>Status</th>
                                        <th class="text-center">Kelola</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@section('script-footer')
    <script>
        function firstTab() {

            let dateFrom = $('#datefrom-topnews').val(),
                dateTo = $('#dateto-topnews').val(),
                categoryNews = $('#category_select-topnews').val(),
                select = 1;

            let table = $('#dataTable_topnews').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    "url": "{{ route('tidings.index') }}",
                    "type": "GET",
                    "data": (d) => {
                        d.select = select;
                        d.dateFrom = dateFrom;
                        d.dateTo = dateTo;
                        d.categoryNews = categoryNews;
                        return d;
                    }
                },
                columns: [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        orderable: false
                    },
                    {
                        data: 'created',
                        name: 'created',
                        render: (dataField) => {
                            return dataField.replace("|###|", "<br/>");
                        },
                        orderable: false
                    },
                    {
                        data: 'showTime',
                        name: 'showTime',
                        render: (dataField) => {
                            return dataField.replace("|###|", " - ");
                        },
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        render: (dataField) => {
                            return `
                            @can('news-topnews-edit')
                                <a href="{{ url('tidings/`+dataField+`/edit/1') }}" class='edit m-1'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                </a>
                            @endcan
                            @can('news-topnews-delete')
                                <a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +dataField + `">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                        <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                    </svg> 
                                </a>
                            @endcan`;
                        }
                    },
                ]
            });

            $('.filter-dataTable').on('change', function() {
                dateFrom = $('#datefrom-topnews').val();
                dateTo = $('#dateto-topnews').val();
                categoryNews = $('#category_select-topnews').val();
                table.ajax.reload(null, false);
            })

            $('body').on('click', '.delete-record', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let id = $(this).data("id");
                        let url = "{{ route('tidings.index') }}";
                        $.ajax({
                            url: url + '/' + id,
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(res) {
                                if (res.success) {
                                    table.draw();
                                } else {
                                    alert(res.message);
                                }
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not deleted', '', 'info')
                    }
                });
            })
        }

        $(document).ready(function() {
            firstTab()
            // $('.notif-circle').hide();
            let timeOutId = 0;
            let notif = function () {
                $.ajax({
                    "url": "{{ route('tindings.notif', 4) }}",
                    "type": "GET",
                    success: function(res) {
                        if(res.success){
                            timeOutId = setTimeout(function(){notif()}, 10000);
                            if(res.value){
                                $('.notif-circle').text(res.value).show();
                            }else{
                                $('.notif-circle').hide();
                            }
                        }else{
                            clearTimeout(timeOutId);
                            $('.notif-circle').hide()
                        }
                    }
                })
            }

            notif();
        //     timeOutId = setTimeout(function(){
        //         notif();
        //    }, 10000);
        })

        $('#nav-topnews-tab').click(function(e) {
            firstTab()
        })
        $('#nav-newsscheduled-tab').click(function(e) {
            let dateFrom = $('#datefrom-newsscheduled').val(),
                dateTo = $('#dateto-newsscheduled').val(),
                categoryNews = $('#category_select-newsscheduled').val(),
                select = null;

            let table = $('#dataTable_newsscheduled').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    "url": "{{ route('tidings.index') }}",
                    "type": "GET",
                    "data": function(d) {
                        d.select = select;
                        d.dateFrom = dateFrom;
                        d.dateTo = dateTo;
                        d.categoryNews = categoryNews;
                        return d;
                    }
                },
                columns: [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        orderable: false
                    },
                    {
                        data: 'created',
                        name: 'created',
                        render: (dataField) => {
                            return dataField.replace("|###|", "<br/>");
                        },
                        orderable: false
                    },
                    {
                        data: 'showTime',
                        name: 'showTime',
                        render: (dataField) => {
                            return dataField.replace("|###|", " - ");
                        },
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        render: (dataField) => {
                            return `
                            @can('news-newsscheduled-edit')
                                <a href="{{ url('tidings/`+dataField+`/edit/2') }}" class='edit m-1 d-none'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                </a>
                            @endcan
                            @can('news-newsscheduled-delete')
                                <a id="delete-record" class='edit m-1 border-0 delete-record' data-id="` +dataField + `">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                        <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                    </svg> 
                                </a>
                            @endcan
                            `;
                        }
                    },
                ]
            });

            $('.filter-dataTable').on('change', function() {
                dateFrom = $('#datefrom-newsscheduled').val();
                dateTo = $('#dateto-newsscheduled').val();
                categoryNews = $('#category_select-newsscheduled').val();
                table.ajax.reload(null, false);
            })
            $('body').on('click', '.delete-record', function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let id = $(this).data("id");
                        let url = "{{ route('tidings.index') }}";

                        $.ajax({
                            url: url + '/' + id,
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(res) {
                                if (res.success) {
                                    table.draw();
                                } else {
                                    alert(res.message);
                                }
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not deleted', '', 'info')
                    }
                });
            })
        })
        $('#nav-requestnews-tab').click(function(e) {
            let dateFrom = $('#datefrom-requestnews').val(),
                dateTo = $('#dateto-requestnews').val(),
                categoryNews = $('#category_select-requestnews').val(),
                select = 4;
            let table = $('#dataTable_requestnews').DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ajax: {
                    "url": "{{ route('tidings-request.index') }}",
                    "type": "GET",
                    "data": function(d) {
                        d.select = select;
                        d.dateFrom = dateFrom;
                        d.dateTo = dateTo;
                        d.categoryNews = categoryNews;
                        return d;
                    }
                },
                columns: [
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category',
                        name: 'category',
                        orderable: false
                    },
                    {
                        data: 'created',
                        name: 'created',
                        render: (dataField) => {
                            return dataField.replace("|###|", "<br/>");
                        },
                        orderable: false
                    },
                    {
                        data: 'showTime',
                        name: 'showTime',
                        render: (dataField) => {
                            return dataField.replace("|###|", " - ");
                        },
                        orderable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                        render: (dataField) => {
                            return `
                            @can('news-requestnews-edit')
                                <a href="{{ url('tidings/`+dataField+`/edit/4') }}" class='edit m-1 pointer'><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                    </svg>
                                </a>
                               
                            @endcan
                            @can('news-requestnews-delete')
                                <a id="delete-record" class='edit m-1 border-0 delete-record pointer' data-id="` +dataField + `">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                        <path d="M14 3a.702.702 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.703.703 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2zM3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5c-1.954 0-3.69-.311-4.785-.793z" />
                                    </svg 
                                </a>
                            @endcan
                            `;
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
                Swal.fire({
                    icon: 'warning',
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        let id = $(this).attr("data-id");
                        let url = "{{ route('tidings.index') }}";

                        $.ajax({
                            url: url + '/' + id,
                            type: 'DELETE',
                            dataType: 'json',
                            success: function(res) {
                                if (res.success) {
                                    table.draw();
                                } else {
                                    alert(res.message);
                                }
                            }
                        })
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not deleted', '', 'info')
                    }
                });
            })
            $('.filter-dataTable').on('change', function() {
                dateFrom = $('#datefrom-requestnews').val();
                dateTo = $('#dateto-requestnews').val();
                categoryNews = $('#category_select-requestnews').val();
                table.ajax.reload(null, false);
            })
        })
    </script>
@endsection
@endsection
