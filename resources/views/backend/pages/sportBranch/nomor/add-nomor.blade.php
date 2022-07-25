@extends('backend.master')
@section('title', '- Tambah Nomor')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Nomor</h4>
            <form id="forminput" class="forminput mt-3 mb-3">
                <input type="hidden" name="sport_id" id="sport_id" value="{{ $sport_branch->id }}">
                <div class="form-group row">
                    <label for="nomor_code" class="col-sm-2 col-form-label">Nomor</label>
                    <div class="col-sm-10">
                        <input type="text" name="nomor_code" id="nomor_code" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control status">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('sport-branch.nomor.index', $sport_branch->id) }}" class="btn btn-danger p-2 rounded">Kembali</a>
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

            let elm = $('#save_formData');
                elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('nomor_code', $('#nomor_code').val());
            formData.append('status', $('#status').val());

            $.ajax({
                url: "{!! url('sport-branch/"+sport_id+"/nomor') !!}",
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
                        window.location.href = "{!! url('sport-branch/"+sport_id+"/nomor') !!}"
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
@endsection
@endsection
