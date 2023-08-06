@extends('layouts.index')
@section('content')
    
<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Kategori Dashboard</li>
    </ol>
    @if (session('status') == 'sukses')
    <div class="alert alert-success">
      {{ session('message') }}
  </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<a class="btn btn-primary mb-4" href="{{route('kategori.create')}}" role="button">Tambah Kategori</a>
    <table class="table table-striped" id="kategori">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">nama_kategori</th>
            <th scope="col">total_barang</th>
            <th scope="col">aksi</th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
      </table>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
console.log('dssdds')
$(document).ready(function (){
        var table = $('#kategori').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url()->current() }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama_kategori', name: 'nama_kategori'},
                {data: 'total_barang', name: 'total_barang'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });  
})
 
  </script>
@endpush