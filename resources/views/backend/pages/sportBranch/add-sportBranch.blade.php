@extends('backend.master')
@section('title', '- Tambah Cabang Olahraga')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Cabang Olahraga</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="sportbranch_name" class="col-sm-2 col-form-label">Nama Cabang Olahraga</label>
                    <div class="col-sm-10">
                        <input type="text" name="sportbranch_name" id="sportbranch_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="organization" class="col-sm-2 col-form-label">Persatuan Organisasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="organization" id="organization" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="short_organization" class="col-sm-2 col-form-label">Singkatan  Persatuan Organisasi</label>
                    <div class="col-sm-10">
                        <input type="text" name="short_organization" id="short_organization" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone_number_sport" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone_number_sport" id="phone_number_sport" class="form-control">
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
                                            <option value="{{ json_encode(array($list->id,$list->sk_number)) }}">{{ $list->name }}
                                            </option>
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
                            class="w-100"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sk_number" class="col-sm-2 col-form-label">SK Cabor</label>
                    <div class="col-sm-10">
                        <input type="text" name="sk_number" id="sk_number"
                            class="form-control" disabled>
                    </div>
                </div>    
                <div class="form-group row">
                    <label for="desc_sportbranch" class="col-sm-2 col-form-label">Deskripsi Cabang Olahraga</label>
                    <div class="col-sm-10">
                        <textarea name="desc_sportbranch" class="form-control" id="desc_sportbranch" cols="30" rows="5"
                            class="w-100"></textarea>
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
                <div class="text-right">
                    <a href="{{ route('sport-branch.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')
    <script type="text/javascript">
     $(function () {
        if($('#users_id').length > 0){
            let firstSelect = $("#users_id option:first").attr('selected','selected'),
                splitSelect = JSON.parse(firstSelect.val());
            $('#sk_number').val(splitSelect[1]);
        }else{
            $('#sk_number').val(0);
        }
     });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#users_id').on('change', function(e) {
            e.preventDefault();
            let selected = $(this).find("option:selected"),
                select = JSON.parse(selected.val());
            $('#sk_number').val(select[1]);
        })

        $('#forminput').on('submit', function(e) {

            e.preventDefault();

           
                let elm = $('#save_formData');
                elm.attr('disabled', 'disabled');

                let formData = new FormData();
                formData.append('sportbranch_name', $('#sportbranch_name').val());
                formData.append('address', $('#address').val());
                formData.append('email', $('#email').val());
                formData.append('phone_number_sport', $('#phone_number_sport').val());
                formData.append('file_sport', $('#file_sport').get(0).files[0]);
                formData.append('users_id', JSON.parse($('#users_id').val())[0]);
                formData.append('sk_number', $('#sk_number').val());
                formData.append('desc_sportbranch', $('#desc_sportbranch').val());
                formData.append('organization', $('#organization').val());
                formData.append('short_organization', $('#short_organization').val());

                $.ajax({
                    url: "{{ route('sport-branch.store') }}",
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
