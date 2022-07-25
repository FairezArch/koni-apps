@extends('backend.master')
@section('title', '- Pengaturan Landing Page')
@section('content')
    <div class="container-fluid">
        <div class="wrapper-table p-3 bg-white rounded">
            <form id="forminput" method="POST">
                <div class="form-group">
                    <label for="about_koni" class="col-sm-2 col-form-label">
                        <h4>Tentang KONI</h4>
                    </label>
                    <div class="col-sm-12">
                        <textarea name="about_koni" class="form-control" id="about_koni" cols="30" rows="10"
                            class="w-100">{{ $lists->about_koni }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="koni_profile" class="col-sm-2 col-form-label">
                        <h4>Profil KONI</h4>
                    </label>
                    <div class="col-sm-12">
                        <textarea name="koni_profile" class="form-control" id="koni_profile" cols="30" rows="10"
                            class="w-100">{{ $lists->profile_koni }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="policy" class="col-sm-2 col-form-label">
                        <h4>Kenal Kami</h4>
                    </label>
                    <div class="newRow" id="newRow">
                        @if (!empty($lists->data_users))
                            @php
                                $v =0;
                            @endphp
                            @foreach ( json_decode($lists->data_users) as $listuserRow)
                            @php
                                $v++;
                            @endphp
                            <div id="list-data">   
                                <div class="push-add-data" id="push-add-data-{{$v}}">
                                    <div class="col-sm-12">
                                        <div class="border-bottom border-dark pt-3 pb-3 position-relative">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h5>{{$listuserRow->B_users_name}}</h5>
                                                    <p>{{$listuserRow->D_employ_name}}</p>
                                                </div>
                                                <div class="col-md-5">
                                                    <p>&nbsp;</p>
                                                    <p>Quote</p>
                                                    <textarea name="quote" id="quote_{{$v}}" class="form-control quote" cols="20" rows="5">{{$listuserRow->E_quote}}</textarea>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>&nbsp;</p>
                                                            <p>Deskripsi</p>
                                                        </div>
                                                        <div class="col-md-6 text-right">
                                                            <div id="removeRow">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger pointer" viewBox="0 0 16 16">
                                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <textarea name="desc" id="desc_{{$v}}" class="form-control" cols="20" rows="5">{{$listuserRow->F_desc}}</textarea>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{$listuserRow->A_users_id}}" name="users_id" id="users_id_{{$v}}" />
                                            <input type="hidden" value="{{$listuserRow->C_employ_id}}" name="employ_id" id="employ_id_{{$v}}" />
                                            <input type="hidden" value="{{$listuserRow->B_users_name}}" name="users_name" id="users_name_{{$v}}" />
                                            <input type="hidden" value="{{$listuserRow->D_employ_name}}" name="name_employ" id="name_employ_{{$v}}" />
                                            <input type="hidden" value="{{$listuserRow->G_image_user}}" name="image_user" id="image_user_{{$v}}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="add-some-user mt-4">
                        <p>Tambah</p>
                        <select name="users" id="users_add" class="form-control">
                            @foreach ($listsUser as $listUser)
                                <option value="{{ $listUser }}">{{ $listUser->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let dataLg = $('#list-data .push-add-data').length,
            i = 0,
            semua = [];

        (dataLg > 0) ? i = dataLg : i;
        $('#users_add').on('change', function() {
            i++;
            let spli = $(this).val(),
                parse = JSON.parse(spli);
            let html = `<div id="list-data">   
                        <div class="push-add-data" id="push-add-data-${i}">
                            <div class="col-sm-12">
                                <div class="border-bottom border-dark pt-3 pb-3 position-relative">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h5>${parse['name']}</h5>
                                            <p>${parse['name_employ']}</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>&nbsp;</p>
                                            <p>Quote</p>
                                            <textarea name="quote" id="quote_${i}" class="form-control quote" cols="20" rows="5"></textarea>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p>&nbsp;</p>
                                                    <p>Deskripsi</p>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <div id="removeRow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger pointer" viewBox="0 0 16 16">
                                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="desc" id="desc_${i}" class="form-control" cols="20" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" value="${parse['id']}" name="users_id" id="users_id_${i}" />
                                    <input type="hidden" value="${parse['position']}" name="employ_id" id="employ_id_${i}" />
                                    <input type="hidden" value="${parse['name']}" name="users_name" id="users_name_${i}" />
                                    <input type="hidden" value="${parse['name_employ']}" name="name_employ" id="name_employ_${i}" />
                                    <input type="hidden" value="${parse['photo']}" name="image_user" id="image_user_${i}" />
                                </div>
                            </div>
                        </div>
                    </div>`;
            $('#newRow').append(html);
        })

        $(document).on('click', '#removeRow', function() {
            $(this).closest('#list-data').remove();
        });

        // let formData = 
        $('#forminput').on('submit', function(e) {
            e.preventDefault();

            $('#list-data .push-add-data').map(function(v) {
                v++;
                semua.push({
                    A_users_id: $(`#users_id_${v}`).val(),
                    B_users_name: $(`#users_name_${v}`).val(),
                    C_employ_id: $(`#employ_id_${v}`).val(),
                    D_employ_name: $(`#name_employ_${v}`).val(),
                    E_quote: $(`#quote_${v}`).val(),
                    F_desc: $(`#desc_${v}`).val(),
                    G_image_user: $(`#image_user_${v}`).val(),
                })
            });

            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('about_koni', $('#about_koni').val());
            formData.append('koni_profile', $('#koni_profile').val());
            formData.append('info_person', JSON.stringify(semua));

            $.ajax({
                url: "{{route('set-landing-page.store')}}",
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
                        window.location.href = "{{route('set-landing-page.index')}}"
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
        });
            //console.log(i)
            // (semua !== []) ? window.location.reload : alert('something wrong')
            // if(semua.length > 0){
            //     return window.location.reload();
            // }else{
            //     alert('array kosong')
            // }
            // console.log($('#list-data .push-add-data').length)
            
            // console.log(semua);
            //return;

        // let attHTML = $('.push-add-data').lenght;
        // console.log(attHTML)
    </script>
@endsection
@endsection
