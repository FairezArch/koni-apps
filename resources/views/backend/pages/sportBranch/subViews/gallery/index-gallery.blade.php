@extends('backend.master')
@section('title', '- Galeri')
@section('content')
    <div class="container-fluid">
        <div class="wrapper-table p-3 bg-white rounded">
            <div class="w-100 mt-3 mb-3 text-right">
                @can('gallery-create')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Tambah
                        Momen</button>
                @endcan
            </div>
            <div id="getImage">
                <div class="row">
                    @foreach ($lists as $list)
                        <div class="col-md-3 my-4">
                            <div class="grid-image position-relative">
                                <button type="button" id="modal-button-delete"
                                    class="close position-absolute modal-button-delete" data-id="{{ json_encode(array($sport_id, $list->id)) }}"
                                    style="top: 0; right: 10px; z-index: 1;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                @if (pathinfo($list->filename, PATHINFO_EXTENSION) == 'mp4')
                                    <div id="trailer"
                                        class="section d-flex justify-content-center embed-responsive embed-responsive-4by3">
                                        <video class="embed-responsive-item" controls muted>
                                            <source src="{{ asset('storage/' . $list->folder . '/' . $list->filename) }}"
                                                type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/' . $list->folder . '/' . $list->filename) }}" alt="Image"
                                        class="img-thumbnail card-img-top" style="width: 255px; height: 138px;">
                                @endif
                                <div class="position-absolute text-center text-gallery w-100">
                                    <div class="max-char-length">
                                        {{ $list->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content px-5 py-2">
                        <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close"
                            style="top: 0; right: 10px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="text-center">
                            <h5 class="modal-title" id="exampleModalLabel">Unggah Gambar atau Video</h5>
                            <small>Unggah gambar atau video dengan format PNG, JPG dan mp4</small>
                        </div>
                        <div class="modal-body">
                            <div class="position-relative">
                                <form method="post" action="{{ route('sport-branch.photo-gallery.store', $sport_id) }}"
                                    enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script-footer')
    <script type="text/javascript">
        Dropzone.options.dropzone = {
            maxFilesize: 10,
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.mp4",
            addRemoveLinks: false,
            timeout: 60000,
            success: function(file, response) {
                console.log(response);
            },
            init: function() {
                this.on("complete", function(file) {
                    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        $('#exampleModal').removeClass('show', function() {
                            console.log(file);
                            Swal.fire('Success.', 'File berhasil diupload', 'success')
                            window.location = window.location
                        });
                    }
                });
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>
    <script>
        $('.modal-button-delete').on('click', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });

            Swal.fire({
                icon: 'warning',
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then( (result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    let id = JSON.parse($(this).attr("data-id"));
                    let url = url = "{!!url('sport-branch/"+id[0]+"/atlet/"+id[1]+"')!!}";
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Success.', res.message, 'success')
                                window.location = window.location
                            } else {
                                Swal.fire('Error.', res.message, 'error')
                            }
                        }
                    });

                } else if (result.isDenied) {
                    Swal.fire('Changes are not deleted', '', 'info')
                }
            });
        });
    </script>
@endsection
@endsection
