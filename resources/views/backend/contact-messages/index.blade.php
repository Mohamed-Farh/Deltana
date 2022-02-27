@extends('layouts.admin_auth_app')

@section('title', 'All Contact Messages')

@section('content')


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="m-0 font-weight-bold text-primary">Contact Messages</h6>
        <div class="ml-auto">
        </div>
    </div>

    @include('backend.contact-messages.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Country</th>
                <th>Services</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width: 30px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($contactMessages as $contactMessage)
                <tr>
                    <td>
                        {{ $contactMessage->full_name }}
                        <p class="text-gray-400"><b>{{ $contactMessage->mobile }}</b></p>
                    </td>
                    <td>{{ $contactMessage->company }}</td>
                    <td>{{ $contactMessage->country }}</td>
                    @php
                        $services = \App\Models\ContactService::whereMessageId($contactMessage->id)->get();
                    @endphp
                    <td>
                        @forelse($services as $service)
                            {{ $service->service }},
                        @empty
                        @endforelse
                    </td>
                    <td>{{ $contactMessage->note }}</td>
                    <td>
                        @livewire('backend.contact-message', ['model' => $contactMessage, 'field' => 'status'], key($contactMessage->id))
                    </td>
                    <td>{{ $contactMessage->created_at->format('d-m-Y h:i a') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="javascript:void(0)" onclick="if (confirm('Are You Sure To Delete This Record?') ) { document.getElementById('user-delete-{{ $contactMessage->id }}').submit(); } else { return false; }" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            <form action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}" method="post" id="user-delete-{{ $contactMessage->id }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No contactMessages found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th colspan="8">
                    <div class="float-right">
                        {!! $contactMessages->appends(request()->input())->links() !!}
                    </div>
                </th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


@endsection
