@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
    <x-admin.paginated_table :paginated="$countries">
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
                    <td><button type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>
@endsection
