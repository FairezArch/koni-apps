<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta name='description' itemprop='description' content='@yield('meta_description', config('app.name') . ' Surakarta')' />
    <meta name='keywords' content='@yield('meta_keywords', config('app.name') . ' Surakarta')' />
    <meta property="og:description" itemprop='description' content="@yield('meta_og_description', config('app.name'))" />
    <meta property="og:title" content="@yield('meta_og_title', config('app.name') . ' Surakarta')" />
    <meta property="og:url" content="@yield('meta_og_url', url()->current() )" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="@yield('meta_og_locale', app()->getLocale())" />
    <meta property="og:locale:alternate" content="en-us" />
    <meta property="og:site_name" content="@yield('meta_og_site_name', url()->current())" />
    <meta property="og:image" content="@yield('meta_og_image', asset('asset/KONI.png'))" />
    <meta property="og:image:url" content="@yield('meta_og_image_url', asset('asset/KONI.png'))" />
    <meta property="og:image:size" content="300" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="@yield('meta_twitter_title', config('app.name') . ' Surakarta')" />
    <meta name="twitter:site" content="@yield('meta_twitter_site', url()->current())" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css"
        integrity="sha256-16PDMvytZTH9heHu9KBPjzrFTaoner60bnABykjNiM0=" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/front.css') }}">

    <title>{{ config('app.name') }} @yield('title', '- Surakarta')</title>
</head>

<body>
