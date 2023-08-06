<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kategori::query();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total_barang', function($kategori) {
                return $kategori->barang->count();
            })
            ->addColumn('action', function($row){
                $showRoute = route('kategori.show',$row->id);
                $deleteRoute = route('kategori.destroy',$row->id);
                $editRoute = route('kategori.edit',$row->id);
                   $btn = "<a href='".$showRoute."'class='edit btn btn-info btn-sm'>Show</a>";
                   $btn .= "<a href='".$editRoute."'class='edit btn btn-warning btn-sm'>Edit</a>";
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
        return view('kategori.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required',
        ]);
        Kategori::create($validated);
        return redirect('/kategori')->with(['status' => 'sukses', 'message' => 'Berhasil menambah kategori baru']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,Kategori $kategori)
    {
        if ($request->ajax()) {
            return DataTables::of($kategori->barang)
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
        return view('kategori.show',['kategori' => $kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.edit',['kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori->update($validated);
        return redirect('/kategori')->with(['status' => 'sukses', 'message' => 'Berhasil menagubah data kategori']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->back()->with(['status' => 'sukses', 'message' => 'Berhasil menghapus kategori']);
    }
}
