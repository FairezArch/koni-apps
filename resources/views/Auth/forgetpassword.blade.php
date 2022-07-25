@include('Auth.components.header')
<div class="container-fluid">
    <div class="row">
        <div class="head-forgetpass w-100 p-3 bg-danger">
            <div class="d-flex">
                <a href="{{ url('login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left text-white" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="item-center-forgetpass w-100">
            <div class="d-flex justify-content-center align-items-center min-vh-100  h-100 ">
                <div class="form-forget-pass w-50 text-center">
                    <h4>Ganti Password</h4>
                    <p class="mt-4">Silahkan tulis alamat email Anda</p>
                    @if (Session::has('message'))
                         <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="form-group text-left m-auto w-75">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Masukkan email Anda">
                        </div>
                        <button class="btn btn-danger mt-3" type="submit">Minta Ganti Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Auth.components.footer')