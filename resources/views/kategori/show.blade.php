@extends('layouts.index')
@section('content')
    
<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori Dashboard</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{route('kategori.index')}}">Dashboard Kategori</a></li>
        <li class="breadcrumb-item active">Show Kategori</li>
    </ol>
    @if (session('status') == 'sukses')
    <div class="alert alert-success">
      {{ session('message') }}
  </div>
    @endif
    <h2 class="mb-4">{{$kategori->nama_kategori}}</h2>
    <table class="table table-striped" id="barang">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">nama_barang</th>
            <th scope="col">stok</th>
            <th scope="col">harga</th>
            <th scope="col">kategori</th>
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
$(document).ready(function (){
        var table = $('#barang').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url()->current() }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nama_barang', name: 'nama_barang'},
                {data: 'stok', name: 'stok'},
                {data: 'harga', name: 'harga'},
                {data: 'kategori_id', name: 'kategori_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });  
})
 
  </script>
@endpush