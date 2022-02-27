@extends('layouts.admin_auth_app')

@section('title', 'All page-titles')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">page-titles</h6>
            <div class="ml-auto">
                @ability('superAdmin', 'manage_settings,show_page_title')
                    <a href="{{ route('admin.page-titles.create') }}" class="btn btn-primary">
                        <span class="icon text-white-50">
                            <i class="fa fa-plus"></i>
                        </span>
                        <span class="text">Add New pageTitle</span>
                    </a>
                @endability
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($pageTitles as $pageTitle)
                    <tr>
                        <td>{{ $pageTitle->page }}</td>
                        <td>{{ $pageTitle->title }}</td>
                        <td>{{ $pageTitle->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td>{{ $pageTitle->created_at->format('d-m-Y h:i a') }}</td>
                        <td>
                            <div class="btn-group btn-group-md">
                                @ability('superAdmin', 'manage_settings,show_page_title')
                                   <a href="{{ route('admin.page-titles.edit', $pageTitle->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @endability

                                @ability('superAdmin', 'manage_settings,show_page_title')
                                    <a href="javascript:void(0)"
                                        onclick="
                                                if (confirm('Are You Sure You Want To Delete This Record ?') )
                                                    { document.getElementById('pageTitle_delete_{{ $pageTitle->id }}').submit(); }
                                                else
                                                    { return false; }"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
                                    </a>
                                @endability
                            </div>
                            <form action="{{ route('admin.page-titles.destroy', $pageTitle->id) }}" method="post" id="pageTitle_delete_{{ $pageTitle->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No page-titles Found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">
                        <div class="float-right">
                            {!! $pageTitles->appends(request()->input())->links() !!}
                        </div>
                    </th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



@endsection
