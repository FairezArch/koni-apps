@extends('frontend.master')
@section('title', '- Jadwal Pertandigan')
@section('content')
    <section class="range-p">
        <div class="container">
            <div class="top-filter text-right mb-3">
                <div class="row">
                    <div class="col-md-4 mt-2 mb-2">
                        <select name="sports_id" id="sports_id" class="form-control filter-match">
                            <option value="all">Semua</option>
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->sportbranch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 mb-2">
                        <select name="show_list" id="show_list" class="form-control filter-match">
                            <option value="1">Semua</option>
                            <option value="2">Akan datang</option>
                            <option value="3">Sedang Berlansung</option>
                        </select>
                    </div>
                    <div class="col-md-4 mt-2 mb-2">
                        <select name="year" id="year" class="form-control filter-match">
                            @foreach (range(\Carbon\Carbon::now()->format('Y'), 2014) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-hover table-striped" id="dataTable_front">
                    <thead>
                        <tr>
                            <th>PERTANDINGAN</th>
                            <th>TANGGAL</th>
                            <th>CABANG OLAHRAGA</th>
                            <th>TEMPAT PERTANDINGAN</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
              <img alt="image" class="img-thumbnail" />
          </div>
        </div>
      </div>
    </div>
@section('script-front')
    <script type="text/javascript">
        $(function() {
            let sports_id = $('#sports_id').val(),
                show_list = $('#show_list').val(),
                year_list = $('#year').val();

            let table_match = $('#dataTable_front').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('match-schedule') }}",
                    "type": "GET",
                    "data": function(d) {
                        d.sports_id = sports_id;
                        d.show_list = show_list;
                        d.year_list = year_list;
                        return d;
                    }
                },
                columns: [
                    {
                        data: 'match_names',
                        render: function(dataField) {
                            return dataField.split("|###|").join("<br />");
                        },
                        name: 'match_name'
                    },
                    {
                        data: 'date',
                        render: function(dataField) {
                            return dataField.split("|###|").join("-");
                        },
                        name: 'date'
                    },
                    {
                        data: 'sports_branch',
                        name: 'sports.sportbranch_name'
                    },
                    {
                        data: 'match_place',
                        name: 'match_place'
                    }
                ]
            });

            $('.filter-match').on('change', function() {
                sports_id = $('#sports_id').val();
                show_list = $('#show_list').val();
                year_list = $('#year').val();
                table_match.ajax.reload(null, false);
            });
        });
        
       
    </script>
    <script>
        
        function documentLink(d) {
            
                let filename = d.getAttribute("data-image");
                let extension = filename.split(".").pop();
                
                if(extension === 'pdf'){
                    location.href="match-schedule/"+filename;
                }else{
                    let url = '{{ URL::asset("/storage/event") }}'+'/'+filename;
                    $('.modal-body img').attr('src',url);
                    $('#exampleModal').modal('show');
                }
                // alert(d.getAttribute("data-image"));
            }
    </script>
@endsection
@endsection
