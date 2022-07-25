@extends('backend.master')
@section('title', '- Tambah Juri')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Tambah Juri</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
                <h5>Data Personal</h5>
                <div class="row">
                    <div class="col-md-6">
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
                                <textarea name="address" class="form-control" id="address" cols="30" rows="5"
                                    class="w-100"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="file_ktp_judge" class="col-sm-2 col-form-label">Foto KTP</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input file_ktp_judge" id="file_ktp_judge"
                                            aria-describedby="inputGroupFileAddon01" name="file_ktp_judge">
                                        <label class="custom-file-label" for="file_ktp_judge">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h5>NPWP</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="npwp_number" class="col-sm-2 col-form-label">Nomor NPWP</label>
                            <div class="col-sm-10">
                                <input type="text" name="npwp_number" id="npwp_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="npwp_file" class="col-sm-2 col-form-label">Bukti Fisik NPWP</label>
                            <div class="col-sm-10">
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
                            <label for="certificate_number" class="col-sm-2 col-form-label">Nomor Sertifikat</label>
                            <div class="col-sm-10">
                                <input type="text" name="certificate_number" id="certificate_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="certificate_profession" class="col-sm-2 col-form-label">Sertifikat Profesi</label>
                            <div class="col-sm-10">
                                <select name="certificate_profession" id="certificate_profession" class="form-control">
                                    @foreach ($certificates as $certificate)
                                        <option value="{{ $certificate->id }}">{{ $certificate->certificate_name }}</option>
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
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="certificate_file" class="col-sm-2 col-form-label">Bukti Fisik Sertifikat</label>
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
                <div class="text-right">
                    <a href="{{ route('judge.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
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

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('nik', $('#nik').val());
            formData.append('judge_name', $('#judge_name').val());
            formData.append('email', $('#email').val());
            formData.append('place_born', $('#place_born').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('domicile_address', $('#domicile_address').val());
            formData.append('address', $('#address').val());
            formData.append('npwp_number', $('#npwp_number').val());
            formData.append('sports_id', $('#sports_id').val());
            formData.append('certificate_number', $('#certificate_number').val());
            formData.append('certificate_profession', $('#certificate_profession').val());
            formData.append('licence', $('#licence').val());
            formData.append('exp_certificate', $('#exp_certificate').val());
            formData.append('file_ktp_judge', $('#file_ktp_judge').get(0).files[0]);
            formData.append('npwp_file', $('#npwp_file').get(0).files[0]);
            formData.append('certificate_file', $('#certificate_file').get(0).files[0]);

            $.ajax({
                url: "{{ route('judge.store') }}",
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
                        window.location.href = "{{ route('judge.index') }}"
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
