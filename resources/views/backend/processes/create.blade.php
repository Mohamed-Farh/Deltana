@extends('layouts.admin_auth_app')

@section('title', 'Create Process')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Process</h6>
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
            <form action="{{ route('admin.processes.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-9">
                        <div class="form-group">
                            <label for="step_title">Step Title</label>
                            <input type="text" name="step_title" value="{{ old('step_title') }}" class="form-control">
                            @error('step_title')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <label for="step_no">Step Number</label>
                        @php
                            $is_processes = \App\Models\Process::whereStatus(1)->pluck('step_no')->toArray();
                        @endphp
                        <select name="step_no" class="form-control">
                            @if(!in_array('1', $is_processes))
                                <option value="1" {{ old('step_no') == 1 ? 'selected' : null }}>1</option>
                            @endif

                            @if(!in_array('2', $is_processes))
                                <option value="2" {{ old('step_no') == 2 ? 'selected' : null }}>2</option>
                            @endif

                            @if(!in_array('3', $is_processes))
                                <option value="3" {{ old('step_no') == 3 ? 'selected' : null }}>3</option>
                            @endif

                            @if(!in_array('4', $is_processes))
                                <option value="4" {{ old('step_no') == 4 ? 'selected' : null }}>4</option>
                            @endif

                            @if(!in_array('5', $is_processes))
                                <option value="5" {{ old('step_no') == 5 ? 'selected' : null }}>5</option>
                            @endif
                        </select>
                        @error('step_no')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="title">Title</label>
                        <textarea name="title" rows="5" class="form-control" >{!! old('title') !!}</textarea>
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <label for="text">Description</label>
                        <textarea name="text" rows="5" class="form-control" >{!! old('text') !!}</textarea>
                        @error('text')<span class="text-danger">{{ $message }}</span>@enderror
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
                    <button type="submit" name="submit" class="btn btn-primary">Add Process</button>
                </div>
            </form>
        </div>
    </div>



@endsection
@section('script')
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


