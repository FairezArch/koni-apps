@extends('frontend.master')
@section('title', '- Privacy Policy')
@section('content')
    <section class="range-p">
        <div class="container">
            @if (!empty($lists))
                <div class="box-sport bg-white rounded pt-3 pb-3 pr-2 pl-2">
                    <h4>{{ strtoupper('privacy & policy') }}</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{$lists->privacy}}</p>
                            <p>{{$lists->policy}}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
