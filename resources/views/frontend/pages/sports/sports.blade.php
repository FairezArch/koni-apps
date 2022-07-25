@extends('frontend.master')
@section('title', '- Cabang Olahraga')

@section('content')
    <section class="range-p">
        <div class="container">
            <h4 class="border-bottom border-space">Cabang Olahraga</h4>
            <div class="wrapper-sport">
                <div class="row">
                    @foreach ($lists as $list)
                        <div class="col-md-3 mt-2 mb-2">
                            <a href="{{ url('sports/detail/' . $list->slug) }}">
                                <div class="card">
                                    @if (!empty($list->file_sport))
                                        <img class="card-img-top" src="{{ asset('storage/sport/' . $list->file_sport) }}"
                                            alt="Card image cap" style="height: 150px">
                                    @else
                                        <img class="card-img-top" src="{{ asset('assets/poster.png') }}"
                                            alt="Card image cap" style="height: 150px">
                                    @endif
                                    <div class="card-body text-center text-dark">
                                        <h5 class="card-title">{{ $list->sportbranch_name }}</h5>
                                        <p class="card-text">{{ $list->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

