@extends('admin.layout.app')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_toolbar_container'}"
                class="page-title d-flex flex-column justify-content-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="page-heading capitalize d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                    Employees
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="/admin/dashboard" class="text-muted text-hover-primary">
                            Dashboard </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-500 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item capitalize text-muted">
                        Employees </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container">
            <div class="card">
                <div class="card-header border-0">
                    <div class="card-title">
                        <h2 class="capitalize">Templates List</h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <a href="{{ route('templates.create') }}" class="btn btn-primary d-flex align-items-center">
                                <iconify-icon icon="charm:plus"></iconify-icon>
                                Create New Template
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body py-4" style="overflow-x: scroll;">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">Name</th>
                                <th class="min-w-100px">Description</th>
                                <th class="text-center min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            @foreach ($templates as $template)
                                <tr>
                                    <td>{{ $template->name }}</td>
                                    <td>{{ $template->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('templates.edit', $template->id) }}"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 mb-2">
                                            <iconify-icon icon="heroicons-outline:pencil-alt"
                                                class="fa-1-5"></iconify-icon>
                                        </a>

                                        <form action="{{ route('templates.destroy', $template->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm mb-2">
                                                <iconify-icon icon="iconamoon:trash-light" class="fa-1-5"></iconify-icon>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $templates->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
