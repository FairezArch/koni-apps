@include('Auth.components.header')
<section>
    <div class="form-login-koni">
        <div class="row">
            <div class="d-none">
                <div class="left-pos-login bg-danger min-vh-100 d-flex justify-content-center align-items-center">
                    <div class="w-75">
                        <h4 class="d-inline-block border-bottom border-space text-white mb-3">Calendar Event</h4>
                        <div class="calendar bg-white rounded p-3" id="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="wrapper-login-koni min-vh-100 d-flex justify-content-center align-items-center">
                    <div>
                        <div class="text-center">
                            <img src="{{asset('assets/KONI.png')}}" alt="{{asset('assets/KONI.png')}}" class="images_res">
                        </div>
                        <p class="mt-4 text-center">Hanya untuk akun yang telah didaftarkan oleh admin KONI Surakarta</p>
                        <form action="{{route('tologin')}}" method="post" class="mt-3">
                            @csrf
                            <div class="card-body">
                                @if(session('errors'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Something it's wrong:
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                                @endif
                                @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                                @endif
                                <div class="form__group">
                                    <input type="email" class="form__field" placeholder="Email" name="email"  />
                                    <label for="email" class="form__label">Email</label>
                                </div>
                                <div class="form__group">
                                    <input type="password" class="form__field" placeholder="Password" name="password"  />
                                    <label for="password" class="form__label">Password</label>
                                </div>
                                <div class="text-right mr-1 ml-1 mt-3 mb-3">
                                    <a href="{{route('forget.password.get')}}">Lupa Password ?</a>
                                </div>
                            </div>
                            <div class="card-footer cards-down">
                                <button type="submit" class="btn btn-danger custom-btn text-white">Masuk</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('Auth.components.footer')