@extends('layouts.main')
@section('title', 'Data Categories')

@section('content')
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $title ?? ''}}</h5>
          <div class="mt-4 mb-3">
            <div align="right" class="mb-3">
              <a class="btn btn-primary" href="{{route('categories.create')}}">Add Categories</a>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @php $no=1 @endphp
                @foreach ($datas as $index => $data)
                <tr>
                  <td>{{ $index += 1 }}</td>
                  <td>{{ $data->category_name }}</td>
                  <td></td>
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