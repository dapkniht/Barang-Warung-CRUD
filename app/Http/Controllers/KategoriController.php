<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function index()
    {
        $kategori = Kategori::select('id','nama_kategori')->get();
        return response()->json([
            "status" => "sukses",
            "data" => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request)
    {
        $validated = $request->validated();
        $stored_kategori = Kategori::create($validated);
        return response()->json([
            "status" => "sukses",
            "data" => $stored_kategori
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        $kategori->barang;
        return response()->json([
            "status" => "sukses",
            "data" => $kategori,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $validated = $request->validated();
        $kategori->update($validated);
        return response()->json([
            "status" => "sukses",
            "data" => $kategori
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json([
            "status" => "sukses",
            "data" => $kategori
        ]);
    }
}
