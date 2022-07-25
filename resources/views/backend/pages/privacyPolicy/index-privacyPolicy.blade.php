@extends('backend.master')
@section('title', '- Pengaturan Privasi Polish')
@section('content')
    <div class="container-fluid">
        <div class="wrapper-table p-3 bg-white rounded">
            <form action="{{ route('set-privacy-policy.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="privacy" class="col-sm-2 col-form-label"><h4>Privacy</h4></label>
                    <div class="col-sm-10">
                        <textarea name="privacy" class="form-control" id="privacy" cols="30" rows="10"
                            class="w-100">{{ $lists->privacy }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="policy" class="col-sm-2 col-form-label"><h4>Policy</h4></label>
                    <div class="col-sm-10">
                        <textarea name="policy" class="form-control" id="policy" cols="30" rows="10"
                            class="w-100">{{ $lists->policy }}</textarea>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-danger p-2 rounded" id="save_formData">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@section('script-footer')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    let content = document.getElementById("privacy");
    CKEDITOR.replace(content, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;

    let content2 = document.getElementById("policy");
    CKEDITOR.replace(content2, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
</script>
@endsection
@endsection
