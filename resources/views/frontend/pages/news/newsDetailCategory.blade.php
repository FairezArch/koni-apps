@extends('frontend.master')
@section('title', '- Berita')
@section('meta_description', $topNews->title)
@section('meta_keywords', $topNews->title)
@section('meta_og_description', $topNews->title)
@section('meta_og_title', $topNews->title)
@section('meta_og_url', url()->current())
@section('meta_og_image', asset('storage/news/'.json_decode($topNews->file_news)[0]) )
@section('meta_og_image_url', asset('storage/news/'.json_decode($topNews->file_news)[0]) )
@section('meta_twitter_title', $topNews->title)
@section('meta_twitter_site', url()->current())

@section('content')
    <section class="range-p">
        <div class="container">
            <h4 class="middle-text-line"><span>{{ $slug }}</span></h4>
            @if (!empty($topNews))
                <div class="news-top p-2 my-4 container">
                    <div class="row text-dark">
                        <div class="col-md-6">
                            <div class='slider-for-topnews'>
                                @foreach (json_decode($topNews->file_news) as $imagesNewsTop)
                                    <a href="{{ url('news/detail/' . $topNews->slug . '') }}">
                                        <div class="position-relative">
                                            <div style="width: 532px; height: 100%;">
                                                <img src="{{ asset('storage/news/' . $imagesNewsTop) }}"
                                                    class="img-fluid">
                                            </div>

                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class='slider-nav-topnews mt-3'>
                                @foreach (json_decode($topNews->file_news) as $imagesNewsTop)
                                    <div class="mr-1 ml-1">
                                        <div class="position-relative">
                                            <img src="{{ asset('storage/news/' . $imagesNewsTop) }}"
                                                class="images_res">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2>{{ $topNews->title }}</h2>
                            <small class="my-2">
                                {{ \Carbon\Carbon::parse($topNews->showtime_from)->translatedFormat('d F Y') }}</small>
                            <div class="my-2">
                                {{ $topNews->short_content }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="cat-news mt-4">
                <div class="mt-4">
                    <div class="row">
                        @foreach ($news as $newss)
                            <div class="col-md-4">
                                <a href="{{ url('news/detail/' . $newss->slug . '') }}">
                                    <div class="item text-dark mx-2">
                                        @php
                                            $de_image = json_decode($newss->file_news);
                                        @endphp
                                        <div class="position-relative text-center">
                                            <img src="{{ asset('storage/news/' . $de_image[0]) }}" alt=""
                                                class="images_res" style="width: 344px; height: 257px;">
                                            <div class="position-absolute text-center text-in-image">
                                                <div class="text-in-image-max-char">
                                                    {{ $newss->title }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content-item-news">
                                            <div class="row my-3">
                                                <div class="col-md-6">
                                                    {{ \Carbon\Carbon::parse($newss->showtime_from)->translatedFormat('d F Y') }}
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    Jam
                                                    {{ \Carbon\Carbon::parse($newss->created_at)->translatedFormat('H:i') }}
                                                </div>
                                            </div>
                                            <p class="max-char-lenght">{{ $newss->short_content }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
