@extends('backend.master')
@section('title', '- Atlet')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
            <div class="row border-bottom border-danger mb-3">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="name_atlet" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ $lists->users->name }}" name="name_atlet" id="name_atlet" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-2 col-form-label">NIK</label>
                        <div class="col-sm-10">
                            <input type="text" value="{{ $lists->nik }}" name="nik" id="nik" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="place_born" class="col-sm-2 col-form-label">TTL</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-7">
                                    <input type="text" disabled value="{{ $lists->users->place_born }}" name="place_born" id="place_born" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <input type="date" disabled value="{{ $lists->users->date_of_birth }}" name="date_of_birth" id="date_of_birth" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ktp_address" class="col-sm-2 col-form-label">Alamat KTP</label>
                        <div class="col-sm-10">
                            <textarea name="ktp_address" disabled class="form-control" id="ktp_address" cols="30" rows="5" class="w-100">{{ $lists->ktp_address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="domicile_address" class="col-sm-2 col-form-label">Alamat Domisili</label>
                        <div class="col-sm-10">
                            <textarea name="domicile_address" disabled class="form-control" id="domicile_address" cols="30" rows="5" class="w-100">{{ $lists->domicile_address }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="section_one" class="form-control" id="section_one">
                                <option value="1">Disetujui</option>
                                <option value="2">Di Tolak</option>
                                <option value="3">Dokumen Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if (!empty($lists->file_ktp_atlet))
                    <div class="col-md-3 text-center">
                        <h6>KTP</h6>
                        <div class="col-sm-12">
                            <div class="show-image fade-image-cust d-inline-block" id="show-image" style="width: 200px; height: auto;">
                                <img src='{{ url("storage/atlet/$lists->file_ktp_atlet") }}' class="img-rounded img-thumbnail" />
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row border-bottom border-danger mb-3">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="nomor_npwp" class="col-sm-2 col-form-label">Nomor NPWP</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_npwp" value="{{$lists->nomor_npwp}}" id="nomor_npwp" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="section_two" class="form-control" id="section_two">
                                <option value="1">Disetujui</option>
                                <option value="2">Di Tolak</option>
                                <option value="3">Dokumen Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
                </div>
            </div>
            <div class="row border-bottom border-danger mb-3">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="sports_id" class="col-sm-2 col-form-label">Cabang Olahraga</label>
                        <div class="col-sm-10">
                            <select name="sports_id" id="sports_id" class="form-control" disabled>
                                @foreach ($sports as $res)
                                    <option value="{{ $res->id }}"
                                        {{ $res->id == $lists->sports_id ? 'selected' : '' }}>
                                        {{ $res->sportbranch_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clubs_id" class="col-sm-2 col-form-label">Klub</label>
                        <div class="col-sm-10">
                            <select name="clubs_id" id="clubs_id" class="form-control" disabled>
                                @foreach ($clubs as $club)
                                    <option value="{{ $club->id }}"
                                        {{ $club->id == $lists->clubs_id ? 'selected' : '' }}>
                                        {{ $club->club_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomors_id" class="col-sm-2 col-form-label">Nomor</label>
                        <div class="col-sm-10">
                            <select name="nomors_id" id="nomors_id" class="form-control" disabled>
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
                            <textarea name="training_place" class="form-control" id="training_place" cols="30"
                                rows="5" class="w-100" disabled>{{ $lists->domicile_address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor_sk_training" class="col-sm-2 col-form-label">Nomor SK Training</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_sk_training" disabled value="{{$lists->nomor_sk_training}}" id="nomor_sk_training" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="section_there" class="form-control" id="section_there">
                                <option value="1">Disetujui</option>
                                <option value="2">Di Tolak</option>
                                <option value="3">Dokumen Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="nomor_status_atlet" class="col-sm-2 col-form-label">Nomor Status Atlet</label>
                        <div class="col-sm-10">
                            <input type="text" name="nomor_status_atlet" disabled value="{{$lists->nomor_status_atlet}}" id="nomor_status_atlet" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="section_four" class="form-control" id="section_four">
                                <option value="1">Disetujui</option>
                                <option value="2">Di Tolak</option>
                                <option value="3">Dokumen Tidak Lengkap</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
            </div>
            
            <div class="text-right">
                <a href="{{ route('atlet-need-verif.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
                <button class="btn btn-danger p-2 rounded" id="disagre_formData">Belum disetujui</button>
                <button class="btn btn-success p-2 rounded" id="agre_formData">Disetujui</button>
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

    $('#disagre_formData').on('click', function(e) {

        e.preventDefault();


        let elm = $('#disagre_formData');
        elm.attr('disabled', 'disabled');


        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('status_verif', 0);
        formData.append('section_one', $('#section_one').val());
        formData.append('section_two', $('#section_two').val());
        formData.append('section_there', $('#section_there').val());
        formData.append('section_four', $('#section_four').val());

        $.ajax({
            url: "{{ route('atlet-need-verif.update', $lists->id) }}",
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
                    window.location.href = "{{ route('atlet-need-verif.index') }}"
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
                elm.html('Belum disetujui')
                elm.removeAttr('disabled')
                console.log(xhr.responseText)
            },
            complete: function() {
                elm.html('Belum disetujui')
                elm.removeAttr('disabled')
            }
        })

    })

    $('#agre_formData').on('click', function(e) {

        e.preventDefault();


        let elm = $('#agre_formData');
        elm.attr('disabled', 'disabled');


        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('status_verif', 1);
        formData.append('section_one', $('#section_one').val());
        formData.append('section_two', $('#section_two').val());
        formData.append('section_there', $('#section_there').val());
        formData.append('section_four', $('#section_four').val());

        $.ajax({
            url: "{{ route('atlet-need-verif.update', $lists->id) }}",
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
                    window.location.href = "{{ route('atlet-need-verif.index') }}"
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
                elm.html('Disetujui')
                elm.removeAttr('disabled')
                console.log(xhr.responseText)
            },
            complete: function() {
                elm.html('Disetujui')
                elm.removeAttr('disabled')
            }
        })

    })
</script>
@endsection
@endsection