@extends('layouts.admin_auth_app')

@section('title', 'Edit '.$head)

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{ $head }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin'.$route.'index') }}" class="btn btn-primary">
                    <span class="image text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">{{ $head }}</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin'.$route.'update', [$project->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title', $project->title) }}" class="form-control">
                            @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $project->status) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $project->status) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="button">Button Name</label>
                            <input type="text" name="button" value="{{ old('button', $project->button) }}" class="form-control">
                            @error('button')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="video_src">Video Src</label>
                            <input type="url" name="video_src" value="{{ old('video_src', $project->video_src) }}" class="form-control">
                            @error('video_src')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="text">Text | Description </label>
                        <textarea name="text" rows="5" class="form-control">{!! old('text', $project->text) !!}</textarea>
                        @error('text')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="project_image" class="file-input-overview">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Record</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(function () {
            $('#project_image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview:[
                    @if ($project->image != '')
                        "{{url($project->image)}}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($project->image != '')
                    {
                         caption: "{{ $project->image }}",
                         size: '1000',
                         width: "120px",
                         url: "{{ route('admin'.$route.'removeImage', ['project_id'=>$project->id, '_token' => csrf_token()]) }}",
                         key: "{{ $project->id }}"
                    },
                    @endif
                ],
            });
        });
    </script>
@endsection
