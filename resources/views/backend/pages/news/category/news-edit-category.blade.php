@extends('backend.master')
@section('title', '- Kategori Berita')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h4>Edit Kategori Berita</h4>
        <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="{{$lists->id}}" />
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="category_name" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" name="category_name" value="{{$lists->category_name}}" id="category_name" class="form-control" placeholder="Masukkan Kategori...">
                        </div>
                    </div>                   
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="file_category" class="col-sm-2 col-form-label">Foto Kategori</label>
                        <div class="col-sm-10">
                            <div class="position-relative custom-file">
                                <input type="file" name="file_category" id="file_category" class="file custom-file-input" />
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    @if (!empty($lists->file_category))    
                    <div class="form-group row">
                        <label for="showfile" class="col-sm-2 col-form-label">&nbsp;</label>
                        <div class="col-sm-10">
                            <div class="show-image fade-image-cust d-inline-block" id="show-image" style="width: 50px; height: auto;">
                                <img src='{{url("storage/categorynews/$lists->file_category")}}' class="img-fluid img-thumbnail" />
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <a href="{{route('tidings-category.index')}}" class="btn btn-danger p-2 rounded">Kembali</a>
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
            formData.append('_method','PUT');
            formData.append('id',$('#id').val());
            formData.append('category_name',$('#category_name').val());
            formData.append('file_category',$('#file_category').get(0).files[0]);
            
        $.ajax({
            url: "{{route('tidings-category.update',$lists->id)}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData, 
            beforeSend: function() {
                elm.html('<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...')
            },
            success: function(res) {
                if(res.success == true){
                    window.location.href="{{route('tidings-category.index')}}"
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