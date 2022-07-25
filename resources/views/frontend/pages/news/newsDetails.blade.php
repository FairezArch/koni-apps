@extends('frontend.master')
@section('title', '- Berita')
@section('meta_description', $lists->title)
@section('meta_keywords', $lists->title)
@section('meta_og_description', $lists->title)
@section('meta_og_title', $lists->title)
@section('meta_og_url', url()->current())
@section('meta_og_image', asset('storage/news/'.json_decode($lists->file_news)[0]) )
@section('meta_og_image_url', asset('storage/news/'.json_decode($lists->file_news)[0]) )
@section('meta_twitter_title', $lists->title)
@section('meta_twitter_site', url()->current())
@section('content')
    <section class="range-p">
        <div class="container">
            <div class="rounded border bg-white p-4">
                <h2 class="text-dark">{{ $lists->title }}</h2>
                <h5 class="text-dark"><small>{{ $lists->short_content }}</small></h5>
                <div class="info mt-3 mb-3">
                    <div class="d-flex">
                        <div class="personal-info-news rounded mr-2">
                            <img src="{{ url('storage/users/' . $lists->photo) }}" class="images_res">
                        </div>
                        <div class="text-dark">
                            <h6><b>{{ $lists->categories->category_name }}</b></h6>
                            <p>{{ $lists->name }}
                                <br />
                                <small>{{ \Carbon\Carbon::parse($lists->showtime_from)->translatedFormat('d F Y') }} |
                                    {{ \Carbon\Carbon::parse($lists->created_at)->translatedFormat('H:i') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="news-content rounded text-dark my-3">
                    <div class="image-content">
                        <div class="content-slider position-relative">
                            <div class='slider-for'>
                                @foreach (json_decode($lists->file_news) as $imagesNews)
                                    <div><img src="{{ asset('storage/news/' . $imagesNews) }}" class="images_res">
                                    </div>
                                @endforeach
                            </div>

                            <div class='slider-nav thumb-in-slider'>
                                @foreach (json_decode($lists->file_news) as $imagesNews)
                                    <div><img src="{{ asset('storage/news/' . $imagesNews) }}" class="images_res">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-content my-3">
                            {!! $lists->content !!}
                        </div>

                        <div class="text-content my-3">
                            <div class="row">
                                @foreach (json_decode($lists->hashtags) as $hashtag)
                                    <div class="col-md-2">
                                        <div class="shadow p-3 mb-5 bg-white rounded text-center">
                                            <a href="{{ route('news-hashtags',$hashtag) }}" class="text-primary max-char-lenght"><p>{{ $hashtag }}</p></a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rounded border bg-white p-4 mt-4">
                <h5 class="text-dark">Berita Terkait</h5>
                <div class="wrapper-news-new mt-3 mb-3">
                    @foreach ($newsByCategories as $newsByCategory)
                        <a href="{{ url('news/detail/' . $newsByCategory->slug . '') }}">
                            <div class="list-news-new border-bottom pb-2">
                                <div class="d-flex">
                                    @php
                                        $de_image = json_decode($newsByCategory->file_news);
                                    @endphp
                                    <div class="rounded mr-3">
                                        <div style="width: 180px; height: auto;">
                                            <img src="{{ asset('storage/news/' . $de_image[0]) }}"
                                                alt="{{ $de_image[0] }}" class="images_res">
                                        </div>
                                    </div>
                                    <div class="text-content-news-new text-dark">
                                        <h5>{{ $newsByCategory->title }}</h5>
                                        <small class="mt-5">
                                            {{ \Carbon\Carbon::parse($newsByCategory->showtime_from)->translatedFormat('d F Y') }}
                                            |
                                            {{ \Carbon\Carbon::parse($newsByCategory->created_at)->translatedFormat('H:i') }}
                                        </small>
                                        <p>{{ $newsByCategory->short_content }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="rounded border bg-white p-4 mt-4">
                <h5 class="text-dark">Berita Terbaru</h5>
                <div class="wrapper-news-new mt-3 mb-3">
                    @foreach ($new_news as $newNews)
                        <a href="{{ url('news/detail/' . $newNews->slug . '') }}">
                            <div class="list-news-new border-bottom pb-2">
                                <div class="d-flex">
                                    @php
                                        $de_image = json_decode($newNews->file_news);
                                    @endphp
                                    <div class="rounded mr-3">
                                        <div style="width: 180px; height: auto;">
                                            <img src="{{ asset('storage/news/' . $de_image[0]) }}"
                                                alt="{{ $de_image[0] }}" class="images_res">
                                        </div>
                                    </div>
                                    <div class="text-content-news-new text-dark">
                                        <h5>{{ $newNews->title }}</h5>
                                        <small class="mt-5">
                                            {{ \Carbon\Carbon::parse($newNews->showtime_from)->translatedFormat('d F Y') }}
                                            |
                                            {{ \Carbon\Carbon::parse($newNews->created_at)->translatedFormat('H:i') }}
                                        </small>
                                        <p>{{ $newsByCategory->short_content }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
