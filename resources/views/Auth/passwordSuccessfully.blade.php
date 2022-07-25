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
                <div class="form-forget-pass w-50">
                    <img src="" alt="" class="images_res">
                    <h4 class="mt-3 mb-3">Password Berhasil Diubah</h4>
                    <a class="form-control btn btn-danger mt-3" href="{{url('/')}}">Masuk Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('Auth.components.footer')