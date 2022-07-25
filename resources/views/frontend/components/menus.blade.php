<header class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand text-white" href="{{url('/')}}">
            <img src="{{asset('assets/KONI.png')}}" alt="{{asset('assets/KONI.png')}}" width="30" height="30" class="d-inline-block align-top rounded" alt="">
            KONI
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav justify-content-center m-auto" id="nav-ul-link">
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{url('/')}}">{{strtoupper('home')}}</a>
                </li>
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{route('sports')}}">{{strtoupper('cabor')}}</a>
                </li>
                <li class="nav-item mr-1 topnav d-none ">
                    <a class="nav-link text-white p-2" href="{{route('profiles')}}">{{strtoupper('pengurus')}}</a>
                </li>
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{route('news')}}">{{strtoupper('berita')}}</a>
                </li>
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{route('gallery')}}">{{strtoupper('galeri')}}</a>
                </li>
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{route('match-schedule')}}">{{strtoupper('jadwal pertandingan')}}</a>
                </li>
            </ul>
            <ul class="nav navbar-nav justify-content-center">
                <li class="nav-item mr-1 topnav">
                    <a class="nav-link text-white p-2" href="{{route('login')}}">{{strtoupper('masuk')}}</a>
                </li>
            </ul>
        </div>
    </nav>
</header>