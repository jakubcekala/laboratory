@extends('layouts.unauthorized')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Equipment summary</h1>
    </div>
    <div class="card mx-auto">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Description</th>
                    <th scope="col">Website</th>
                    <th scope="col">Available</th>
                    <th scope="col">All amount</th>
                    <th scope="col">Image</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->url }}</td>
                        <td>{{ $item->amount }}</td>
                        <td>{{ $item->all_amount }}</td>
                        <td>{{ $item->image }}</td>
                        <td>
                            <img src="items/fetch_image/{{ $item->id }}"  class="img-thumbnail" width="75" />
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
