@extends('layout')

@section('content')
    <!-- Form Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h4 class="mb-0">
                            <i class="bi bi-box-seam me-2"></i>
                            Update {{ $item->name }} | {{ $item->code }}
                        </h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form class="needs-validation" action="{{ route('update_data', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Basic Information -->
                            <div class="mb-4">
                                <h5 class="mb-3">Basic Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="itemCode" class="form-label">Item Code</label>
                                        <input type="text" value="{{ $item->code }}" class="form-control @error('code') is-invalid @enderror" id="itemCode" name="code" required>
                                        @error('code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="itemName" class="form-label">Item Name</label>
                                        <input type="text" value="{{ $item->name }}" class="form-control @error('name') is-invalid @enderror" id="itemName" name="name" required>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                            <option value="">Choose category...</option>
                                            <option value="food" {{ $item->category == 'food' ? 'selected' : '' }}>Food</option>
                                            <option value="drink" {{ $item->category == 'drink' ? 'selected' : '' }}>Drink</option>
                                            <option value="clothes" {{ $item->category == 'clothes' ? 'selected' : '' }}>Clothes</option>
                                            <option value="other" {{ $item->category == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Storage Location</label>
                                        <select class="form-select @error('storage_id') is-invalid @enderror" id="location" name="storage_id" required>
                                            <option value="">Choose location...</option>
                                            @foreach ($warehouses as $warehouse)
                                                <option value="{{ $warehouse->id }}" {{ $item->storage->id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('storage_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="existingImage">Item Image Now</label>
                                        <img src="{{ asset('storage/item-images/' . $item->image) }}" class="card-img-top"
                                        alt="Network Cable" style="height: 200px; object-fit: cover;">                
                                    </div>
                                    <div class="col-md-6">
                                        <label for="itemImage" class="form-label">Item Image</label>
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="ItemImage" accept="image/*">
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Specifications -->
                            <div class="mb-4">
                                <h5 class="mb-3">Specifications</h5>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ $item->description }}</textarea>
                                    <div class="invalid-feedback">
                                        Please provide a description.
                                    </div>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Form Actions -->
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-light">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </a>
                                <button type="submit" class t type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i> Save Item
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection