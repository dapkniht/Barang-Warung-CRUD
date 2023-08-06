<?php

namespace App\Http\Controllers;

use App\DataTables\BarangDataTable;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class Barangcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Barang::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $deleteRoute = route('barang.destroy',$row->id);
                $editRoute = route('barang.edit',$row->id);
                   $btn = "<a href='".$editRoute."'class='edit btn btn-primary btn-sm'>Edit</a>";
                   $btn .= '<form action="' . $deleteRoute . '" method="POST" class="d-inline">';
                   $btn .= csrf_field();
                   $btn .= method_field('DELETE');
                   $btn .= '<button type="submit" class="btn btn-sm btn-danger">Delete</button>';
                   $btn .= '</form>';
           
                return $btn;
            })
            ->rawColumns(['action'])
                    ->make();
        }
        return view('barang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::select(['nama_kategori','id'])->get();
        return view('barang.create',['listkategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'kategori_id' => "required"
        ]);
        Barang::create($validated);
        return redirect('/barang')->with(['status' => 'sukses', 'message' => 'Berhasil menambah barang baru']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return $barang;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $kategori = Kategori::select(['nama_kategori','id'])->get();
        return view('barang.edit',['barang' => $barang,'listkategori' => $kategori, 'id' => $barang->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
            'kategori_id' => "required"
        ]);

        $barang->update($validated);
        return redirect('/barang')->with(['status' => 'sukses', 'message' => 'Berhasil mengubah data barang']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->back()->with(['status' => 'sukses', 'message' => 'Berhasil menghapus barang']);
    }
}
