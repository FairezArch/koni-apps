@extends('backend.master')
@section('title', '- Edit Klub')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded"> 
            <h4>Klub</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
            <input type="hidden" name="club_id" id="club_id" value="{{ $lists->id }}">
                <div class="form-group row">
                    <label for="club_name" class="col-sm-2 col-form-label">Nama Klub</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->club_name }}" name="club_name" id="club_name"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="users_id" class="col-sm-2 col-form-label">Penanggung Jawab</label>
                    <div class="col-sm-10">
                        <select name="users_id" id="users_id" class="users_id form-control">
                            @foreach ($users as $list)
                                <option value="{{ $list->id }}"
                                    {{ $list->id == $lists->users_id ? 'selected="selected"' : '' }}>{{ $list->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="club_address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="club_address" id="club_address" class="form-control club_address" cols="30"
                            rows="5">{{ $lists->club_address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="club_phone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="club_phone" id="club_phone" class="form-control"
                            value="{{ $lists->club_phone }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control" value="{{ $lists->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="deed_of_company" class="col-sm-2 col-form-label">Akta Perusahaan</label>
                    <div class="col-sm-10">
                        <input type="text" name="deed_of_company" id="deed_of_company" class="form-control"
                            value="{{ $lists->deed_of_company }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc_club" class="col-sm-2 col-form-label">Deksripsi Klub</label>
                    <div class="col-sm-10">
                        <textarea name="desc_club" id="desc_club" class="form-control desc_club" cols="30" rows="5">{{$lists->desc}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="status form-control">
                            <option value="1" {{ $lists->status == 1 ? 'selected="selected"' : '' }}>Aktif
                            </option>
                            <option value="0" {{ $lists->status == 0 ? 'selected="selected"' : '' }}>Tidak Aktif
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_club" class="col-form-label">Logo Klub</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file_club"
                                                        id="file_club" aria-describedby="inputGroupFileAddon01"
                                                        name="file_club" hidden />
                                                    <label for="file_club" class="py-2 px-4" style="background-color: #FFC20E;
                                                        color: white;
                                                        
                                                        font-family: sans-serif;
                                                        border-radius: 1rem;
                                                        cursor: pointer;
                                                        margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @if (!empty($lists->file_club))
                                            <div class="col-md-3 text-center">
                                                <div class="col-sm-12">
                                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                        style="width: 150px; height: auto;">
                                                        <img src='{{ asset('storage/club/' . $lists->file_club) }}'
                                                            class="img-rounded img-thumbnail" id="imageLoad_file_club" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_deed_of_company">Berkas Akta Perusahaan</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file_deed_of_company"
                                                        id="file_deed_of_company" aria-describedby="inputGroupFileAddon01"
                                                        name="file_deed_of_company" hidden />
                                                    <label for="file_deed_of_company" class="py-2 px-4" style="background-color: #FFC20E;
                                                        color: white;
                                                        
                                                        font-family: sans-serif;
                                                        border-radius: 1rem;
                                                        cursor: pointer;
                                                        margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @if (!empty($lists->file_deed_of_company))
                                            <div class="col-md-3 text-center">
                                                <div class="col-sm-12">
                                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                        style="width: 150px; height: auto;">
                                                        <img src='{{ asset('storage/club/' . $lists->file_deed_of_company) }}'
                                                            class="img-rounded img-thumbnail" id="imageLoad_file_deed_of_company" />
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('club.profile', $club->id) }}"
                        class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
            
            {{-- @include(
                'backend.pages.sportBranch.clubs.index-atlet-trainer'
            ) --}}
        </div>
    </div>
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#forminput').on('submit', function(e) {
            // alert('dsadsadsads')
            e.preventDefault();

            
            let club_id = $('#club_id').val(); // Club ID

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('_method','PUT');
            formData.append('club_name', $('#club_name').val());
            formData.append('users_id', $('#users_id').val());
            formData.append('club_address', $('#club_address').val());
            formData.append('club_phone', $('#club_phone').val());
            formData.append('email', $('#email').val());
            formData.append('deed_of_company', $('#deed_of_company').val());
            formData.append('file_deed_of_company', $('#file_deed_of_company').get(0).files[0]);
            formData.append('file_club', $('#file_club').get(0).files[0]);
            formData.append('status', $('#status').val());
            formData.append('desc_club', $('#desc_club').val());
            formData.append('id', "{{$lists->id}}");

            $.ajax({
                url: "{!! url('club/"+club_id+"/profile/update') !!}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function() {
                    elm.html(
                        '<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...'
                    )
                },
                success: function(res) {
                    if (res.success == true) {
                        window.location.href = "{!! url('club/"+club_id+"/profile') !!}"
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        let errors = JSON.parse(xhr.responseText);
                        $.each(errors.errors, function(key, value) {
                            $(`#${key}`).addClass('is-invalid');
                        })
                    }
                    elm.html('Simpan')
                    elm.removeAttr('disabled')
                    console.log(xhr.responseText)
                },
                complete: function() {
                    elm.html('Simpan')
                    elm.removeAttr('disabled')
                }
            })

        })
    </script>
    <script>
        file_deed_of_company.onchange = evt => {
            const [file] = file_deed_of_company.files
            if (file) {
                imageLoad_file_deed_of_company.src = URL.createObjectURL(file)
            }
        }
        file_club.onchange = evt => {
            const [file] = file_club.files
            if (file) {
                imageLoad_file_club.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
@endsection
