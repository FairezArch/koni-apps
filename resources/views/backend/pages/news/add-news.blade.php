@extends('backend.master')
@section('title', '- Tambah Berita')
@section('content')
    <div class="container-fluid">
        <div class="shadow-sm p-3 mb-5 bg-white rounded">
            <h4>Tambah Berita</h4>
            <form id="forminput" class="forminput mt-3 mb-3" enctype="multipart/form-data"
                onkeydown="return event.key != 'Enter';">
                <input type="hidden" name="type_news" id="type_news" class="type_news" value="{{ $option }}" />
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" id="title" class="form-control" placeholder="Judul berita...">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="short_content" class="col-sm-2 col-form-label">Konten Singkat</label>
                    <div class="col-sm-10">
                        <textarea name="short_content" class="form-control" id="short_content" cols="30" rows="5"
                            class="w-100"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content_news" class="col-sm-2 col-form-label">Konten</label>
                    <div class="col-sm-10">
                        <textarea name="content_news" class="form-control" id="content_news" cols="30" rows="10"
                            class="w-100"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_news_id" class="col-sm-2 col-form-label">Gambar Utama</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input file_news" id="file_news"
                                    aria-describedby="inputGroupFileAddon01" name="file_news[]" multiple>
                                <label class="custom-file-label" for="file_news">Choose file</label>
                            </div>
                        </div>
                        <div id="preview"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hashtags" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input type="text" name="hashtags" id="hashtags" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">&nbsp;</div>
                    <div class="col-sm-10">
                        <div id="list_hastag" class="row"></div>
                    </div>
                </div>
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
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <label for="date_from_news" class="col-sm-4 col-form-label">Tanggal</label>
                                <div class="col-sm-8">
                                    <input type="date" name="date_from_news" id="date_from_news" class="form-control"
                                        value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <label for="category_news_id" class="col-sm-4 col-form-label">Kategori Berita</label>
                                <div class="col-sm-8">
                                    <select name="category_news_id" id="category_news_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @hasanyrole('superadmin|koni|humaskoni')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label for="sports_id" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm-8">
                                        <select name="status_news" id="status_news" class="form-control">
                                            <option value="3">Menunggu Konfirmasi</option>
                                            <option value="2">Ditolak</option>
                                            <option value="1">Diterima</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-none" id="reason-form">
                        <label for="reason" class="col-sm-2 col-form-label">Alasan ditolak</label>
                        <div class="col-sm-10">
                            <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                    </div>
                @else
                @endhasanyrole
                <div class="text-right">
                    <a href="{{ route('tidings.index') }}" class="btn btn-danger p-2 rounded">Kembali</a>
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        let content = document.getElementById("content_news");
        CKEDITOR.replace(content, {
            language: 'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
    </script>
    <script type="text/javascript">
        let appendHastag = [];
        document.querySelector('#hashtags').addEventListener("keydown", function(e) {
            if (e.keyCode == 13) {
                let div = document.getElementById("list_hastag");
                let wrapper = document.createElement('div');
                wrapper.className = 'col-md-3';
                wrapper.innerHTML = `<p class="max-char-length">${$(this).val()}</p>`;
                div.append(wrapper);
                appendHastag.push($(this).val());
                $(this).val('');
            }
        })
        @hasanyrole('superadmin|koni|humaskoni')
            let statusNews = document.getElementById('status_news').addEventListener('change', (e) => {
            (e.target.value == 2)
            ? document.getElementById('reason-form').classList.remove('d-none'): document
            .getElementById('reason-form').classList.add('d-none');
            });
        @else
        @endhasanyrole


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#forminput').on('submit', function(e) {

            e.preventDefault();

            let ckeditor_content = CKEDITOR.instances['content_news'].getData();
            let elm = $('#save_formData');
            elm.attr('disabled', 'disabled');

            let formData = new FormData();
            formData.append('type_news', $('#type_news').val());
            formData.append('title', $('#title').val());
            formData.append('short_content', $('#short_content').val());
            formData.append('content_news', ckeditor_content);

            let TotalImages = $('#file_news')[0].files.length; //Total Images
            formData.append('TotalImages', TotalImages);
            let images = $('#file_news')[0];
            for (let i = 0; i < TotalImages; i++) {
                formData.append('file_news' + i, images.files[i]);
            }
            formData.append('hashtags', appendHastag);
            formData.append('sports_id', $('#sports_id').val());
            formData.append('date_from_news', $('#date_from_news').val());
            formData.append('category_news_id', $('#category_news_id').val());

            formData.append('status_news', $('#status_news').val());
            formData.append('reason', $('#reason').val());

            $.ajax({
                url: "{{ route('tidings.store') }}",
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                dataType: "json",
                beforeSend: () => {
                    elm.html(
                        '<div class="spinner-border mr-2" style="width: 1rem!Important; height: 1rem!important;" role="status"><span class="sr-only"></span></div>Loading...'
                    )
                },
                success: (res) => {
                    if (res.success == true) {
                        window.location.href = "{{ route('tidings.index') }}"
                    } else {
                        alert(res.message);
                    }
                },
                error: (xhr) => {
                    if (xhr.status == 422) {
                        let errors = JSON.parse(xhr.responseText);
                        let msg;

                        $.each(errors.errors, (key, value) => {
                            $(`#${key}`).addClass('is-invalid');
                        })
                    }
                    elm.html('Simpan')
                    elm.removeAttr('disabled')
                },
                complete: () => {
                    elm.html('Simpan')
                    elm.removeAttr('disabled')
                }
            })

        })
    </script>
    <script>
        function previewImages() {

            let preview = document.querySelector('#preview');

            if (this.files) {
                [].forEach.call(this.files, readAndPreview);
            }

            function readAndPreview(file) {

                // Make sure `file.name` matches our extensions criteria
                if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                    return alert(file.name + " is not an image");
                } // else...

                let reader = new FileReader();

                reader.addEventListener("load", function() {
                    let image = new Image();
                    image.height = 100;
                    image.title = file.name;
                    image.src = this.result;
                    image.style = 'margin: 5px 10px';
                    preview.appendChild(image);
                });

                reader.readAsDataURL(file);

            }
        }

        document.querySelector('#file_news').addEventListener("change", previewImages);
    </script>
@endsection
@endsection
