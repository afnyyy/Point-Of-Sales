@extends('layouts.main')
@section('title'. 'Add New Categories')
@section('content')
<section class="section">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit categories</h5>
        <form action="{{ route('categories.update', $edit->id) }}" method="post">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="" class="col-form-label">Category Name</label>
            <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required value="{{ $edit->category_name }}">
          </div>
          <div class="mb-3">
            <button class="btn btn-primary" type="submit">Save </button>
            <button class="btn btn-danger" type="reset">Cancel </button>
            <a href="{{ url()->previous() }}" class="text-primary">Back</a>

          </div>

        </form>
      </div>
    </div>
  </div>

</section>

@endsection
