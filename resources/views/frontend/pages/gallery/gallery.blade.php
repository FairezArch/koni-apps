@extends('frontend.master')
@section('title', '- Galeri')
@section('content')
    <section class="range-p">
        <div class="container">
            @if (!$lists->isEmpty())
                <div class="gallery-cabor mt-3">
                    <div class="list-gallery rounded">
                        <div class="row">
                            @foreach ($lists as $list)
                                <div class="col-md-3 my-4">
                                    <div class="grid-image position-relative">
                                        <div style="width: 255px; height: 138px;">
                                            @if (pathinfo($list->filename, PATHINFO_EXTENSION) == 'mp4')
                                                <div id="trailer"
                                                    class="section d-flex justify-content-center embed-responsive embed-responsive-4by3">
                                                    <video class="embed-responsive-item" controls muted>
                                                        <source
                                                            src="{{ asset('storage/' . $list->folder . '/' . $list->thumb_image) }}"
                                                            type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/' . $list->folder . '/' . $list->thumb_image) }}"
                                                    alt="Image" class="img-thumbnail card-img-top" style="width: 255px; height: 138px;">
                                            @endif
                                            <div class="position-absolute text-center text-gallery w-100">
                                                <p class="text-in-image-max-char">{{ $list->title }}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <section class="range-p">
        <div class="container">
            {{-- @if (!$file_sports->isEmpty()) --}}
            @foreach ($file_sports as $file_sport)
                <h2 class="middle-text-line"><span>{{$file_sport["name"]}}</span></h2>
                <div class="gallery-cabor mt-3">
                    <div class="list-gallery rounded">
                        <div class="row">
                            @foreach ( $file_sport["files"] as $file )                                
                                <div class="col-md-3 my-4">
                                    <div class="grid-image position-relative">
                                        @if (pathinfo($file->filename, PATHINFO_EXTENSION) == 'mp4')
                                            <div id="trailer"
                                                class="section d-flex justify-content-center embed-responsive embed-responsive-4by3">
                                                <video class="embed-responsive-item" controls muted>
                                                    <source
                                                        src="{{ asset('storage/' . $file->folder . '/' . $file->thumb_image) }}"
                                                        type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                        @else
                                            <img src="{{ asset('storage/' . $file->folder . '/' . $file->thumb_image) }}"
                                                alt="Image" class="img-thumbnail card-img-top" style="width: 255px; height: 138px;">
                                        @endif
                                        <div class="position-absolute text-center text-gallery w-100">
                                            <p class="text-in-image-max-char">{{ $file->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- @endif --}}
        </div>
    </section>
@endsection
