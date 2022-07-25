@extends('frontend.master')
@section('title', '- Cabang Olahraga')
@section('meta_description', $lists->sportbranch_name)
@section('meta_keywords', $lists->sportbranch_name)
@section('meta_og_description', $lists->sportbranch_name)
@section('meta_og_title', $lists->sportbranch_name)
@section('meta_og_url', url()->current())
@section('meta_og_image', asset('storage/sport/'.json_decode($lists->file_sport)[0]) )
@section('meta_og_image_url', asset('storage/sport/'.json_decode($lists->file_sport)[0]) )
@section('meta_twitter_title', $lists->sportbranch_name)
@section('meta_twitter_site', url()->current())
@section('content')
    <section class="range-p">
        <div class="container">
            @if (!empty($lists))
                <div class="box-sport bg-white rounded pt-3 pb-3 pr-2 pl-2">
                    <h4>{{ $lists->sportbranch_name }} ({{ $lists->short_organization }})</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="wrapper-image-sport" width="350" height="200">
                                @if (!empty($list->file_sport))
                                    <img src="{{ asset('storage/sport/' . $lists->file_sport) }}" alt="Image Sport"
                                        class="img-fluid">
                                @else
                                    <img class="img-fluid" src="{{ asset('assets/poster.png') }}" alt="Card image cap">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6>{{ $lists->name }}</h6>
                            <p>{{ $lists->address }}</p>
                            <p>{{ $lists->desc_sportbranch }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
