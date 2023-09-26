@extends('backend.master')

@section('title', 'Manage Product')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="row g-4">
            <div class="col-12">
                <h1 class="text-center">Manage Product</h1>
                @include('notify')
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->desc}}</td>
                                <td><img src="{{asset($product->image)}}" alt="" height="50" width="50"></td>
                                <td>{{$product->status == 1 ? 'Active' : 'Inactive'}}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-outline-success">Edit</a>
                                        <form action="{{route('products.destroy',$product->id)}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
