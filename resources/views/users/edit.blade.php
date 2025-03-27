@extends('layouts.main')
@section('title'. 'Add New Users')
@section('content')
<section class="section">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Users</h5>
        <form action="{{ route('users.update', $edit->id) }}" method="post">
          @csrf
          @method('put')
          <div class="mb-3">
            <label for="" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Your Name" required value="{{ $edit->name }}">
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Enter Your Email" required value="{{ $edit->email }}">
          </div>
          <div class="mb-3">
            <label for="" class="col-form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
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
