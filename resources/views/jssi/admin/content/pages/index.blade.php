@extends('layouts.admin')

@section('title', 'Pages')

@section('content')

    <x-admin.paginated_table :paginated="$pages">
        <x-slot:header_right>
            <a href='{{ route('admin.pages.create') }}' class="btn btn-success">Add new</a>
        </x-slot:header_right>
        <x-slot:thead_content>
            <th>Id</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Visible</th>
            <th>Actions</th>
        </x-slot:thead_content>

        <x-slot:tbody_content>
            @foreach ($pages as $page)
                <tr>
                    <td> {{ $page->id }}</td>
                    <td> {{ $page->title }}</td>
                    <td> {{ $page->slug }}</td>
                    <td>
                        @if ($page->isVisible)
                            <button type="button" class="btn btn-outline-success px-2 py-1" disabled>
                                <i class="fa-solid fa-check text-success fw-bold fs-5"></i>
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-danger px-2 py-1" disabled>
                                <i class="fa-solid fa-xmark text-danger fw-bold fs-5"></i>
                            </button>
                        @endif
                    </td>
                    <td><a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-outline-success"><i
                                class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $page->id }}
                            data-name="{{ $page->title }}" data-toggle="modal" data-target="#deletePage"><i
                                class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach

        </x-slot:tbody_content>
    </x-admin.paginated_table>

    <div class="modal fade" id="deletePage" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible!</h5>
                    <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete page <span id="modal-page_name"></span>?
                    <input type="hidden" id="category" name="issue_id">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.pages.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                        <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete page</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).on('click', '.deleteBtn', function() {
            let id = $(this).attr('data-id');
            let name = $(this).attr('data-name');
            $('#id').val(id);
            $('#deletePage').modal('show');
            $('#modal-page_name').text(name);
            $('#deletePage').on('click', '.modalClose', () => {
                $('#deletePage').modal('hide');
            });
        });
    </script>
@endsection
