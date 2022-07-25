@extends('backend.master')
@section('title', '- Detail Club')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 rounded text-white" style="background-color: #3B3A3A;">
            <div class="row m-4">
                <div class="col-md-4">
                    <img src="{{ asset('storage/club/' . $list->file_club) }}" alt="sport image" class="img-fluid">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <h4>{{ $list->club_name }}</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                <a href="{{ route('club.profile.edit', $club->id) }}" class="text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <p>{{ $list->club_phone }}</p>
                    <p>{{ $list->email }}</p>
                    <p>{{ $list->club_address }}</p>
                </div>
            </div>
            <div class="row m-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 border border-white">
                            <h5 class="text-center">{{ strtoupper('internasional') }}</h5>
                            <h5 class="text-center">1</h5>
                        </div>
                        <div class="col-md-3 border border-white">
                            <h5 class="text-center">{{ strtoupper('nasional') }}</h5>
                            <h5 class="text-center">15</h5>
                        </div>
                        <div class="col-md-3 border border-white">
                            <h5 class="text-center">{{ strtoupper('daerah') }}</h5>
                            <h5 class="text-center">151</h5>
                        </div>
                        <div class="col-md-3 border border-white">
                            <h5 class="text-center">{{ strtoupper('kota') }}</h5>
                            <h5 class="text-center">4</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-4">
                <div class="container">
                    <p>{{ $list->desc }}</p>
                </div>
            </div>
            <div class="row m-4">
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Atlet</h5>
                            <h6><small>{{ $list->atlets->count() }} Atlet</small></h6>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('club.atlet.index', $list->id) }}"
                                class="text-white">Lihat
                                Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Pelatih</h5>
                            <h6><small>{{ $list->trainer->count() }} Pelatih</small></h6>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('club.trainer.index', $list->id) }}"
                                class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Wasit Juri</h5>
                            <h6><small>{{ $list->judges->count() }} Wasit Juri</small></h6>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('club.judge.index', $list->id) }}"
                                class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
