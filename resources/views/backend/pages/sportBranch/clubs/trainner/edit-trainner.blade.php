@extends('backend.master')
@section('title', '- Edit Pelatih')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Edit Pelatih</h4>
            <h5>Data Personal</h5>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <input type="hidden" name="sport_id" id="sport_id" value="{{ $sport_branch->id }}">
                <input type="hidden" name="club_id" id="club_id" value="{{ $club->id }}">
                <input type="hidden" name="trainer_id" id="trainer_id" value="{{ $lists->id }}">
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->nik_trainner }}" name="nik" id="nik" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="trainer_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->users->name }}" name="trainer_name" id="trainer_name"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" value="{{ $lists->users->email }}" name="email" id="email"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->users->phone_number }}" name="phone" id="phone"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="place_born" class="col-sm-2 col-form-label">TTL</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" value="{{ $lists->users->place_born }}" name="place_born" id="place_born"
                                    class="form-control">
                            </div>
                            <div class="col-md-5">
                                <input type="date" value="{{ $lists->users->date_of_birth }}" name="date_of_birth"
                                    id="date_of_birth" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="domicile_address" class="col-sm-2 col-form-label">Domisili</label>
                    <div class="col-sm-10">
                        <select name="domicile_address" id="domicile_address" class="form-control">
                            <option value="1" {{ $lists->domicile == 1 ? 'selected' : '' }}>Dalam Kota</option>
                            <option value="2" {{ $lists->domicile == 2 ? 'selected' : '' }}>Luar Kota</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea name="address" class="form-control" id="address" cols="30" rows="5"
                            class="w-100">{{ $lists->users->address }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nomor_npwp" class="col-sm-2 col-form-label">NPWP</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->nik_trainner }}" name="nomor_npwp" id="nomor_npwp"
                            class="form-control">
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
                                                    <input type="file" class="custom-file-input photo_profile"
                                                        id="photo_profile" aria-describedby="inputGroupFileAddon01"
                                                        name="photo_profile" hidden />
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
                                            @if (!empty($lists->users->photo))
                                            <div class="col-md-3 text-center">
                                                
                                                <div class="col-sm-12">
                                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                        style="width: 150px; height: auto;">
                                                        <img src='{{ asset('storage/users/' . $lists->users->photo) }}'
                                                            class="img-rounded img-thumbnail" id="imageLoad_photo_profile" />
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_ktp_trainner" class="col-form-label">Berkas KTP</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input file_ktp_trainner"
                                                        id="file_ktp_trainner" aria-describedby="inputGroupFileAddon01"
                                                        name="file_ktp_trainner" hidden />
                                                    <label for="file_ktp_trainner" class="py-2 px-4" style="background-color: #FFC20E;
                                                        color: white;
                                                        
                                                        font-family: sans-serif;
                                                        border-radius: 1rem;
                                                        cursor: pointer;
                                                        margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @if (!empty($lists->file_ktp_trainner))
                                            <div class="col-md-3 text-center">
                                                
                                                <div class="col-sm-12">
                                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                        style="width: 150px; height: auto;">
                                                        <img src='{{ asset('storage/trainer/' . $lists->file_ktp_trainner) }}'
                                                            class="img-rounded img-thumbnail" id="imageLoad_file_ktp_trainner" />
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
                                            @if (!empty($lists->file_npwp_trainner))
                                            <div class="col-md-3 text-center">
                                                
                                                <div class="col-sm-12">
                                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                        style="width: 150px; height: auto;">
                                                        <img src='{{ asset('storage/trainer/' . $lists->file_npwp_trainner) }}'
                                                            class="img-rounded img-thumbnail" id="imageLoad_file_npwp" />
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
                <h5>Penempatan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="nomors_id" class="col-sm-2 col-form-label">Nomor Pertandingan</label>
                            <div class="col-sm-10">
                                <select name="nomors_id" id="nomors_id" class="form-control">
                                    @foreach ($nomors as $nomor)
                                        <option value="{{ $nomor->id }}" {{ $lists->nomors_id == $nomor->id ? 'selected' : '' }} >{{ $nomor->nomor_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_trainner" class="col-sm-2 col-form-label">Status Pelatih</label>
                            <div class="col-sm-10">
                                <select name="status_trainner" id="status_trainner" class="form-control">
                                    @foreach ($status_trainners as $status_trainner)
                                        <option value="{{ $status_trainner->id }}" {{ $lists->status_trainners_id == $status_trainner->id ? 'selected' : '' }}>
                                            {{ $status_trainner->status_trainner }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_profession" class="col-sm-2 col-form-label">Sertifikat Profesi</label>
                            <div class="col-sm-10">
                                <select name="certificate_profession" id="certificate_profession" class="form-control">
                                    @foreach ($certificates as $certificate)
                                        <option value="{{ $certificate->id }}" {{ $lists->certificate_professions_id == $certificate->id ? 'selected' : '' }} >{{ $certificate->certificate_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_atlet" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status_atlet" id="status_atlet" class="form-control">
                                    <option value="1" {{ $lists->status == 1 ? 'selected' : '' }} >Aktif</option>
                                    <option value="0" {{ $lists->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="certificate_file" class="col-form-label">Berkas NPWP</label>
                            <br />
                            <small>Gambar dengan tipe file PNG dan JPG</small>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input certificate_file"
                                                        id="certificate_file" aria-describedby="inputGroupFileAddon01"
                                                        name="certificate_file" hidden />
                                                    <label for="certificate_file" class="py-2 px-4" style="background-color: #FFC20E;
                                                        color: white;
                                                        
                                                        font-family: sans-serif;
                                                        border-radius: 1rem;
                                                        cursor: pointer;
                                                        margin-top: 1rem;">Upload</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            @if (!empty($lists->file_certificate_profession))
                                            <div class="col-md-3 text-center">
                                                <div class="form-group row">
                                                    <label for="showfile" class="col-sm-2 col-form-label">&nbsp;</label>
                                                    <div class="col-sm-10">
                                                        <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                                            style="width: 150px; height: auto;">
                                                            <img src='{{ asset("storage/trainer/".$lists->file_certificate_profession) }}'
                                                                class="img-rounded img-thumbnail" id="imageLoad_certificate_file" />
                                                        </div>
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
                    <a href="{{ route('sport-branch.clubs.trainer.index', [$sport_branch->id, $club->id]) }}"
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

            let sport_id = $('#sport_id').val(); // Sport ID
            let club_id = $('#club_id').val(); // Club ID
            let trainer_id = $('#trainer_id').val(); // Trainer ID

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('nik', $('#nik').val());
            formData.append('trainer_name', $('#trainer_name').val());
            formData.append('place_born', $('#place_born').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('ktp_address', $('#ktp_address').val());
            formData.append('domicile_address', $('#domicile_address').val());
            formData.append('address', $('#address').val());
            formData.append('phone', $('#phone').val());
            formData.append('email', $('#email').val());
            formData.append('photo_profile', $('#photo_profile').get(0).files[0]);
            formData.append('file_ktp_trainner', $('#file_ktp_trainner').get(0).files[0]);
            formData.append('file_npwp', $('#file_npwp').get(0).files[0]);
            // formData.append('clubs_id', $('#clubs_id').val());
            formData.append('nomors_id', $('#nomors_id').val());
            formData.append('certificate_profession', $('#certificate_profession').val());
            formData.append('status_trainner', $('#status_trainner').val());
            formData.append('status_atlet', $('#status_atlet').val());
            formData.append('certificate_file', $('#certificate_file').get(0).files[0]);
            formData.append('nomor_npwp', $('#nomor_npwp').val());
            formData.append('users_id', "{{ $lists->users_id }}");

            // formData.append('file_atlet_status', $('#file_atlet_status').get(0).files[0]);
            // formData.append('nomor_ktp', $('#nomor_ktp').val());
            // formData.append('nomor_sk_training', $('#nomor_sk_training').val());
            // formData.append('nomor_status_atlet', $('#nomor_status_atlet').val());


            $.ajax({
                url: "{!! url('sport-branch/"+sport_id+"/clubs/"+club_id+"/trainer/"+trainer_id+"') !!}",
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
                        window.location.href = "{!! url('sport-branch/"+sport_id+"/clubs/"+club_id+"/trainer') !!}"
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
@endsection
@endsection
