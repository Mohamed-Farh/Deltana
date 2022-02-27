@extends('layouts.admin_auth_app')

@section('title', 'Edit Project Details')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Project Details</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.our-work.projectDetails.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Project Details</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.our-work.projectDetails.update', $projectDetail->id) }}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ old('title', $projectDetail->title ) }}" class="form-control" required>
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="image">Logo</label>
                        <input type="file" name="image" id="project_logo" class="file-input-overview">
                        @error('image')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-4">
                        <label for="category">Category</label>
                        <input type="text" name="category" value="{{ old('category', $projectDetail->category ) }}" class="form-control" required>
                        @error('category')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label for="top">Top</label>
                        <select name="top" class="form-control">
                            <option value="1" {{ old('top', $projectDetail->top ) == 1 ? 'selected' : null }}>Top</option>
                            <option value="0" {{ old('top', $projectDetail->top ) == 0 ? 'selected' : null }}>Normal</option>
                        </select>
                        @error('top')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-4">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $projectDetail->status ) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $projectDetail->status ) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="link">Project Website Link</label>
                        <input type="url" name="link" value="{{ old('link', $projectDetail->link ) }}" class="form-control">
                        @error('link')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="video">Project Website Demo</label>
                        <input type="url" name="video" value="{{ old('video', $projectDetail->video ) }}" class="form-control">
                        @error('video')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="technology">Technology</label>
                        <input type="text" name="technology" value="{{ old('technology', $projectDetail->technology ) }}" class="form-control" required>
                        @error('technology')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="text">Description</label>
                        <textarea name="text" rows="5" class="form-control" required>{!! old('text', $projectDetail->text ) !!}</textarea>
                        @error('text')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4 mt-4">
                    <div class="col-12">
                        <div class="form-group file-loading">
                            <label for="images">Project Details Images</label>
                            <input type="file" name="images[]" id="project_images" class="file-input-overview" multiple="multiple" >
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Project Details</button>
                </div>
            </form>
        </div>
    </div>



    @endsection

    @section('script')
        <script>
            $(function() {
                $('#project_images').fileinput({
                    theme: "fas",
                    maxFileCount: {{ 10 - $projectDetail->media->count() }},
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($projectDetail->media->count() > 0)
                            @foreach($projectDetail->media as $media)
                                "{{url($media->file_name)}}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($projectDetail->media->count() > 0)
                            @foreach($projectDetail->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: {{ $media->file_size }},
                                    width: "120px",
                                    url: "{{ route('admin.our-work.projectDetails.removeImages', ['image_id'=>$media->id, 'projectDetail_id'=>$projectDetail->id, '_token' => csrf_token()]) }}",
                                    key: "{{ $media->id }}"
                                },
                            @endforeach
                        @endif
                    ],
                    // on('filesorted', function(event, params){
                    //     console;log
                    // })
                });


                $('#project_logo').fileinput({
                    theme: "fas",
                    maxFileCount: 1,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview:[
                        @if ($projectDetail->image != '')
                            "{{url($projectDetail->image)}}"
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if ($projectDetail->image != '')
                        {
                            caption: "{{ $projectDetail->image }}",
                            size: '1000',
                            width: "120px",
                            url: "{{ route('admin.our-work.projectDetails.removeImage', ['projectDetail_id'=>$projectDetail->id, '_token' => csrf_token()]) }}",
                            key: "{{ $projectDetail->id }}"
                        },
                        @endif
                    ],
                });
            });
        </script>
    @endsection

