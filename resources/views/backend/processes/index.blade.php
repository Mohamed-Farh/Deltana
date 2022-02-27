@extends('layouts.admin_auth_app')

@section('title', 'All Processes')

@section('content')


    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">processes</h6>
            <div class="ml-auto">
                @php $is_processes = \App\Models\Process::whereStatus(1)->count(); @endphp
                @if($is_processes < 5)
                    @ability('superAdmin', 'manage_processes,show_processes')
                        <a href="{{ route('admin.processes.create') }}" class="btn btn-primary">
                            <span class="icon text-white-50">
                                <i class="fa fa-plus"></i>
                            </span>
                            <span class="text">Add New Record</span>
                        </a>
                    @endability
                @endif
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Step No</th>
                    <th>Image</th>
                    <th>Step Title</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($processes as $process)
                    <tr>
                        <td>{{ $process->step_no }}</td>
                        <td>
                            @if ($process->image)
                                <img class="rounded-circle" src="{{ asset($process->image) }}" width="60" height="60" alt="">
                            @else
                                <th><img src="{{ asset('assets/no_image.png')}}" width="60" height="60" alt="{{ $process->name }}"></th>
                            @endif
                        </td>
                        <td>{{ $process->step_title }}</td>
                        <td>{{ $process->title }}</td>
                        <td>{{ $process->text }}</td>
                        <td>{{ $process->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $process->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @ability('superAdmin', 'manage_processes,show_processes')
                                   <a href="{{ route('admin.processes.edit', $process->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_processes,show_processes')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('process_delete_{{ $process->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.processes.destroy', $process->id) }}" method="post" id="process_delete_{{ $process->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No Processes Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="10">
                        <div class="float-right">
                            {!! $processes->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
