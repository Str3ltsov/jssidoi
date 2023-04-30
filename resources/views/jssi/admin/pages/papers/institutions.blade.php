@extends('layouts.admin')

@section('title', 'Institutions');

@section('content')

    <x-admin.paginated_table :paginated="$institutions">
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
                    <td>{{ $institution->title}}</td>
                    <td style="word-wrap: break-word;min-width: 250px;max-width: 250px; white-space:normal;"><a href="{{ $institution->website }}">{{ $institution->website }}</a></td>
                    <td>{{ $institution->city }}</td>
                    <td>{{ $institution->country->name}}</td>
                    <td><button type="button" class="btn btn-outline-success"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
        </x-slot:tbody_content>
    </x-admin.paginated_table>

@endsection
