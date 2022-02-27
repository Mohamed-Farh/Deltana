@extends('layouts.admin_auth_app')

@section('title', 'Edit Process')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Process</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.processes.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Processes</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.processes.update', $process->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="step_title">Step Title</label>
                            <input type="text" name="step_title" value="{{ old('step_title', $process->step_title) }}" class="form-control">
                            @error('step_title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="title">Title</label>
                        <textarea name="title" rows="5" class="form-control" >{!! old('title', $process->title) !!}</textarea>
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="text">Text</label>
                        <textarea name="text" rows="5" class="form-control" >{!! old('text', $process->text) !!}</textarea>
                        @error('text')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="process_image" class="file-input-overview">
                            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update process</button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('script')
    <script>
        $(function () {
            $('#process_image').fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false,
                initialPreview:[
                    @if ($process->image != '')
                        "{{url($process->image)}}"
                    @endif
                ],
                initialPreviewAsData: true,
                initialPreviewFileType: 'image',
                initialPreviewConfig: [
                    @if ($process->image != '')
                    {
                        caption: "{{ $process->image }}",
                        size: '1000',
                        width: "120px",
                        url: "{{ route('admin.processes.removeImage', ['process_id'=>$process->id, '_token' => csrf_token()]) }}",
                        key: "{{ $process->id }}"
                    },
                    @endif
                ],
            });
        });
    </script>
@endsection
