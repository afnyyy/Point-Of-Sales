@extends('layouts.main')
@section('title', 'Data Products')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $title ?? ''}}</h5>
          <div class="mt-4 mb-3">
            <div align="right" class="mb-3">
              <a class="btn btn-primary" href="{{route('products.create')}}">Add Products</a>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>

                  <th>No</th>
                  <th>Photo</th>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php $no=1 @endphp
                @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index += 1 }}</td>
                  <td><img src="{{ asset('storage/' . $data->product_photo) }}" alt="" width="150"></td>
                  <td>{{ $data->category->category_name }}</td>
                  <td>{{ $data->product_name}}</td>
                  <td>{{ $data->product_price}}</td>
                  <td>{{ $data->is_active ? 'Publish' : 'Draft' }}</td>
                  <td>
                    <a href="{{ route('products.edit', $data->id) }}" class="btn btn-secondary"><i class="bi bi-pencil"></i></a>
                    <form class="d-inline" action="{{ route('products.destroy', $data->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
@endsection
