@extends('frontend.master')
@section('content')
    <section>
        <div
            style="background-image: url({{ asset('assets/getAsset.svg') }}); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="box" style="height: 100vh;">
                    <div class="p-4 text-center">
                        <h1 class="d-inline-block border-danger border-bottom border-space">Tentang KONI Surakarta</h1>
                        <p class="mt-4">
                            {{ $landingPage }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!$events->isEmpty())
        <section>
            <div
                style="background-image: url({{ asset('assets/getAsset1.svg') }}); background-repeat: no-repeat; background-size: cover; position: relative;">
                <div
                    style="background-color: rgb(56 56 54 / 70%); position: absolute; top: 0; left: 0; width: 100%; height: 100%;">
                </div>
                <div class="container">
                    <div class="p-4 position-relative">
                        <div class="text-center mb-3 mt-3">
                            <h4 class="d-inline-block border-danger border-bottom border-space text-white">JADWAL
                                PERTANDINGAN</h4>
                        </div>
                        <div class="row">
                            @foreach ($events as $event)
                                @if (\Carbon\Carbon::parse($event->date_from) <= \Carbon\Carbon::now() && \Carbon\Carbon::parse($event->date_to) <= \Carbon\Carbon::now())
                                @else
                                    <div class="col-md-3">
                                        <div class="position-relative bg-white" style="border-radius: 2.25rem;">
                                            <div class="title-event p-3 text-center"
                                                style="background-color: #FFC20E; border-top-left-radius: 2.25rem; border-top-right-radius: 2.25rem;">
                                                <h4 class="text-white">{{ $event->sports->sportbranch_name }}</h4>
                                            </div>
                                            <div class="bg-white">
                                                <div class="my-3 text-center">
                                                    <a class="text-dark" href="{{ route('match-schedule') }}">
                                                        <h5>{{ $event->match_name }}</h5>
                                                    </a>
                                                </div>
                                                <div class="text-center my-3">
                                                    <p>
                                                        <small>
                                                            {{ \Carbon\Carbon::parse($event->date_from)->translatedFormat('d F') }}
                                                            -
                                                            {{ \Carbon\Carbon::parse($event->date_to)->translatedFormat('d F') }}
                                                        </small>
                                                    </p>
                                                    <p> <small><a href="{{ $event->address }}" target="_blank">Lokasi
                                                                Maps</a></small>
                                                    </p>
                                                    @if (!empty($event->file_event))
                                                        <a href="{{ route('match-schedule.download', $event->file_event) }}"
                                                            target="_blank">Lihat Jadwal</a>
                                                    @endif
                                                </div>
                                            </div>
                                            @if (\Carbon\Carbon::now() >= \Carbon\Carbon::parse($event->date_from) && \Carbon\Carbon::now() <= \Carbon\Carbon::parse($event->date_to))
                                                <div class="bottom-event text-center text-white p-3"
                                                    style="background-color: #458985; border-bottom-left-radius: 2.25rem; border-bottom-right-radius: 2.25rem;">
                                                    <h6>Sedang Berlangsung</h6>
                                                </div>
                                            @elseif (\Carbon\Carbon::parse($event->date_from) >= \Carbon\Carbon::now() && \Carbon\Carbon::now() >= \Carbon\Carbon::parse($event->date_to))
                                                <div class="bottom-event text-center text-white p-3"
                                                    style="background-color: #A20021; border-bottom-left-radius: 2.25rem; border-bottom-right-radius: 2.25rem;">
                                                    <h6>Akan Datang</h6>
                                                </div>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @if (!$events->isEmpty())
                            <div class="links text-center my-3">
                                <a href="{{ route('match-schedule') }}" class="text-white">Lihat Selengkapnya</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (!empty($topNews))
        <section>
            <div class="container">
                <div class="p-4">
                    <div class="text-center mb-3">
                        <h4 class="d-inline-block border-danger border-bottom border-space">Berita</h4>
                    </div>
                    <a href="{{ url('news/detail/' . $topNews->slug . '') }}">
                        <div class="row text-dark">
                            <div class="col-md-7">
                                @php
                                    $de_image = json_decode($topNews->file_news);
                                @endphp
                                <div class="position-relative">
                                    <img src="{{ asset('storage/news/' . $de_image[0]) }}" alt="image-top.jpg"
                                        class="images_res">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h2>{{ $topNews->title }}</h2>
                                <small
                                    class="my-2">{{ \Carbon\Carbon::parse($topNews->showtime_from)->translatedFormat('d F Y') }}</small>
                                <p class="my-2">{{ $topNews->short_content }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="home-slider">
                                @foreach ($topNewsSlider as $sliderHome)
                                    <a href="{{ url('news/detail/' . $sliderHome->slug . '') }}">
                                        <div class="position-relative mr-1 ml-2  text-dark">
                                            <div class="grid-image position-relative">
                                                @php
                                                    $image = json_decode($sliderHome->file_news);
                                                @endphp
                                                <img src="{{ asset('storage/news/' . $image[0]) }}" alt="image-grid.jpg"
                                                    class="images_res" style="width: 342px; height: 257px;">
                                                <div class="position-absolute text-center text-in-image">
                                                    <div class="text-in-image-max-char">
                                                        {{ $sliderHome->title }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid-text">
                                                <p class="text-center mt-3">
                                                    <small>{{ \Carbon\Carbon::parse($topNews->showtime_from)->translatedFormat('d F Y') }}</small>
                                                </p>
                                                <div class="max-char-lenght">{{ $topNews->short_content }}</div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="text-center my-3"><a href="{{ route('news') }}"><img
                                        src="{{ asset('assets/arrow_show_bawah.svg') }}" alt="arrow" /></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
