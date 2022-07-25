@extends('backend.master')
@section('title', '- Tempat Pelatihan')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h4>Tambah Tempat Pelatihan</h4>
        <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="place_name" class="col-sm-2 col-form-label">Nama Tempat</label>
                <div class="col-sm-10">
                    <textarea name="place_name" id="place_name" class="form-control" cols="30" rows="5"></textarea>
                </div>
            </div>      
            <div class="text-right">
                <a href="{{route('training-place.index')}}" class="btn btn-danger p-2 rounded">Kembali</a>
                <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
            </div>
        </form>
    </div>
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
            formData.append('place_name',$('#place_name').val());
            // formData.append('file_training',$('#file_training').get(0).files[0]);
            
        $.ajax({
            url: "{{route('training-place.store')}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData, 
            beforeSend: function() {
                elm.html('<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...')
            },
            success: function(res) {
                if(res.success == true){
                    window.location.href="{{route('training-place.index')}}"
                }else{
                    alert(res.message);
                }
            },
            error: function(xhr) {
                if (xhr.status == 422) {
                    let errors = JSON.parse(xhr.responseText);
                    let msg;
                   
                    $.each(errors.errors, function(key, value){
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