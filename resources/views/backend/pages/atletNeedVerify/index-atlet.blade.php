@extends('backend.master')
@section('title', '- Atlet Need')
@section('content')
<div class="container-fluid">
    <div class="wrapper-table p-3 bg-white rounded">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        <div class="table-responsive-sm">
            <table class="table table-hover table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Cabor</th> 
                        <th rowspan="2">Tempat Pelatihan dan status atlet</th>
                        <th colspan="3" class="text-center">Prestasi</th>
                        <th class="text-center" rowspan="2">Kelola</th>
                    </tr>
                    <tr>
                        <th>Internasional</th>
                        <th>Nasional</th>
                        <th>Daerah</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@section('script-footer')
<script type="text/javascript">
  $(function () {

    let table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('atlet-need-verif.index')}}",
        columns: [
            {data: 'name', 
            render: function (dataField) { 
                     return dataField.split("|###|").join("<br>");
                }, 
            name: 'name'
            },
            {data: 'cabor', 
            name: 'cabor'
            },
            {data: 'trainingplace',
            name: 'trainingplace'
            },
            {data: 'internasional', 
            name: 'internasional'
            },
            {data: 'nasional', 
            name: 'nasional'
            },
            {data: 'daerah', 
            name: 'daerah'
            },
            {data: 'action', orderable: false, searchable: false, 
                render: function(dataField){ 
                    return `@can('atlet-need-verification-edit')<a href="{{url('atlet-need-verif/`+dataField+`/edit')}}" class='edit m-1'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
                            </svg></a>@endcan`;
                } 
            },
        ]
    });
  });
</script>
@endsection
@endsection
