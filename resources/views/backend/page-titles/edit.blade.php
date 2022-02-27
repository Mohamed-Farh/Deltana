@extends('layouts.admin_auth_app')

@section('title', 'Edit Page-Titles')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Page-Titles</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.page-titles.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Page-Titles</span>
                </a>
            </div>
        </div>
        <div class="card-body">

            <form action="{{ route('admin.page-titles.update', $pageTitle->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-9">
                        <label for="page">Page</label>
                        <select name="page" class="form-control">
                            <option value="Home Services" {{ old('page', $pageTitle->page ) == "Home Services" ? 'selected' : null }}>Home Services</option>
                            <option value="Top Projects" {{ old('page', $pageTitle->page ) == "Top Projects" ? 'selected' : null }}>Top Projects</option>
                            <option value="Technologies We Provide" {{ old('page', $pageTitle->page ) == "Technologies We Provide" ? 'selected' : null }}>Technologies We Provide</option>
                            <option value="Deltana Careers" {{ old('page', $pageTitle->page ) == "Deltana Careers" ? 'selected' : null }}>Deltana Careers</option>
                            <option value="Process" {{ old('page', $pageTitle->page ) == "Process" ? 'selected' : null }}>Process</option>
                            <option value="Our Projects" {{ old('page', $pageTitle->page ) == "Our Projects" ? 'selected' : null }}>Our Projects</option>
                            <option value="Why Deltana?" {{ old('page', $pageTitle->page ) == "Why Deltana?" ? 'selected' : null }}>Why Deltana?</option>
                            <option value="Contact Us" {{ old('page', $pageTitle->page ) == "Contact Us" ? 'selected' : null }}>Contact Us</option>
                            <option value="Contact Us Footer" {{ old('page', $pageTitle->page ) == "Contact Us Footer" ? 'selected' : null }}>Contact Us Footer</option>
                            <option value="Footer" {{ old('page', $pageTitle->page ) == "Footer" ? 'selected' : null }}>Footer</option>
                        </select>
                        @error('page')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="col-3">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $pageTitle->status ) == 1 ? 'selected' : null }}>Active</option>
                            <option value="0" {{ old('status', $pageTitle->status ) == 0 ? 'selected' : null }}>Inactive</option>
                        </select>
                        @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <label for="title">Title</label>
                        <textarea name="title" rows="5" class="form-control" >{!! old('title', $pageTitle->title ) !!}</textarea>
                        @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Update Page-Title</button>
                </div>
            </form>
        </div>
    </div>



@endsection
