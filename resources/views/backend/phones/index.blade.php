@extends('layouts.admin_auth_app')

@section('title', 'Phones')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Phones</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_contacts,create_phone')
                    <a href="{{ route('admin.phones.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Phone</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($phones as $phone)
                    <tr>
                        <td>
                            <img src="{{ asset('images/icon/'.$phone->type).'.png' }}" width="30" height="30" alt="">
                        </td>
                        <td> {{ $phone->number }} </td>
                        <td> {{ $phone->status == 1 ? 'Active' : 'Inactive'}} </td>
                        <td> {{ $phone->created_at->format('d-m-Y h:i a') }} </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @ability('superAdmin', 'manage_contacts,update_phone')
                                   <a href="{{ route('admin.phones.edit', $phone->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_contacts,delete_phone')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('logo_delete_{{ $phone->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.phones.destroy', $phone->id) }}" method="post" id="logo_delete_{{ $phone->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Phones Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $phones->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
