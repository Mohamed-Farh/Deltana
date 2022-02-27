@extends('layouts.admin_auth_app')

@section('title', 'Project Details')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Project Details</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.our-work.projectDetails.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add New Project</span>
                </a>
            </div>
        </div>

        @include('backend.projectDetails.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Logo</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Link</th>
                    <th>Demo</th>
                    <th>Top</th>
                    <th>Status</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($projectDetails as $projectDetail)
                    <tr>
                        <td>
                            @if($projectDetail->image != '')
                                <img class="rounded-circle" src="{{ asset($projectDetail->image) }}" width="60" height="60" alt="">
                            @else
                                <img class="rounded-circle" src="{{ asset('assets/no_image.png') }}" width="60" height="60" alt="">
                            @endif
                        </td>
                        <td>{{ $projectDetail->title }}</td>
                        <td>{{ $projectDetail->category }}</td>
                        <td>{{ $projectDetail->link }}</td>
                        @if($projectDetail->video != '')
                            <td>
                                <a href="{{ $projectDetail->video }}">Watch</a>
                            </td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{{ $projectDetail->top == 1 ? 'Top' : 'Normal'}}</td>
                        <td>{{ $projectDetail->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <div class="btn-group btn-group-md">
                                <a href="{{ route('admin.our-work.projectDetails.edit', $projectDetail->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                                <a href="javascript:void(0)"
                                    onclick="
                                            if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                { document.getElementById('projectDetail_delete_{{ $projectDetail->id }}').submit(); }
                                            else
                                                { return false; }"
                                    class="btn btn-danger"><i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.our-work.projectDetails.destroy', $projectDetail->id) }}" method="post" id="projectDetail_delete_{{ $projectDetail->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Records Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="8">
                        <div class="float-right">
                            {!! $projectDetails->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
