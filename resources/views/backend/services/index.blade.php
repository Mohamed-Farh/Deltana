@extends('layouts.admin_auth_app')

@section('title', 'All '.$head )

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">{{ $head }}</h6>
            <div class="ml-auto">
                <a href="{{ route('admin'.$route.'create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add New Record</span>
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>
                            @if($service->image != '')
                                <img class="rounded-circle" src="{{ asset($service->image) }}" width="60" height="60" alt="">
                            @else
                                <img class="rounded-circle" src="{{ asset('assets/no_image.png') }}" width="60" height="60" alt="">
                            @endif
                        </td>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->text }}</td>
                        <td>{{ $service->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <div class="btn-group btn-group-md">
                                <a href="{{ route('admin'.$route.'edit', $service->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                                <a href="javascript:void(0)"
                                    onclick="
                                            if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                { document.getElementById('service_delete_{{ $service->id }}').submit(); }
                                            else
                                                { return false; }"
                                    class="btn btn-danger"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin'.$route.'destroy', $service->id) }}" method="post" id="service_delete_{{ $service->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $services->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
