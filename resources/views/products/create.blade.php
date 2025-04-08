@extends('layouts.main')
@section('title'. 'Add New Product')
@section('content')
<section class="section">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Add New Products</h5>
        <div align="right" class="mt-2">
            <a href="{{ url()->previous() }}" class="text-primary">Back</a>
        </div>
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="" class="col-form-label">Product Name</label>
            <input type="text" class="form-control" name="product_name" placeholder="Enter Your Product Name" required>
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Category Name</label>
            <select name="category_id" id="" class="form-control">
                <option value="" hidden>Select One</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name}}</option>
                @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Product Price</label>
            <input type="number" class="form-control" name="product_price" placeholder="Enter Your Product Price" required>
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Product Description</label>
            <input type="text" class="form-control" name="product_description" placeholder="Enter Description">
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Product Photo</label>
            <br>
            <input type="file" name="product_photo">
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Status</label>
            <br>
            Publish <input type="radio" name="is_active" value="1" checked>
            Draft <input type="radio" name="is_active" value="0">
          </div>
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Save </button>
            <button class="btn btn-danger" type="reset">Cancel </button>


          </div>

        </form>
      </div>
    </div>
  </div>

</section>

@endsection
