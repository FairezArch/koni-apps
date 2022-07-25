@extends('backend.master')
@section('title', '- Beranda')
@section('content')
    <div class="container-fluid">
        <div class="wrapper-table p-3 bg-white rounded">
            <input type="hidden" name="valYear" id="valYear" data-value="{!!json_encode($periods)!!}">
            <div class="row">
                <div class="col-md-8">
                    <div class="top-list-info">
                        <div class="row">
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Atlet</h6>
                                                <h6>{{ $atlet }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Pelatih</h6>
                                                <h6>{{ $trainer }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Wasit & Juri</h6>
                                                <h6>{{ $referee + $judge }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Cabor</h6>
                                                <h6>{{ $sport }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Klub</h6>
                                                <h6>{{ $club }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="rounded bg-dark pl-2 pr-2 pt-3 pb-3">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <h6 class="text-warning">Berita Tayang</h6>
                                                <h6>{{ $news }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="d-flex justify-content-center align-items-center h-100">
                                                <span class="icon material-icons md-light">sports_handball</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="middle-list-info">
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                    <div class="bottom-list-info mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Pertandingan</th>
                                    <th>Waktu</th>
                                    <th>Cabang Olahraga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ( $calendars as $calendar )
                                    <td>{{$calendar->match_name}}</td>
                                    <td>{{\Carbon\Carbon::parse($calendar->date_from)->locale('id')->format('d F Y')}} - {{\Carbon\Carbon::parse($calendar->date_to)->locale('id')->format('d F Y')}}</td>
                                    <td>{{$calendar->sports->sportbranch_name}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded shadow bg-primary text-white mb-3 p-2">
                        {{ $atletVerify }} Verifikasi data atlet
                    </div>
                    <div class="rounded shadow bg-success text-white mb-3 p-2">
                        210 Verifikasi Prestasi atlet
                    </div>
                    <div class="rounded text-dark-bg-white mt-3 mb-3">
                        <h4><strong>Atlet Prestasi Tertinggi</strong></h4>
                        <div class="list-atlet-dash">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded text-dark-bg-white mt-3 mb-3">
                        <h4><strong>Cabor Prestasi Tertinggi</strong></h4>
                        <div class="list-atlet-dash">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-8">
                                    <p>Mariska Tunjung</p>
                                    <p><small>Bulu Tangkis</small></p>
                                </div>
                                <div class="col-md-4">
                                    <img src="https://images.unsplash.com/photo-1643425620795-e8c88f888151?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80"
                                        alt="image" id="image" class="img-fluid rounded-circle circle-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script-footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js" integrity="sha256-Y26AMvaIfrZ1EQU49pf6H4QzVTrOI8m9wQYKkftBt4s=" crossorigin="anonymous"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const DATA_COUNT = 7;
        const NUMBER_CFG = {
            count: DATA_COUNT,
            min: 0,
            max: 100
        };

        const labels = JSON.parse($('#valYear').attr("data-value"));
        console.log(labels)
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Emas',
                    data: [10, 30, 39, 20, 25, 34, -10],
                    borderColor: '#FFE162',
                    backgroundColor: '#FFE162',
                },
                {
                    label: 'Perak',
                    data: [18, 33, 22, 19, 11, 39, 30],
                    borderColor: '#92A9BD',
                    backgroundColor: '#92A9BD',
                },
                {
                    label: 'Perunggu',
                    data: [10, 32, 15, 20, 32, 20, 15],
                    borderColor: '#CA965C',
                    backgroundColor: '#CA965C',
                }
            ]
        };
        const config = new Chart(ctx,{
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Perolehan Mendali'
                    }
                },
                scales: {
                    y: {
                        // the data minimum used for determining the ticks is Math.min(dataMin, suggestedMin)
                        suggestedMin: 30,

                        // the data maximum used for determining the ticks is Math.max(dataMax, suggestedMax)
                        suggestedMax: 50,
                    }
                }
            },
        });
    </script>
@endsection
@endsection
