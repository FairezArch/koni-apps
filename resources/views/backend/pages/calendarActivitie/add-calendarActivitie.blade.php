@extends('backend.master')
@section('title', '- Tambah Event')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Tambah Event</h4>
            <form id="forminput" class="forminput mt-3 mb-3">
                <div class="form-group row">
                    <label for="name_match" class="col-sm-2 col-form-label">Pertandingan</label>
                    <div class="col-sm-10">
                        <input type="text" name="name_match" id="name_match" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sports_id" class="col-sm-2 col-form-label">Cabang Olahraga</label>
                    <div class="col-sm-10">
                        <select name="sports_id" id="sports_id" class="sports_id form-control">
                            @foreach ($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->sportbranch_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="match_time" class="col-sm-2 col-form-label">Waktu Pertandingan</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date_from">Mulai Pertandingan</label>
                                        <input type="date" name="date_from" id="date_from" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="time" id="datetime_from" name="datetime_from">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="date_to">Selesai Pertandingan</label>
                                        <input type="date" name="date_to" id="date_to" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="time" id="date_time_to" name="date_time_to">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="match_time" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                        <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
                        <small class="text-danger">Masukkan lokasi dari google maps</small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="file_event" class="col-sm-2 col-form-label">Berkas Event</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file_event" id="file_event"
                                    aria-describedby="inputGroupFileAddon01" name="file_event">
                                <label class="custom-file-label" for="file_event">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('calendar-activitie.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
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
            formData.append('name_match', $('#name_match').val());
            formData.append('sports_id', $('#sports_id').val());
            // formData.append('countrie', $('#countrie').val());
            // formData.append('state', $('#state').val());
            // formData.append('citie', $('#citie').val());
            formData.append('date_from', $('#date_from').val());
            formData.append('date_to', $('#date_to').val());
            formData.append('datetime_from', $('#datetime_from').val());
            formData.append('date_time_to', $('#date_time_to').val());
            formData.append('address', $('#address').val());
            formData.append('file_event', $('#file_event').get(0).files[0]);

            $.ajax({
                url: "{{ route('calendar-activitie.store') }}",
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
                        window.location.href = "{{ route('calendar-activitie.index') }}"
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
