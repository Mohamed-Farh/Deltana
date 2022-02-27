@extends('layouts.admin_auth_app')

@section('title', $title.' Messages')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">{{ $title }} Messages</h6>
        <div class="ml-auto">
        </div>
    </div>

    @include('backend.messages.home.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                @if ($title == 'Kayan')
                    <th>Speciality</th>
                @endif
                <th>Address</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width: 30px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($messages as $message)
                <tr>
                    <td>
                        {{ $message->name }}
                        <p class="text-gray-400"><b>{{ $message->mobile }}</b></p>
                    </td>
                    @if ($title == 'Kayan')
                        <td>{{ $message->speciality }}</td>
                    @endif
                    <td>{{ $message->address }}</td>
                    <td>{{ $message->note }}</td>
                    <td>
                        @livewire('backend.contact-message', ['model' => $message, 'field' => 'status'], key($message->id))
                    </td>
                    <td>{{ $message->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:void(0)" onclick="if (confirm('Are You Sure To Delete This Record?') ) { document.getElementById('user-delete-{{ $message->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="post" id="user-delete-{{ $message->id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    @if ($title == 'Kayan')
                        <td colspan="8" class="text-center">No Messages found</td>
                    @else
                        <td colspan="7" class="text-center">No Messages found</td>
                    @endif
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                @if ($title == 'Kayan')
                    <th colspan="8">
                @else
                    <th colspan="7">
                @endif
                    <div class="float-right">
                        {!! $messages->appends(request()->input())->links() !!}
                    </div>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection
