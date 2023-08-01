<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::select('id','nama_barang')->get();
        return response()->json([
            "status" => "sukses",
            "data" => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarangRequest $request)
    {
        $validated = $request->validated();
        $stored_barang = Barang::create($validated);
        return response()->json([
            "status" => "sukses",
            "data" => $stored_barang
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
         return response()->json([
            "status" => "sukses",
            "data" => $barang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $validated = $request->validated();
        $barang->update($validated);
        return response()->json([
            "status" => "sukses",
            "data" => $barang
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return response()->json([
            "status" => "sukses",
            "data" => $barang
        ]);
    }
}
