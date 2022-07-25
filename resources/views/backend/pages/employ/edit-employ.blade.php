@extends('backend.master')
@section('title', '- Edit Jabatan')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Jabatan</h4>
            <form id="forminput" class="forminput mt-3 mb-3">
                <div class="form-group row">
                    <label for="name_employ" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" name="name_employ" value="{{$lists->name_employ}}" id="name_employ" class="form-control">
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('employ.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
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
            formData.append('_method','PUT');
            formData.append('name_employ', $('#name_employ').val());

            $.ajax({
                url: "{{route('employ.update',$lists->id)}}",
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
                        window.location.href = "{{route('employ.index')}}"
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
