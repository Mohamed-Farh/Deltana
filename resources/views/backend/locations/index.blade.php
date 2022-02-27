@extends('layouts.admin_auth_app')

@section('title', 'Locations')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Locations</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_settings,show_location')
                    <a href="{{ route('admin.locations.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Location</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Desccription</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($locations as $location)
                    <tr>
                        <td>{{ $location->country }}</td>
                        <td>{{ $location->state }}</td>
                        <td>{{ $location->city }}</td>
                        <td>{{ $location->description }}</td>
                        <td>Location</td>
                        <td>{{ $location->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <div class="btn-group btn-group-md">
                                @ability('superAdmin', 'manage_settings,show_location')
                                   <a href="{{ route('admin.locations.edit', $location->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_settings,show_location')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('location_delete_{{ $location->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.locations.destroy', $location->id) }}" method="post" id="location_delete_{{ $location->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No Locations Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="7">
                        <div class="float-right">
                            {!! $locations->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
