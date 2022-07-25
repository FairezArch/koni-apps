@extends('backend.master')
@section('title', '- Pengaturan Umum')
@section('content')
    <div class="container-fluid">
        <div class="wrapper-table p-3 bg-white rounded">
            <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h4>UMUM</h4>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" class="form-control" cols="30"
                                rows="5">{{ $lists->address }}</textarea>
                        </div>
                        <h4>Kontak Person</h4>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $lists->email }}" name="email" id="email"
                                class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp">Whatsapp</label>
                            <input type="text" value="{{ $lists->whatsapp }}" name="whatsapp" id="whatsapp"
                                class="form-control rounded">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h4>Logo KONI</h4>
                            <small style="line-height: 32px;">Gambar disarankan berukuran 360x360, tipe file, JPG,SVG atau
                                PNG</small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input file_koni" id="file_koni"
                                        aria-describedby="inputGroupFileAddon01" name="file_koni">
                                    <label class="custom-file-label" for="file_koni">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @if (!empty($lists->file_koni))
                        <div class="d-inline-block" id="show-image"
                            style="width: 200px; height: auto;">
                            <img src='{{ url("storage/setting_general/$lists->file_koni") }}'
                                class="img-rounded img-thumbnail" />
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" value="{{ $lists->instagram }}" name="instagram" id="instagram"
                                class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" value="{{ $lists->facebook }}" name="facebook" id="facebook"
                                class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="youtube">Youtube</label>
                            <input type="text" value="{{ $lists->youtube }}" name="youtube" id="youtube"
                                class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" value="{{ $lists->twitter }}" name="twitter" id="twitter"
                                class="form-control rounded">
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
