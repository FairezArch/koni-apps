@extends('backend.master')
@section('title', '- Edit Atlet')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <div class="w-100">
                <div class="row">
                    <div class="col-md-8">
                        <h4>Edit Atlet</h4>
                    </div>
                </div>
            </div>
            <h5>Data Personal</h5>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <input type="hidden" name="sport_id" id="sport_id" value="{{ $sport_branch->id }}">
                <input type="hidden" name="club_id" id="club_id" value="{{ $club->id }}">
                <input type="hidden" name="atlet_id" id="atlet_id" value="{{ $lists->id }}">
                <div class="form-group row">
                    <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->nik }}" name="nik" id="nik" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name_atlet" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $lists->users->name }}" name="name_atlet" id="name_atlet"
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
                                <input type="text" value="{{ $lists->users->place_born }}" name="place_born"
                                    id="place_born" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <input type="date" value="{{ $lists->users->date_of_birth }}" name="date_of_birth"
                                    id="date_of_birth" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-none">
                    <label for="ktp_address" class="col-sm-2 col-form-label">Alamat KTP</label>
                    <div class="col-sm-10">
                        <textarea name="ktp_address" class="form-control" id="ktp_address" cols="30" rows="5"
                            class="w-100">{{ $lists->ktp_address }}</textarea>
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
                    <label for="nomor_npwp" class="col-sm-2 col-form-label">Nomor NPWP</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_npwp" value="{{ $lists->nomor_npwp }}" id="nomor_npwp"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row d-none">
                    <label for="nomor_ktp" class="col-sm-2 col-form-label">NIK KTP</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_ktp" value="{{ $lists->nomor_nik_ktp }}" id="nomor_ktp"
                            class="form-control">
                    </div>
                </div>
                <div class="form-group row d-none">
                    <label for="file_sk_training" class="col-sm-2 col-form-label">Foto SK Training</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file_sk_training" id="file_sk_training"
                                    aria-describedby="inputGroupFileAddon01" name="file_sk_training">
                                <label class="custom-file-label" for="file_sk_training">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row d-none">
                    <label for="nomor_sk_training" class="col-sm-2 col-form-label">Nomor SK Training</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_sk_training" value="{{ $lists->nomor_sk_training }}"
                            id="nomor_sk_training" class="form-control">
                    </div>
                </div>
                <div class="row mt-4 mb-4 d-none">
                    @if (!empty($lists->file_ktp_atlet))
                        <div class="col-md-3 text-center">
                            <h6>KTP</h6>
                            <div class="col-sm-12">
                                <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                    style="width: 200px; height: auto;">
                                    <img src='{{ url("storage/atlet/$lists->file_ktp_atlet") }}'
                                        class="img-rounded img-thumbnail" />
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($lists->file_sk_training))
                        <div class="col-md-3 text-center">
                            <h6>SK Training</h6>
                            <div class="col-sm-12">
                                <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                    style="width: 200px; height: auto;">
                                    <img src='{{ url("storage/atlet/$lists->file_sk_training") }}'
                                        class="img-rounded img-thumbnail" />
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($lists->file_npwp))
                        <div class="col-md-3 text-center">
                            <h6>NPWP</h6>
                            <div class="col-sm-12">
                                <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                    style="width: 200px; height: auto;">
                                    <img src='{{ url("storage/atlet/$lists->file_npwp") }}'
                                        class="img-rounded img-thumbnail" />
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($lists->file_atlet_status))
                        <div class="col-md-3 text-center">
                            <h6>Atlet Status</h6>
                            <div class="col-sm-12">
                                <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                    style="width: 200px; height: auto;">
                                    <img src='{{ url("storage/atlet/$lists->file_atlet_status") }}'
                                        class="img-rounded img-thumbnail" />
                                </div>
                            </div>
                        </div>
                    @endif
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
                        @if (!empty($lists->users->photo))
                            <div class="col-md-3 text-center">
                                <h6>KTP</h6>
                                <div class="col-sm-12">
                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                        style="width: 200px; height: auto;">
                                        <img src='{{ asset('storage/users/' . $lists->users->photo) }}'
                                            class="img-rounded img-thumbnail" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_ktp_atlet">Berkas KTP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input file_ktp_atlet" id="file_ktp_atlet"
                                        aria-describedby="inputGroupFileAddon01" name="file_ktp_atlet">
                                    <label class="custom-file-label" for="file_ktp_atlet">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @if (!empty($lists->file_ktp_atlet))
                            <div class="col-md-3 text-center">
                                <h6>KTP</h6>
                                <div class="col-sm-12">
                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                        style="width: 200px; height: auto;">
                                        <img src='{{ asset('storage/atlet/' . $lists->file_ktp_atlet) }}'
                                            class="img-rounded img-thumbnail" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file_npwp">Berkas NPWP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input file_npwp" id="file_npwp"
                                        aria-describedby="inputGroupFileAddon01" name="file_npwp">
                                    <label class="custom-file-label" for="file_npwp">Choose file</label>
                                </div>
                            </div>
                        </div>
                        @if (!empty($lists->file_npwp))
                            <div class="col-md-3 text-center">
                                <h6>KTP</h6>
                                <div class="col-sm-12">
                                    <div class="show-image fade-image-cust d-inline-block" id="show-image"
                                        style="width: 200px; height: auto;">
                                        <img src='{{ asset('storage/atlet/' . $lists->file_npwp) }}'
                                            class="img-rounded img-thumbnail" />
                                    </div>
                                </div>
                            </div>
                        @endif
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
                                        <option value="{{ $nomor->id }}"
                                            {{ $nomor->id == $lists->nomor_id ? 'selected' : '' }}>
                                            {{ $nomor->nomor_code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="training_place" class="col-sm-2 col-form-label">Tempat Latihan</label>
                            <div class="col-sm-10">
                                <textarea name="training_place" class="form-control" id="training_place" cols="30" rows="5"
                                    class="w-100">{{ $lists->training_place }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_atlet" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status_atlet" id="status_atlet" class="form-control">
                                    <option value="1" {{ $lists->status_atlet == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $lists->status_atlet == 0 ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row d-none">
                            <label for="file_atlet_status" class="col-sm-2 col-form-label">Foto Status Atlet</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_atlet_status"
                                            id="file_atlet_status" aria-describedby="inputGroupFileAddon01"
                                            name="file_atlet_status">
                                        <label class="custom-file-label" for="file_atlet_status">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none">
                            <label for="nomor_status_atlet" class="col-sm-2 col-form-label">Nomor Status Atlet</label>
                            <div class="col-sm-10">
                                <input type="text" name="nomor_status_atlet" value="{{ $lists->nomor_status_atlet }}"
                                    id="nomor_status_atlet" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('sport-branch.clubs.atlet.index', [$sport_branch->id, $club->id]) }}"
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

            let sport_id = $('#sport_id').val(), // Sport ID
                club_id = $('#club_id').val(); // Club ID
                atlet_id = $('#atlet_id').val(); // Club ID

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');


            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('name_atlet', $('#name_atlet').val());
            formData.append('nik', $('#nik').val());
            formData.append('place_born', $('#place_born').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('ktp_address', $('#ktp_address').val());
            formData.append('domicile_address', $('#domicile_address').val());
            // formData.append('clubs_id', $('#clubs_id').val());
            formData.append('nomors_id', $('#nomors_id').val());
            formData.append('training_place', $('#training_place').val());
            formData.append('status_atlet', $('#status_atlet').val());
            formData.append('file_ktp_atlet', $('#file_ktp_atlet').get(0).files[0]);
            // formData.append('file_sk_training', $('#file_sk_training').get(0).files[0]);
            formData.append('file_npwp', $('#file_npwp').get(0).files[0]);
            // formData.append('file_atlet_status', $('#file_atlet_status').get(0).files[0]);
            // formData.append('nomor_ktp', $('#nomor_ktp').val());
            formData.append('nomor_sk_training', $('#nomor_sk_training').val());
            formData.append('nomor_npwp', $('#nomor_npwp').val());
            formData.append('nomor_status_atlet', $('#nomor_status_atlet').val());
            formData.append('users_id', "{{ $lists->users_id }}");
            formData.append('address', $('#address').val());
            formData.append('phone', $('#phone').val());
            formData.append('email', $('#email').val());
            formData.append('photo_profile', $('#photo_profile').get(0).files[0]);

            $.ajax({
                url: "{!! url('sport-branch/"+sport_id+"/clubs/"+club_id+"/atlet/"+atlet_id+"') !!}",
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
                        window.location.href = "{!! url('sport-branch/"+sport_id+"/clubs/"+club_id+"/atlet') !!}"
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
        file_ktp_atlet.onchange = evt => {
            const [file] = file_ktp_atlet.files
            if (file) {
                imageLoad_file_ktp_atlet.src = URL.createObjectURL(file)
            }
        }
        file_npwp.onchange = evt => {
            const [file] = file_npwp.files
            if (file) {
                imageLoad_file_npwp.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
@endsection
