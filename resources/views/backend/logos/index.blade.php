@extends('layouts.admin_auth_app')

@section('title', 'All Logos')

@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Logos</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_Settings,show_logos')
                    <a href="{{ route('admin.logos.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New Logo</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Logo</th>
                    <th>Color</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($logos as $logo)
                    <tr>
                        <td>
                            <img class="rounded-circle" src="{{ asset($logo->logo) }}" width="60" height="60" alt="">
                        </td>
                        <td> {{ $logo->color == 1 ? 'White' : 'Black'}} </td>
                        <td>
                            @livewire('backend.logo-status', ['model' => $logo, 'field' => 'status'], key($logo->id))
                        </td>
                        <td>
                            <div class="btn-group btn-group-md">
                                @ability('superAdmin', 'manage_Settings,show_logos')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('logo_delete_{{ $logo->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.logos.destroy', $logo->id) }}" method="post" id="logo_delete_{{ $logo->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No Logos found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="4">
                        <div class="float-right">
                            {!! $logos->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection

@section('scripts')
<script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
<x-livewire-alert::flash />
@endsection
