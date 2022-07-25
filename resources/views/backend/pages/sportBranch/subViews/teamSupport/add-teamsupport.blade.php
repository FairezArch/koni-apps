@extends('backend.master')
@section('title', '- Pengguna')
@section('content')
<div class="container-fluid">
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <h4>Tambah Pengguna</h4>
        <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data">
            <input type="hidden" name="sport" id="sport" value="{{ $sport_branch->id }}">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama Anda...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="labelfile" class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-sm-10">
                            <div class="position-relative custom-file">
                                <input type="file" name="photo" id="photo" class="file custom-file-input" />
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ttl" class="col-sm-2 col-form-label">TTL</label>
                        <div class="row col-sm-10">
                            <div class="col-md-7">
                                <input type="text" name="placeBorn" id="placeBorn" class="form-control placeBorn" />
                            </div>
                            <div class="col-md-5">
                                <input type="date" name="dateBorn" id="dateBorn" class="form-control dateBorn" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select name="gender" id="gender" class="form-control">
                                <option value="1">Laki-laki</option>
                                <option value="2">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="address" class="form-control" id="address" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sk_no" class="col-sm-2 col-form-label">Nomor SK</label>
                        <div class="col-sm-10">
                            <input type="text" name="sk_no" id="sk_no" class="form-control" placeholder="Masukkan No SK..." />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="labelfile" class="col-sm-2 col-form-label">Lampiran SK</label>
                        <div class="col-sm-10">
                            <div class="position-relative custom-file">
                                <input type="file" name="sk_file" id="sk_file" class="file custom-file-input" />
                                <label class="custom-file-label" for="fileInput">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="datefrom" class="col-md-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="datefrom" id="datefrom" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="dateto" id="dateto" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="position" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-10">
                            <select name="position" id="position" class="form-control">
                                @foreach ( $employs as $employ)
                                <option value="{{$employ->id}}">{{$employ->name_employ}}</option>                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <select name="role" id="role" class="form-control">
                                @foreach($role as $list)
                                <option value="{{$list->roles->id}}">{{ucfirst($list->roles->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" id="status" class="form-control status">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" id="phone" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pass" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="pass" id="pass" class="form-control" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a href="{{route('sport-branch.team-support.index', $sport_branch->id)}}" class="btn btn-danger p-2 rounded">Kembali</a>
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
            formData.append('name',$('#name').val());
            formData.append('photo',$('#photo').get(0).files[0]);
            formData.append('placeBorn',$('#placeBorn').val());
            formData.append('dateBorn',$('#dateBorn').val());
            formData.append('gender',$('#gender').val());
            formData.append('address',$('#address').val());
            formData.append('sk_no',$('#sk_no').val());
            formData.append('sk_file',$('#sk_file').get(0).files[0]);
            formData.append('datefrom',$('#datefrom').val());
            formData.append('dateto',$('#dateto').val());
            formData.append('position',$('#position').val());
            formData.append('role',$('#role').val());
            formData.append('status',$('#status').val());
            formData.append('phone',$('#phone').val());
            formData.append('email',$('#email').val());
            formData.append('password',$('#pass').val());
            formData.append('sport_id',$('#sport').val());

        $.ajax({
            url: "{{route('sport-branch.team-support.store', $sport_branch->id)}}",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData, 
            beforeSend: function() {
                elm.html('<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...')
            },
            success: function(res) {
                if(res.success == true){
                    window.location.href="{{route('sport-branch.team-support.index', $sport_branch->id)}}"
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