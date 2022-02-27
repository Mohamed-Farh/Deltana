@extends('layouts.admin_auth_app')

@section('title', 'E-Mails')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">E-Mails</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_contacts,create_email')
                    <a href="{{ route('admin.emails.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New E-Mail</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>E-Mail</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($emails as $email)
                    <tr>
                        <td> {{ $email->email }} </td>
                        <td> {{ $email->type }} </td>
                        <td> {{ $email->status == 1 ? 'Active' : 'Inactive'}} </td>
                        <td> {{ $email->created_at->format('d-m-Y h:i a') }} </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @ability('superAdmin', 'manage_contacts,update_email')
                                   <a href="{{ route('admin.emails.edit', $email->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_contacts,delete_email')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('logo_delete_{{ $email->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.emails.destroy', $email->id) }}" method="post" id="logo_delete_{{ $email->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No E-Mails Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $emails->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
