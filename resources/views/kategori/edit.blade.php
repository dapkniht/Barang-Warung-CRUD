@extends('layouts.index')
@section('content')
    
<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('kategori.index')}}">Dashboard Kategori</a></li>
        <li class="breadcrumb-item active">Edit Kategori</li>
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
    <form action="{{route('kategori.update',['kategori'=>$kategori->id])}}" method="POST">
        @csrf   
        @method('PUT')
        <div class="mb-3">
          <label for="kategori" class="form-label">Nama Kategori</label>
          <input type="text" class="form-control" id="kategori" name="nama_kategori" value="{{$kategori->nama_kategori}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection