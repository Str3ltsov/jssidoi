        @extends('layouts.admin')

        @section('title', 'Pages')

        @section('content')

            <x-admin.paginated_table :paginated="$users">
                <x-slot:header_right>
                    <a href='{{ route('admin.pages.create') }}' class="btn btn-success">Add new</a>
                </x-slot:header_right>
                <x-slot:thead_content>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </x-slot:thead_content>

                <x-slot:tbody_content>
                    @foreach ($users as $user)
                        <tr>
                            <td> {{ $user->id }}</td>
                            <td> {{ $user->email }}</td>
                            <td> {{ $page->email }}</td>
                            <td><a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline-success"><i
                                        class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $page->id }}
                                    data-name="{{ $user->email }}" data-toggle="modal" data-target="#deletePage"><i
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
                            Are you sure you want to delete user <span id="modal-page_name"></span>?
                            <input type="hidden" id="category" name="issue_id">
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('admin.users.destroy', 'id') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input id="id" name="id" hidden value=''>

                                <button type="button" class="btn btn-secondary modalClose"
                                    data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yes, Delete user</button>
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
