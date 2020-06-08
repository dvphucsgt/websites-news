@php
    $navAdmin = 'active';
@endphp
@extends('index')
{{--Set title for page--}}
@section('title', trans('tool/admins.label.list.title'))
{{--Content for page--}}
@section('content')
    <body>
        @include('elements.header-admin')
        @include('elements.delete-modal', ['screen' => 'admins'])
        <div class="container-fluid">
            <div class="row">
                {{--Side bar--}}
                @include('elements.sidebar-admin')
                <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
                    <div class="pb-2 mt-4 mb-2 border-bottom">
                        <h2>{{ trans('tool/admins.label.list.filter_title') }}</h2>
                    </div>
                    @include('elements.flash-message')
                    <form method="get" action="{{ route('admin.index') }}">
                        <input type="hidden" name="sort_column" value="{{ $formData['sort_column'] }}">
                        <input type="hidden" name="sort_direction" value="{{ $formData['sort_direction'] }}">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="inputKeyword">{{ trans('tool/admins.label.list.filter_keyword') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="inputKeyword" name="keyword"
                                           value="{{ $formData['keyword'] }}"
                                           placeholder="{{ trans('tool/admins.label.list.filter_keyword_placeholder') }}">
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>{{ trans('tool/admins.label.list.filter_search_action') }}</label>
                                <div class="input-group">
                                    <button type="submit" class="btn btn-primary mb-2">
                                        <span data-feather="search"></span> {{ trans('tool/admins.label.list.filter_search_button') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="pb-2 mt-4 mb-2 border-bottom">
                        <h2>{{ trans('tool/admins.label.list.title') }}</h2>
                    </div>
                    <div class="table-responsive">
                        <nav>
                            {{ $managers->appends($formData)->links() }}
                        </nav>
                        <input type="hidden" value="{{ route('admin.index', ['keyword' => $formData['keyword']]) }}"
                               name="current_url">
                        <table class="table dataTable">
                            <thead>
                            <tr>
                                <th {{ sort_info('manager_id', $formData['sort_column'], $formData['sort_direction']) }}>
                                    {{ trans('tool/admins.label.list.table_col_id') }}
                                </th>
                                <th {{ sort_info('name', $formData['sort_column'], $formData['sort_direction']) }}>
                                    {{ trans('tool/admins.label.list.table_col_name') }}
                                </th>
                                <th {{ sort_info('username', $formData['sort_column'], $formData['sort_direction']) }}>
                                    {{ trans('tool/admins.label.list.table_col_username') }}
                                </th>
                                <th {{ sort_info('updated_at', $formData['sort_column'], $formData['sort_direction']) }}>
                                    {{ trans('tool/admins.label.list.table_col_updated_at') }}
                                </th>
                                <th>
                                    <a href="{{ route('admin.create') }}" class="btn btn-success btn-sm">
                                        <span data-feather="file-text"></span> {{ trans('tool/admins.label.list.table_button_create') }}
                                    </a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($managers->count() === 0)
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            {{ trans('tool/admins.label.list.table_empty_data') }}
                                        </td>
                                    </tr>
                                @else
                                    @foreach($managers as $manager)
                                        <tr>
                                            <td>{{ $manager->manager_id }}</td>
                                            <td>{{ $manager->name }}</td>
                                            <td>{{ $manager->username }}</td>
                                            <td>{{ format_date($manager->updated_at) }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit', $manager->manager_id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <span data-feather="edit"></span> {{ trans('tool/admins.label.list.table_button_edit') }}
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-url="{!! route('admin.destroy', $manager->manager_id) !!}"
                                                        data-target="deleteModal">
                                                    <span data-feather="delete"></span> {{ trans('tool/admins.label.list.table_button_delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <nav>
                            {{ $managers->appends($formData)->links() }}
                        </nav>
                    </div>
                </main>
            </div>
        </div>
    </body>
@endsection

@push('scripts')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
@endpush