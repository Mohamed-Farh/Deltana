@extends('layouts.admin_auth_app')

@section('title', 'Edit About Us')


@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit About Us</h6>
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

            <form action="{{ route('admin.abouts.update', $about->id) }}"  method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="main">About Us</label>
                        <textarea name="main" rows="5" class="form-control">{!! old('main', $about->main ) !!}</textarea>
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
                        <textarea name="work" rows="5" class="form-control">{!! old('work', $about->work ) !!}</textarea>
                        @error('work')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row pt-4 mt-4">
                    <div class="col-12">
                        <div class="form-group file-loading">
                            <label for="images">About Us Images</label>
                            <input type="file" name="images[]" id="about_images" class="file-input-overview" multiple="multiple">
                            @error('images')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="performance">Performance</label>
                        <textarea name="performance" rows="5" class="form-control">{!! old('performance', $about->performance) !!}</textarea>
                        @error('performance')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="quality">Quality</label>
                        <textarea name="quality" rows="5" class="form-control">{!! old('quality', $about->quality) !!}</textarea>
                        @error('quality')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="maintenance">Maintenance</label>
                        <textarea name="maintenance" rows="5" class="form-control">{!! old('maintenance', $about->maintenance) !!}</textarea>
                        @error('maintenance')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update About Us</button>
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

                $('#about_images').fileinput({
                    theme: "fas",
                    maxFileCount: {{ 10 - $about->media->count() }},
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview: [
                        @if($about->media->count() > 0)
                            @foreach($about->media as $media)
                                "{{url($media->file_name)}}",
                            @endforeach
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if($about->media->count() > 0)
                            @foreach($about->media as $media)
                                {
                                    caption: "{{ $media->file_name }}",
                                    size: {{ $media->file_size }},
                                    width: "120px",
                                    url: "{{ route('admin.abouts.removeImages', ['image_id'=>$media->id, 'about_id'=>$about->id, '_token' => csrf_token()]) }}",
                                    key: "{{ $media->id }}"
                                },
                            @endforeach
                        @endif
                    ],
                    // on('filesorted', function(event, params){
                    //     console;log
                    // })
                });


                $('#about_image').fileinput({
                    theme: "fas",
                    maxFileCount: 1,
                    allowedFileTypes: ['image'],
                    showCancel: true,
                    showRemove: false,
                    showUpload: false,
                    overwriteInitial: false,
                    initialPreview:[
                        @if ($about->image != '')
                            "{{url($about->image)}}"
                        @endif
                    ],
                    initialPreviewAsData: true,
                    initialPreviewFileType: 'image',
                    initialPreviewConfig: [
                        @if ($about->image != '')
                        {
                            caption: "{{ $about->image }}",
                            size: '1000',
                            width: "120px",
                            url: "{{ route('admin.abouts.removeImage', ['about_id'=>$about->id, '_token' => csrf_token()]) }}",
                            key: "{{ $about->id }}"
                        },
                        @endif
                    ],
                });
            });
        </script>
    @endsection

