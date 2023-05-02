@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <x-admin.paginated_table :paginated="$countries">
        <x-slot:header_right>
        <a href='{{route('jssi.admin.countries.create')}}' class="btn btn-success">Add new</a>
        </x-slot:header_right>

        <x-slot:thead_content>
            <th>Id</th>
            <th>Code</th>
            <th>Name</th>
            <th>Actions</th>
        </x-slot:thead_content>
        <x-slot:tbody_content>
            @foreach ($countries as $country)
                <tr>
                    <td>{{ $country->id }}</td>
                    <td>{{ $country->code}}</td>
                    <td>{{ $country->name }}</td>
                    <td><a href="{{route('jssi.admin.countries.edit', $country->id)}}"  class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-outline-danger deleteBtn"  data-id={{$country->id}}
        data-toggle="modal"
        data-target="#deleteCountry"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>

    <div class="modal fade" id="deleteCountry" data-backdrop="static" tabindex="-1" role="dialog"
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
                        Are you sure you want to delete country <span id="modal-country_name"></span>?
                        <input type="hidden" id="category" name="category_id">
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('jssi.admin.countries.destroy', 'id') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" hidden value=''>

                         <button type="button" class="btn btn-secondary modalClose" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-danger">Yes, Delete Country</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<script>
     $(document).on('click','.deleteBtn',function(){
             let id = $(this).attr('data-id');
             $('#id').val(id);
             $('#deleteCountry').modal('show');
             $('#deleteCountry').on('click', '.modalClose', () => {
                $('#deleteCountry').modal('hide');
             });
        });
</script>


@endsection
