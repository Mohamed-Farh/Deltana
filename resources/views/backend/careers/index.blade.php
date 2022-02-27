@extends('layouts.admin_auth_app')

@section('title', 'All Careers')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Careers</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_careers,create_careers')
                    <a href="{{ route('admin.careers.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Career</span>
                    </a>
                @endability
            </div>
        </div>

        @include('backend.careers.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Experience</th>
                    <th>Description</th>
                    <th>Requirements</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($careers as $career)
                    <tr>
                        <td>
                            <img class="rounded-circle" src="{{ asset($career->image) }}" width="60" height="60" alt="">
                        </td>
                        <td>{{ $career->title }}</td>
                        <td>{{ $career->location }}</td>
                        <td>{{ $career->type }}</td>
                        <td>{{ $career->exp_year }}</td>
                        <td>{{ $career->description }}</td>
                        <td>{{ $career->requirements }}</td>
                        <td>{{ $career->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $career->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @ability('superAdmin', 'manage_careers,update_careers')
                                   <a href="{{ route('admin.careers.edit', $career->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_careers,delete_careers')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('career_delete_{{ $career->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.careers.destroy', $career->id) }}" method="post" id="career_delete_{{ $career->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Careers found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="10">
                        <div class="float-right">
                            {!! $careers->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
