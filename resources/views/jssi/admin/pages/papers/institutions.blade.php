@extends('layouts.admin')

@section('title', 'Institutions');

@section('content')

    <x-admin.paginated_table :paginated="$institutions">
        <x-slot:header_right>
            <a href='{{ route('jssi.admin.institutions.create') }}' class="btn btn-success">Add new</a>
        </x-slot:header_right>
        <x-slot:thead_content>
            <th>Id</th>
            <th>Title</th>
            <th>Website</th>
            <th>City</th>
            <th>Country</th>
            <th>Adctions</th>
        </x-slot:thead_content>
        <x-slot:tbody_content>
            @foreach ($institutions as $institution)
                <tr>
                    <td>{{ $institution->id }}</td>
                    <td>{{ $institution->title }}</td>
                    <td style="word-wrap: break-word;min-width: 250px;max-width: 250px; white-space:normal;"><a
                            href="{{ $institution->website }}">{{ $institution->website }}</a></td>
                    <td>{{ $institution->city }}</td>
                    <td>{{ $institution->country->name }}</td>
                    <td> <a href="{{ route('jssi.admin.institutions.edit', $institution->id) }}"
                            class="btn btn-outline-success" role="button"><i class="fas fa-edit"></i></a>
                        <button type="button" class="btn btn-outline-danger deleteBtn" data-id={{ $institution->id }}
                            data-name="{{ $institution->title }}" data-toggle="modal" data-target="#deleteInstitution"><i
                                class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>

    <div class="modal fade" id="deleteInstitution" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="deleteInstitution" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">This action is not reversible!</h5>
                    <button type="button" class="close modalClose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete institution <span id="modal-institution_name"></span>?
                    <input type="hidden" id="category" name="issue_id">
                </div>
                <div class="modal-footer">
                    <form action="{{ route('jssi.admin.institutions.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                        <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete institution</button>
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
            $('#deleteInstitution').modal('show');
            $('#modal-institution_name').text(name);
            $('#deleteInstitution').on('click', '.modalClose', () => {
                $('#deleteInstitution').modal('hide');
            });
        });
    </script>
@endsection
