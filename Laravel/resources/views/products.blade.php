@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Products CRUD</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ isset($editProduct) ? route('products.update', $editProduct->id) : route('products.store') }}" class="row g-3 align-items-end">
                        @csrf
                        @if(isset($editProduct))
                            @method('PUT')
                        @endif
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $editProduct->name ?? '') }}" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $editProduct->price ?? '') }}" required>
                        </div>
                        <div class="col-md-5">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $editProduct->description ?? '') }}">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success me-2">{{ isset($editProduct) ? 'Update' : 'Add' }} Product</button>
                            @if(isset($editProduct))
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Product List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No products found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 