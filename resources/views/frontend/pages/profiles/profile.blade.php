@extends('frontend.master')
@section('content')
    <section class="range-p">
        <div class="container">
            <div class="profile-top">
                <div class="row">
                    <div class="col-md-6">
                        <h4>KONI SURAKARTA</h4>
                        {{ $lists->about_koni }}
                    </div>
                    <div class="col-md-6">
                        {{ $lists->profile_koni }}
                    </div>
                </div>
            </div>
            <div class="profile-middle mt-3">
                <h4 class="middle-text-line"><span>Kenal Kami</span></h4>
                <div class="wrapper-slider mt-3">
                    <div class="container profile-carousel" id="profile-carousel">
                        @php
                            $x = 1;
                        @endphp
                        @if (!empty($lists->data_users))
                            
                        @foreach (json_decode($lists->data_users) as $data_user)
                            @php
                                $x++;
                            @endphp
                            <div class="item shadow-sm p-3 mb-5 mr-2 ml-2 bg-white border item-carousel-profile profile-lists"
                                id="profile-lists" data-idrow="{{ $x }}">
                                <div class="wrapper-image-profile">
                                    <div class="img-profile-one m-auto">
                                        <img class="img-fluid rounded-circle"
                                            src="{{ asset('storage/users/' . $data_user->G_image_user) }}" alt="Image" />
                                    </div>
                                </div>
                                <div class="content-item-news text-center mt-2">
                                    <p>{{ $data_user->B_users_name }}</p>
                                    <p>{{ $data_user->D_employ_name }}</p>
                                </div>
                                <input type="hidden" name="res_quote_val" id="res_quote_val_{{ $x }}"
                                    value="{{ $data_user->E_quote }}">
                                <input type="hidden" name="res_desc_val" id="res_desc_val_{{ $x }}"
                                    value="{{ $data_user->F_desc }}">
                            </div>
                        @endforeach
                        @endif

                    </div>
                </div>
                <div class="bottom-profile" id="bottom-profile">

                </div>
            </div>
        </div>
    </section>
@section('script-front')
    <script>
        $('.profile-lists').on('click', function() {
            let idRow = $(this).data('idrow');
            const quote = $(`#res_quote_val_${idRow}`).val();
            const desc = $(`#res_desc_val_${idRow}`).val();
            $('#bottom-profile').html(`<div class="container">
                <div class="position-relative">
                    <div class="bg-secondary p-3 border-dotted-red w-75 m-auto position-relative text-center">
                        <h4>${quote}</h4>
                        <h5 class="text-white text-left">${desc}</h5>
                    </div>
                    <div class="positon-relative w-75 m-auto ">
                        <div class="border-bottom-red"></div>
                    </div>
                </div>
            </div>`);
        })
    </script>
@endsection
@endsection
