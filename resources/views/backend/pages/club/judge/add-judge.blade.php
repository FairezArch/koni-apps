@extends('backend.master')
@section('title', '- Tambah Wasit Juri')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Tambah Wasit Juri</h4>
            <h5>Data Personal</h5>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <input type="hidden" name="club_id" id="club_id" value="{{ $club->id }}">
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" name="nik" id="nik" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="judge_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="judge_name" id="judge_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="place_born" class="col-sm-2 col-form-label">TTL</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" name="place_born" id="place_born" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="domicile_address" class="col-sm-2 col-form-label">Domisili</label>
                    <div class="col-sm-10">
                        <select name="domicile_address" id="domicile_address" class="form-control">
                            <option value="1">Dalam Kota</option>
                            <option value="2">Luar Kota</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address" cols="30" rows="5" class="w-100"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="npwp_number" class="col-sm-2 col-form-label">NPWP</label>
                    <div class="col-sm-10">
                        <input type="text" name="npwp_number" id="npwp_number" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="photo_profile" class="col-form-label">Foto Diri</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input photo_profile" id="photo_profile"
                                                        aria-describedby="inputGroupFileAddon01" name="photo_profile" hidden />
                                                    <label for="photo_profile" class="py-2 px-4" style="background-color: #FFC20E;
                                                    color: white;
                                                    
                                                    font-family: sans-serif;
                                                    border-radius: 1rem;
                                                    cursor: pointer;
                                                    margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="preview-image" id="preview-image">
                                                <img src="{{asset('assets/def_image.svg')}}" alt="default" id="imageLoad_photo_profile" width="100" height="auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_ktp_judge" class="col-form-label">Berkas KTP</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file_ktp_judge" id="file_ktp_judge"
                                                        aria-describedby="inputGroupFileAddon01" name="file_ktp_judge" hidden />
                                                    <label for="file_ktp_judge" class="py-2 px-4" style="background-color: #FFC20E;
                                                    color: white;
                                                    
                                                    font-family: sans-serif;
                                                    border-radius: 1rem;
                                                    cursor: pointer;
                                                    margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="preview-image" id="preview-image">
                                                <img src="{{asset('assets/def_image.svg')}}" alt="default" id="imageLoad_file_ktp_judge" width="100" height="auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_npwp" class="col-form-label">Berkas NPWP</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file_npwp" id="file_npwp"
                                                        aria-describedby="inputGroupFileAddon01" name="file_npwp" hidden />
                                                    <label for="file_npwp" class="py-2 px-4" style="background-color: #FFC20E;
                                                    color: white;
                                                    
                                                    font-family: sans-serif;
                                                    border-radius: 1rem;
                                                    cursor: pointer;
                                                    margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="preview-image" id="preview-image">
                                                <img src="{{asset('assets/def_image.svg')}}" alt="default" id="imageLoad_file_npwp" width="100" height="auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Penempatan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nomors_id" class="col-sm-2 col-form-label">Nomor Pertandingan</label>
                            <div class="col-sm-10">
                                <select name="nomors_id" id="nomors_id" class="form-control">
                                    @foreach ($nomors as $nomor)
                                        <option value="{{ $nomor->id }}">{{ $nomor->nomor_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_profession" class="col-sm-2 col-form-label">Sertifikat Profesi</label>
                            <div class="col-sm-10">
                                <select name="certificate_profession" id="certificate_profession" class="form-control">
                                    @foreach ($certificates as $certificate)
                                        <option value="{{ $certificate->id }}">{{ $certificate->certificate_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="licence" class="col-sm-2 col-form-label">Peyelengara Lisensi</label>
                            <div class="col-sm-10">
                                <select name="licence" id="licence" class="form-control">
                                    @foreach ($licences as $licence)
                                        <option value="{{ $licence->id }}">{{ $licence->licence_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exp_certificate" class="col-sm-2 col-form-label">Masa berlaku</label>
                            <div class="col-sm-10">
                                <input type="date" name="exp_certificate" id="exp_certificate" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_atlet" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status_atlet" id="status_atlet" class="form-control">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="certificate_file" class="col-form-label">Berkas Sertifikat Profesi</label>
                            <br>
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input certificate_file" id="certificate_file"
                                                        aria-describedby="inputGroupFileAddon01" name="certificate_file" hidden />
                                                    <label for="certificate_file" class="py-2 px-4" style="background-color: #FFC20E;
                                                    color: white;
                                                    
                                                    font-family: sans-serif;
                                                    border-radius: 1rem;
                                                    cursor: pointer;
                                                    margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="preview-image mx-5" id="preview-image">
                                                <img src="{{asset('assets/def_image.svg')}}" alt="default" id="imageLoad_certificate_file" width="100" height="auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('club.judge.index', $club->id) }}"
                        class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#forminput').on('submit', function(e) {

            e.preventDefault();

            let club_id = $('#club_id').val(); // Sport ID

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('nik', $('#nik').val());
            formData.append('judge_name', $('#judge_name').val());
            formData.append('place_born', $('#place_born').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('ktp_address', $('#ktp_address').val());
            formData.append('domicile_address', $('#domicile_address').val());
            formData.append('address', $('#address').val());
            formData.append('phone', $('#phone').val());
            formData.append('email', $('#email').val());
            formData.append('photo_profile', $('#photo_profile').get(0).files[0]);
            formData.append('file_ktp_judge', $('#file_ktp_judge').get(0).files[0]);
            formData.append('file_npwp', $('#file_npwp').get(0).files[0]);
            // formData.append('clubs_id', $('#clubs_id').val());
            formData.append('nomors_id', $('#nomors_id').val());
            formData.append('certificate_profession', $('#certificate_profession').val());
            formData.append('licence', $('#licence').val());
            formData.append('exp_certificate', $('#exp_certificate').val());
            formData.append('certificate_file', $('#certificate_file').get(0).files[0]);
            formData.append('npwp_number', $('#npwp_number').val());
            formData.append('status_atlet', $('#status_atlet').val());

            $.ajax({
                url: "{!! url('club/"+club_id+"/judge') !!}",
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
                        window.location.href = "{!! url('club/"+club_id+"/judge') !!}"
                    } else {
                        alert(res.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        let errors = JSON.parse(xhr.responseText);
                        let msg;

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
        photo_profile.onchange = evt => {
        const [file] = photo_profile.files
            if (file) {
                imageLoad_photo_profile.src = URL.createObjectURL(file)
            }
        }
        file_ktp_judge.onchange = evt => {
        const [file] = file_ktp_judge.files
            if (file) {
                imageLoad_file_ktp_judge.src = URL.createObjectURL(file)
            }
        }
        file_npwp.onchange = evt => {
        const [file] = file_npwp.files
            if (file) {
                imageLoad_file_npwp.src = URL.createObjectURL(file)
            }
        }
        certificate_file.onchange = evt => {
        const [file] = certificate_file.files
            if (file) {
                imageLoad_certificate_file.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
@endsection
