@extends('backend.master')
@section('title', '- Tambah Pelatih')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Tambah Pelatih</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <h5>Data Personal</h5>
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" name="nik" id="nik" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="trainer_name" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" name="trainer_name" id="trainer_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="email" class="form-control">
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
                            <label for="photo_profile">Foto Diri</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input photo_profile" id="photo_profile"
                                        aria-describedby="inputGroupFileAddon01" name="photo_profile">
                                    <label class="custom-file-label" for="photo_profile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_ktp_trainner">Foto KTP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input file_ktp_trainner" id="file_ktp_trainner"
                                        aria-describedby="inputGroupFileAddon01" name="file_ktp_trainner">
                                    <label class="custom-file-label" for="file_ktp_trainner">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="npwp_file">Bukti Fisik NPWP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input npwp_file" id="npwp_file"
                                        aria-describedby="inputGroupFileAddon01" name="npwp_file">
                                    <label class="custom-file-label" for="npwp_file">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>Penempatan</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="sports_id" class="col-sm-2 col-form-label">Cabang Olahraga</label>
                            <div class="col-sm-10">
                                <select name="sports_id" id="sports_id" class="form-control">
                                    @foreach ($sports as $res)
                                        <option value="{{ $res->id }}">{{ $res->sportbranch_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="clubs_id" class="col-sm-2 col-form-label">Klub</label>
                            <div class="col-sm-10">
                                <select name="clubs_id" id="clubs_id" class="form-control">
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}">{{ $club->club_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nomors_id" class="col-sm-2 col-form-label">Nomor</label>
                            <div class="col-sm-10">
                                <select name="nomors_id" id="nomors_id" class="form-control">
                                    @foreach ($nomors as $nomor)
                                        <option value="{{ $nomor->id }}">{{ $nomor->nomor_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_trainner" class="col-sm-2 col-form-label">Status Pelatih</label>
                            <div class="col-sm-10">
                                <select name="status_trainner" id="status_trainner" class="form-control">
                                    @foreach ($status_trainners as $status_trainner)
                                        <option value="{{ $status_trainner->id }}">
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
                                    @foreach ($certificate_professions as $certificate_profession)
                                        <option value="{{ $certificate_profession->id }}">
                                            {{ $certificate_profession->certificate_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="support_trainner" class="col-sm-2 col-form-label">Pendukung Pelatih</label>
                            <div class="col-sm-10">
                                <select name="support_trainner[]" id="support_trainner"
                                    class="form-control js-basic-multiple" multiple>
                                    @foreach ($support_trainners as $support_trainner)
                                        <option value="{{ $support_trainner->id }}">
                                            {{ $support_trainner->support_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="certificate_profession_file">Berkas Setifikat Profesi</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input certificate_profession_file"
                                        id="certificate_profession_file" aria-describedby="inputGroupFileAddon01"
                                        name="certificate_profession_file">
                                    <label class="custom-file-label" for="certificate_profession_file">Choose
                                        file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-none">
                        <div class="form-group row">
                            <label for="training_place" class="col-sm-2 col-form-label">Tempat Pelatih</label>
                            <div class="col-sm-10">
                                <select name="training_place" id="training_place" class="form-control">
                                    @foreach ($training_places as $training_place)
                                        <option value="{{ $training_place->id }}">{{ $training_place->place_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_number_trainer" class="col-sm-2 col-form-label">Nomor Sertifikat Tempat
                                Melatih</label>
                            <div class="col-sm-10">
                                <input type="text" name="certificate_number_trainer" id="certificate_number_trainer"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_file" class="col-sm-2 col-form-label">Bukti Fisik Penempatan</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input certificate_file" id="certificate_file"
                                            aria-describedby="inputGroupFileAddon01" name="certificate_file">
                                        <label class="custom-file-label" for="certificate_file">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="d-none">Sertifikat Profesi</h5>
                <div class="row d-none">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="certificate_number" class="col-sm-2 col-form-label">Nomor Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" name="certificate_number" id="certificate_number"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('trainner.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-basic-multiple').select2();
        });
    </script>
    <script type="text/javascript">
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
            formData.append('trainer_name', $('#trainer_name').val());
            formData.append('place_born', $('#place_born').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('nik', $('#nik').val());
            formData.append('domicile_address', $('#domicile_address').val());
            formData.append('address', $('#address').val());
            formData.append('file_ktp_trainner', $('#file_ktp_trainner').get(0).files[0]);
            formData.append('npwp_number', $('#npwp_number').val());
            formData.append('npwp_file', $('#npwp_file').get(0).files[0]);
            formData.append('sports_id', $('#sports_id').val());
            formData.append('clubs_id', $('#clubs_id').val());
            formData.append('nomors_id', $('#nomors_id').val());
            formData.append('status_trainner', $('#status_trainner').val());
            formData.append('support_trainner', JSON.stringify($('#support_trainner').val()));
            formData.append('certificate_number_trainer', $('#certificate_number_trainer').val());
            formData.append('training_place', $('#training_place').val());
            formData.append('certificate_file', $('#certificate_file').get(0).files[0]);
            formData.append('certificate_profession', $('#certificate_profession').val());
            formData.append('certificate_number', $('#certificate_number').val());
            formData.append('certificate_profession_file', $('#certificate_profession_file').get(0).files[0]);
            formData.append('email', $('#email').val());
            formData.append('phone', $('#phone').val());
            formData.append('photo_profile', $('#photo_profile').get(0).files[0]);

            $.ajax({
                url: "{{ route('trainner.store') }}",
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
                        window.location.href = "{{ route('trainner.index') }}"
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
