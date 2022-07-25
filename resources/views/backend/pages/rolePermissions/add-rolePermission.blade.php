@extends('backend.master')
@section('title', '- Role Permission')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h4>Tambah Role Permission</h4>
        <form id="forminput" class="forminput mt-3 mb-3">
            @csrf
            <div class="form-group">
                <label for="role_name">Role</label>
                <input type="text" class="form-control" id="role_name" name="role_name" aria-describedby="role_name" placeholder="Peran">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-xs-12 col-sm-12">
                <div class="row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th rowspan="2" class="text-center border center_table" scope="col">Permission</th>
                                <th colspan="5" class="text-center border-right" scope="col">Open Permission</th>
                            </tr>
                            <tr>
                                <td class="text-center border" style="width: 150px;" scope="col">List</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Create</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Update</td>
                                <td class="text-center border" style="width: 150px;" scope="col">View</td>
                                <td class="text-center border" style="width: 150px;" scope="col">Delete</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($parent_menu as $menu)
                            <tr>
                                <td scope="row">{{$menu->name_menu}}</td>
                                @foreach($permissions as $permission)
                                @if($menu->id == $permission->parent)
                                <td class="text-center" scope="row">
                                    <input type="checkbox" id="click" class="permission" id="permission" name="permission" value="{{$permission->id}}">
                                </td>
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @error('permission')
                <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-right">
                <a href="{{route('rolepermission.index')}}" class="btn btn-danger p-2 rounded">Kembali</a>
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

        let permissionCheckbox = [];
        $("input:checkbox[name=permission]:checked").each(function(){
            permissionCheckbox.push($(this).val());
        });

        let permissionCheckboxs = JSON.stringify(permissionCheckbox)

        let formData = new FormData();
            formData.append('name',$('#role_name').val());
            formData.append('permission',permissionCheckboxs);
            
        $.ajax({
            url: "{{route('rolepermission.store')}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData, 
            beforeSend: function() {
                elm.html('<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...')
            },
            success: function(res) {
                if(res.success == true){
                    window.location.href="{{route('rolepermission.index')}}"
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