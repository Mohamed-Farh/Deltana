@extends('layouts.admin_auth_app')

@section('title', 'Social Media')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Social Media</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_contacts,create_logo')
                    <a href="{{ route('admin.socials.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Social Media</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Type</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($socials as $socialMedia)
                    <tr>
                        <td>
                            <img class="rounded-circle" src="{{ asset('images/icon/'.$socialMedia->type).'.png' }}" width="30" height="30" alt="">
                        </td>
                        <td> {{ $socialMedia->type }} </td>
                        <td> <a href="{{ $socialMedia->link }}" target="_blank">{{ $socialMedia->link }}</a> </td>
                        <td> {{ $socialMedia->status == 1 ? 'Active' : 'Inactive'}} </td>
                        <td> {{ $socialMedia->created_at->format('d-m-Y h:i a') }} </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @ability('superAdmin', 'manage_contacts,update_socials')
                                   <a href="{{ route('admin.socials.edit', $socialMedia->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_contacts,delete_socials')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('logo_delete_{{ $socialMedia->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.socials.destroy', $socialMedia->id) }}" method="post" id="logo_delete_{{ $socialMedia->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Social Media Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="6">
                        <div class="float-right">
                            {!! $socials->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
