@extends('layouts.admin_auth_app')

@section('title', 'Create About Us')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create About Us</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.abouts.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">About Us</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.abouts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="main">About Us</label>
                        <textarea name="main" rows="5" class="form-control">{!! old('main') !!}</textarea>
                        @error('main')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">About Us Image</label>
                            <input type="file" name="image" id="about_image" class="file-input-overview">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="work">Work Environment</label>
                        <textarea name="work" rows="5" class="form-control">{!! old('work') !!}</textarea>
                        @error('work')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4 mt-4">
                    <div class="col-12">
                        <div class="form-group file-loading">
                            <label for="images">About Us Images</label>
                            <input type="file" name="images[]" id="product_images" class="file-input-overview" multiple="multiple">
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="performance">Performance</label>
                        <textarea name="performance" rows="5" class="form-control">{!! old('performance') !!}</textarea>
                        @error('performance')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="quality">Quality</label>
                        <textarea name="quality" rows="5" class="form-control">{!! old('quality') !!}</textarea>
                        @error('quality')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="maintenance">Maintenance</label>
                        <textarea name="maintenance" rows="5" class="form-control">{!! old('maintenance') !!}</textarea>
                        @error('maintenance')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add About Us</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(function() {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#product_images').fileinput({
                theme: "fas",
                maxFileCount: 10,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });

        $(function () {
            $('#about_image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
            });
        });

    </script>
@endsection
