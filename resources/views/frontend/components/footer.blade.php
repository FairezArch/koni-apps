<!-- Footer -->
<footer class="text-lg-start bg-dark text-muted">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4"></section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-md-start mt-5 text-white">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <img src="{{ asset('storage/setting_general/' . $footer->file_koni) }}"
                        alt="{{ $footer->file_koni }}">
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Kontak Kami
                    </h6>
                    <p>WA: {{ $footer->whatsapp }}</p>
                    <p>
                        Email: {{ $footer->email }}
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        Alamat Kami
                    </h6>
                    <p>{{ $footer->address }}</p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->

    <div class="w-100" style="background-color: rgba(0, 0, 0, 0.05);">
        <div class="container">
            <div class="p-3 text-white">
                <div class="row">
                    <div class="col-md-5">
                        © {{ \Carbon\Carbon::now()->format('Y') }} Copyright:
                    </div>
                    <div class="col-md-2 text-center">
                        <div class="social-links">
                            <div class="row">
                                @if (!empty($footer->instagram))
                                    <div class="col-md-3">
                                        <a href="{{ $footer->instagram }}" target="_blank"><i
                                                class="fa fa-instagram fa-lg"></i></a>
                                    </div>
                                @endif
                                @if (!empty($footer->facebook))
                                    <div class="col-md-3">
                                        <a href="{{ $footer->facebook }}" target="_blank"><i
                                                class="fa fa-facebook fa-lg"></i></a>
                                    </div>
                                @endif
                                @if (!empty($footer->youtube))
                                    <div class="col-md-3">
                                        <a href="{{ $footer->youtube }}" target="_blank"><i
                                                class="fa fa-youtube fa-lg"></i></a>
                                    </div>
                                @endif
                                @if (!empty($footer->twitter))
                                    <div class="col-md-3">
                                        <a href="{{ $footer->twitter }}" target="_blank"><i
                                                class="fa fa-twitter fa-lg"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 text-right ">
                        <a href="{{ route('privacy-policy') }}" class="text-white">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
    </div>

</footer>

<!-- Footer -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"
integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.news-carousel').slick({
            swipe: true,
            swipeToSlide: true,
            arrows: false,
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.profile-carousel').slick({
            swipe: true,
            swipeToSlide: true,
            arrows: false,
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            lazyLoad: 'ondemand',
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: false,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

    $('li').click(function() {
        $('li.nav-item.nav-link.active').removeClass("active");
        $(this).addClass("active");
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: true,
        asNavFor: '.slider-nav'
    });

    $('.slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        arrows: false,
        focusOnSelect: true
    });

    $('.slider-for-topnews').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav-topnews'
    });

    $('.slider-nav-topnews').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.slider-for-topnews',
        dots: false,
        arrows: false,
        centerMode: true,
        focusOnSelect: true
    });

    $('.home-slider').slick({
        swipe: true,
        swipeToSlide: true,
        arrows: false,
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        lazyLoad: 'ondemand',
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false,
                    arrows: false,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>
{{-- <script src="http://momentjs.com/downloads/moment.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"
integrity="sha256-XOMgUu4lWKSn8CFoJoBoGd9Q/OET+xrfGYSo+AKpFhE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js"
integrity="sha256-GcByKJnun2NoPMzoBsuCb4O2MKiqJZLlHTw3PJeqSkI=" crossorigin="anonymous"></script>
<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>
@yield('script-front')

</body>

</html>
