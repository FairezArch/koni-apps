@extends('backend.master')
@section('title', '- Detail Cabang Olahraga')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 rounded text-white" style="background- color: #3B3A3A;">
            <div class="row m-4">
                <div class="col-md-4">
                    <img src="{{ asset('storage/sport/' . $sport->file_sport) }}" alt="sport image" class="img-fluid" style="width: 277px; height: 228px;">
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="d-none">{{ $sport->sportbranch_name }}</h4>
                        </div>
                        <div class="col-md-2">
                            <div class="text-right">
                                <a href="{{ route('sport-branch.edit', $sport->id) }}" class="text-white">
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
                    <h2>{{ $sport->organization }}</h2>
                    <div class="d-flex flex-row">
                        <div class="p-2"><img src="{{asset('assets/telp.svg')}}" alt="image"></div>
                        <div class="p-2">{{ $sport->phone_number_sport }}</div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="p-2"><img src="{{asset('assets/entypo_mail.svg')}}" alt="image"></div>
                        <div class="p-2">{{ $sport->email }}</div>
                    </div>
                    <div class="d-flex flex-row">
                        <div class="p-2"><img src="{{asset('assets/bx_map.svg')}}" alt="image"></div>
                        <div class="p-2">{{ $sport->address }}</div>
                    </div>
                </div>
            </div>
            <div class="row m-4">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 border border-white">
                            <div class="py-4">
                                <h6 class="text-center">{{ strtoupper('internasional') }}</h6>
                                <h2 class="text-center m-5">0</h2>
                            </div>
                        </div>
                        <div class="col-md-3 border border-white">
                            <div class="py-4">
                                <h6 class="text-center">{{ strtoupper('nasional') }}</h6>
                                <h2 class="text-center m-5">0</h2>
                            </div>
                        </div>
                        <div class="col-md-3 border border-white">
                            <div class="py-4">
                                <h6 class="text-center">{{ strtoupper('daerah') }}</h6>
                                <h2 class="text-center m-5">0</h2>
                            </div>
                        </div>
                        <div class="col-md-3 border border-white">
                            <div class="py-4">
                                <h6 class="text-center">{{ strtoupper('kota') }}</h6>
                                <h2 class="text-center m-5">0</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-4">
                <div class="container">
                    {{ $sport->desc_sportbranch }}
                </div>
            </div>
            <div class="row m-4">
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Klub/Sasana</h5>
                            <h4>{{ $clubs }}</h4>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('sport-branch.clubs.index', $sport->id) }}"
                                class="text-white">Lihat
                                Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Nomor</h5>
                            <h4>{{ $nomors }}</h4>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('sport-branch.nomor.index', $sport->id) }}"
                                class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Atlet</h5>
                            <h4>{{ $atlets }}</h4>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('sport-branch.atlet.index', $sport->id) }}"
                                class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Pelatih</h5>
                            <h4>{{ $trainers }}</h4>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('sport-branch.trainer.index', $sport->id) }}"
                                class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="rounded p-3 mt-3 mb-3 wrapper-box-sport">
                        <div class="top-box-sport text-center text-dark">
                            <h5>Wasit dan Juri</h5>
                            <h4>{{ $referees + $judges }}</h4>
                        </div>
                        <div class="border-top border-white mt-3 text-right">
                            <a href="{{ route('sport-branch.judge.index', $sport->id) }}" class="text-white">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
