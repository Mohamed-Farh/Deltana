@extends('layouts.admin_auth_app')

@section('title', 'All Technologies')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Technologies</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_about,create_technology')
                    <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Technology</span>
                    </a>
                @endability
            </div>
        </div>

        @include('backend.technologies.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($technologies as $technology)
                    <tr>
                        <td>
                            <img class="rounded-circle" src="{{ asset($technology->icon) }}" width="60" height="60" alt="">
                        </td>
                        <td>{{ $technology->name }}</td>
                        <td>{{ $technology->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $technology->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group btn-group-md">
                                @ability('superAdmin', 'manage_about,update_technology')
                                   <a href="{{ route('admin.technologies.edit', $technology->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_about,delete_technology')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('technology_delete_{{ $technology->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="post" id="technology_delete_{{ $technology->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Technologies Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $technologies->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
