@extends('layouts.admin')
@section('title', 'Authors')
@section('content')
    <x-admin.paginated_table :paginated="$authors">
        <x-slot:header_right>
            <a href='{{ route('jssi.admin.authors.create') }}' class="btn btn-success">Add new</a>
        </x-slot:header_right>
        <x-slot:thead_content>
            <th>ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>ORCID</th>
            <th>Actions</th>
        </x-slot:thead_content>
        <x-slot:tbody_content>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->first_name }}</td>
                    <td>{{ $author->middle_name }}</td>
                    <td>{{ $author->last_name }} </td>
                    <td>{{ $author->email }}</td>
                    <td>{{ $author->orcid }}</td>
                    <td><a href="{{ route('jssi.admin.authors.edit', $author->id) }}" class="btn btn-outline-success"
                            role="button"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $author->id }}
                            data-name="{{ $author->fullname() }}" data-toggle="modal" data-target="#deleteAuthor"><i
                                class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>

    <div class="modal fade" id="deleteAuthor" data-backdrop="static" tabindex="-1" role="dialog"
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
                    Are you sure you want to delete issue <span id="modal-author_name"></span>?
                    <input type="hidden" id="category" name="issue_id">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('jssi.admin.authors.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                        <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete author</button>
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
            $('#deleteAuthor').modal('show');
            $('#modal-author_name').text(name);
            $('#deleteAuthor').on('click', '.modalClose', () => {
                $('#deleteAuthor').modal('hide');
            });
        });
    </script>
@endsection
