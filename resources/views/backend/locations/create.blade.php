@extends('layouts.admin_auth_app')

@section('title', 'Create Location')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create Location</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.locations.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Location</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.locations.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <label for="country">Country</label>
                        <input type="text" name="country" value="{{ old('country') }}" class="form-control">
                        @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="state">State</label>
                        <input type="text" name="state" value="{{ old('state') }}" class="form-control">
                        @error('state')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-6">
                        <label for="city">City</label>
                        <input type="text" name="city" value="{{ old('city') }}" class="form-control">
                        @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-6">
                        <label for="status">Social Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea name="description" rows="5" class="form-control">{!! old('description') !!}</textarea>
                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label for="location">Location</label>
                        <input type="url" name="location" value="{{ old('location') }}" class="form-control">
                        @error('location')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add location</button>
                </div>
            </form>
        </div>
    </div>



@endsection
