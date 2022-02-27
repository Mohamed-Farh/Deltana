@extends('layouts.admin_auth_app')

@section('title', 'Create Career')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Career</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.careers.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Careers</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.careers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" value="{{ old('location') }}" class="form-control">
                            @error('location')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="exp_year">Experience Year</label>
                            <input type="number" name="exp_year" value="{{ old('exp_year') }}" class="form-control" min="0" max="50">
                            @error('exp_year')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="type">Type</label>
                        <select name="type" class="form-control">
                            <option value="Remotely" {{ old('type') == 1 ? 'selected' : null }}>Remotely</option>
                            <option value="Company" {{ old('type') == 0 ? 'selected' : null }}>Company</option>
                        </select>
                        @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label for="status">Category Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea name="description" rows="5" class="form-control" >{!! old('description') !!}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="requirements">Requirements</label>
                        <textarea name="requirements" rows="5" class="form-control">{!! old('requirements') !!}</textarea>
                        @error('requirements')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="career_image" class="file-input-overview">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Career</button>
                </div>
            </form>
        </div>
    </div>



@endsection
@section('script')
    <script>
        $(function () {
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
        });
    </script>

    <script>
        $(function () {
            $('#career_image').fileinput({
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


