@extends('layouts.admin_auth_app')

@section('title', 'Edit Technology')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Technology {{ $technology->name }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Technologies</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.technologies.update', $technology->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $technology->name) }}" class="form-control">
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $technology->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $technology->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="file" name="icon" id="technology_image" class="file-input-overview">
                            @error('icon')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Technology</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(function () {
            $('#technology_image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview:[
                    @if ($technology->icon != '')
                        "{{url($technology->icon)}}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($technology->icon != '')
                    {
                         caption: "{{ $technology->icon }}",
                         size: '1000',
                         width: "120px",
                         url: "{{ route('admin.technologies.removeImage', ['technology_id'=>$technology->id, '_token' => csrf_token()]) }}",
                         key: "{{ $technology->id }}"
                    },
                    @endif
                ],
            });
        });
    </script>
@endsection
