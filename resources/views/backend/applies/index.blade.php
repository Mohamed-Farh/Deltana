@extends('layouts.admin_auth_app')

@section('title', 'All Job Requests')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Job Requests</h6>
        <div class="ml-auto">
        </div>
    </div>

    @include('backend.applies.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email & Mobile</th>
                <th>CV</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width: 30px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($applies as $apply)
                <tr>
                    <td>
                        {{ $apply->first_name }} {{ $apply->last_name }}
                    </td>
                    <td>
                        {{ $apply->email }}
                        <p class="text-gray-400"><b>{{ $apply->mobile }}</b></p>
                    </td>
                    <td>
                        @php $cv  = $apply->file; @endphp
                        <a href='/files/uploads/{{  $cv }}' target="_blank">Open PDF</a>
                    </td>
                    <td>
                        @livewire('backend.job-apply', ['model' => $apply, 'field' => 'status'], key($apply->id))
                    </td>
                    <td>{{ $apply->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:void(0)" onclick="if (confirm('Are You Sure To Delete This Record?') ) { document.getElementById('user-delete-{{ $apply->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <form action="{{ route('admin.applies.destroy', $apply->id) }}" method="post" id="user-delete-{{ $apply->id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No Job Requests found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th colspan="6">
                    <div class="float-right">
                        {!! $applies->appends(request()->input())->links() !!}
                    </div>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection
