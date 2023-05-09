@extends('layouts.admin')
@section('title', 'Issues')
@section('content')
    <x-admin.paginated_table :paginated="$issues">
        <x-slot:header_right>
            <a href='{{ route('jssi.admin.issues.create') }}' class="btn btn-success">Add new</a>
        </x-slot:header_right>
        <x-slot:thead_content>
            <th>ID</th>
            <th>Vol.</th>
            <th>No.</th>
            <th>Date</th>
            <th>Print</th>
            <th>Online</th>
            <th>Visible</th>
            <th>Views</th>
            <th>Downloads</th>
            <th>Actions</th>
        </x-slot:thead_content>
        <x-slot:tbody_content>
            @foreach ($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->volume }}</td>
                    <td>{{ $issue->number }}</td>
                    <td>{{ date('F Y', strtotime($issue->date)) }} </td>
                    <td><span title="{{ $issue->print }}">{{ mb_strimwidth($issue->print, 0, 35, '...') }}</span></td>
                    <td><span title="{{ $issue->online }}">{{ mb_strimwidth($issue->online, 0, 35, '...') }}</span></td>
                    <td>{{ $issue->visible }}</td>
                    <td>{{ $issue->views }}</td>
                    <td>{{ $issue->downloads }}</td>
                    <td>
                        <a href="{{ route('jssi.admin.issues.edit', $issue->id) }}" class="btn btn-outline-success"
                            role="button"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $issue->id }}
                            data-name="{{ sprintf('%s.%s', $issue->volume, $issue->number) }} " data-toggle="modal"
                            data-target="#deleteIssue"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>


    <div class="modal fade" id="deleteIssue" data-backdrop="static" tabindex="-1" role="dialog"
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
                    Are you sure you want to delete issue <span id="modal-issue_name"></span>?
                    <input type="hidden" id="category" name="issue_id">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('jssi.admin.issues.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                        <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete issue</button>
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
            $('#deleteIssue').modal('show');
            $('#modal-issue_name').text(name);
            $('#deleteIssue').on('click', '.modalClose', () => {
                $('#deleteIssue').modal('hide');
            });
        });
    </script>
@endsection
