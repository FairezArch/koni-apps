@extends('backend.master')
@section('title', '- Edit Cabang Olahraga')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Cabang Olahraga</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="sportbranch_name" class="col-sm-2 col-form-label">Nama Cabang Olahraga</label>
                    <div class="col-sm-10">
                        <input type="text" name="sportbranch_name" value="{{ $lists->sportbranch_name }}"
                            id="sportbranch_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="organization" class="col-sm-2 col-form-label">Persatuan Organisasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="organization" id="organization" class="form-control"
                            value="{{ $lists->organization }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="short_organization" class="col-sm-2 col-form-label">Singkatan Persatuan Organisasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="short_organization" id="short_organization" class="form-control"
                            value="{{ $lists->short_organization }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $lists->email }}" id="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number_sport" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone_number_sport" value="{{ $lists->phone_number_sport }}"
                            id="phone_number_sport" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="users_id" class="col-sm-4 col-form-label">Ketua Cabang Olahraga</label>
                                <div class="col-sm-8">
                                    <select name="users_id" id="users_id" class="form-control">
                                        @foreach ($selects as $list)
                                            <option value="{{ json_encode([$lists->id, $lists->sk_number]) }}"
                                                {{ $list->id == $lists->users_id ? 'selected="selected"' : '' }}>
                                                {{ $list->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            &nbsp;
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address" cols="30" rows="5"
                            class="w-100">{{ $lists->sportbranch_name }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sk_number" class="col-sm-2 col-form-label">SK Cabor</label>
                    <div class="col-sm-10">
                        <input type="text" name="sk_number" value="{{ $lists->sk_number }}" id="sk_number" class="form-control" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="desc_sportbranch" class="col-sm-2 col-form-label">Deskripsi Cabang Olahraga</label>
                    <div class="col-sm-10">
                        <textarea name="desc_sportbranch" class="form-control" id="desc_sportbranch" cols="30" rows="5"
                            class="w-100">{{ $lists->desc_sportbranch }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="file_sport" class="col-sm-2 col-form-label">Logo Cabor</label>
                    <div class="col-sm-10">
                        <small>Gambar dengan tipe file PNG dan JPG</small>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_sport" id="file_sport"
                                            aria-describedby="inputGroupFileAddon01" name="file_sport" hidden />
                                        <label for="file_sport" class="py-2 px-4" style="background-color: #FFC20E;
                                        color: white;
                                        
                                        font-family: sans-serif;
                                        border-radius: 1rem;
                                        cursor: pointer;
                                        margin-top: 1rem;">Upload</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="preview-image" id="preview-image">
                                    <img src="{{asset('assets/def_image.svg')}}" alt="default" id="imageLoad" width="100" height="auto" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!empty($lists->file_sport))
                    <div class="form-group row">
                        <label for="showfile" class="col-sm-2 col-form-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                style="width: 150px; height: auto;">
                                <img src='{{ url("storage/sport/$lists->file_sport") }}'
                                    class="img-rounded img-thumbnail" />
                            </div>
                        </div>
                    </div>
                @endif
                <div class="text-right">
                    <a href="{{ route('sport-branch.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>

    </div>
@section('script-footer')
    <script type="text/javascript">
        $(function() {
           
        });

        
        $('#users_id').on('change', function(e) {
            e.preventDefault();
            let selected = $(this).find("option:selected"),
                select = JSON.parse(selected.val());
            $('#sk_number').val(select[1]);
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#forminput').on('submit', function(e) {
            e.preventDefault();

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('sportbranch_name', $('#sportbranch_name').val());
            formData.append('address', $('#address').val());
            formData.append('email', $('#email').val());
            formData.append('phone_number_sport', $('#phone_number_sport').val());
            formData.append('file_sport', $('#file_sport').get(0).files[0]);
            formData.append('users_id', 0);
            formData.append('sk_number', 0);
            formData.append('desc_sportbranch', $('#desc_sportbranch').val());
            formData.append('organization', $('#organization').val());
            formData.append('short_organization', $('#short_organization').val());
            formData.append('users_id', $('#users_id').val());

            $.ajax({
                url: "{{ route('sport-branch.update', $lists->id) }}",
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
                        window.location.href = "{{ route('sport-branch.index') }}"
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
        file_sport.onchange = evt => {
        const [file] = file_sport.files
        if (file) {
            imageLoad.src = URL.createObjectURL(file)
        }
        }
    </script>
@endsection
@endsection
