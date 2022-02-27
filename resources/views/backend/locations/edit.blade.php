@extends('layouts.admin_auth_app')

@section('title', 'Edit Location')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Location</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.locations.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Locations</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.locations.update', $location->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" name="country" value="{{ old('country', $location->country ) }}" class="form-control">
                            @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" name="state" value="{{ old('state', $location->state ) }}" class="form-control">
                            @error('state')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" name="city" value="{{ old('city', $location->city ) }}" class="form-control">
                            @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $location->status ) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $location->status ) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-6">
                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea name="description" rows="5" class="form-control" >{!! old('description', $location->description ) !!}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="row mt-6">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="url" name="location" value="{{ old('location', $location->location ) }}" class="form-control">
                            @error('location')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Location</button>
                </div>
            </form>
        </div>
    </div>



@endsection
