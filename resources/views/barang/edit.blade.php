@extends('layouts.index')
@section('content')
    
<div class="container-fluid px-4">
    <h1 class="mt-4">Barang Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('barang.index')}}">Dashboard Barang</a></li>
        <li class="breadcrumb-item active">Edit barang</li>
    </ol>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route('barang.update',['barang' => $id])}}" method="POST">
      @method('PUT')
        @csrf
        <div class="mb-3">
          <label for="barang" class="form-label">Nama Barang</label>
          <input type="text" class="form-control" id="barang" name="nama_barang" value="{{$barang->nama_barang}}">
        </div>
        <div class="mb-3">
          <label for="stok" class="form-label">Stok</label>
          <input type="text" class="form-control" id="stok" name="stok" value="{{$barang->stok}}"">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{$barang->harga}}">
          </div>
          <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" name="kategori_id">
                <option value="{{null}}">Pilih kategori</option>
                @foreach ($listkategori as $kategori)
                     <option value="{{$kategori->id}}"
                      @if ($kategori->id == $barang->kategori_id)
                          return selected
                      @endif>{{$kategori->nama_kategori}}</option>
                @endforeach
              </select>
          </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection