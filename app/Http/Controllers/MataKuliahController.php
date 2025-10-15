<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    // 🟦 Menampilkan daftar mata kuliah
    public function index()
    {
        $data = [
            'title' => 'List Mata Kuliah',
            'mks' => MataKuliah::all(),
        ];
        return view('list_mk', $data);
    }

    // 🟦 Menampilkan form untuk menambah data mata kuliah
    public function create()
    {
        return view('create_mk', ['title' => 'Create Mata Kuliah']);
    }

    // 🟩 Menyimpan data mata kuliah baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        MataKuliah::create([
            'nama_mk' => $request->input('nama_mk'),
            'sks' => $request->input('sks'),
        ]);

        // redirect ke list + pesan sukses
        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan!');
    }

    // 🟦 Menampilkan form edit (jika kamu punya halaman khusus edit)
    public function edit($id)
    {
        $mk = MataKuliah::findOrFail($id);
        return view('edit_mk', ['title' => 'Edit Mata Kuliah', 'mk' => $mk]);
    }

    // 🟨 Mengupdate data mata kuliah
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_mk' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $mk = MataKuliah::findOrFail($id);
        $mk->update([
            'nama_mk' => $request->input('nama_mk'),
            'sks' => $request->input('sks'),
        ]);

        // redirect ke list + pesan sukses
        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    // 🟥 Menghapus data mata kuliah
    public function destroy($id)
    {
        $mk = MataKuliah::findOrFail($id);
        $mk->delete();

        // redirect ke list + pesan sukses
        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus!');
    }
}
