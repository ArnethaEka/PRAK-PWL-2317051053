<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;

class UserController extends Controller
{
    protected $userModel;
    protected $kelasModel;

    public function __construct()
    {
    $this->userModel = new UserModel();
    $this->kelasModel = new Kelas();
    }

    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
            'kelas' => $this->kelasModel->getKelas()
        ];
        return view('list_user', $data);
    }

    /**
     * Form tambah user baru
     */
    public function create()
    {
        $data = [
            'title' => 'Create User',
            'kelas' => $this->kelasModel->getKelas()
        ];
        return view('create_user', $data);
    }

    /**
     * Menyimpan user baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'npm' => 'required|string|max:20|unique:users,npm',
            'kelas_id' => 'required'
        ]);

        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    // app/Http/Controllers/UserController.php

public function edit($uuid)
{
    $user = User::where('uuid', $uuid)->firstOrFail();
    return view('user.edit_user', compact('user'));
}

public function update(Request $request, $uuid)
{
    $user = User::where('uuid', $uuid)->firstOrFail();

    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'nim' => 'required|string|max:20',
        'kelas' => 'required|string|max:20',
    ]);

    $user->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'nim' => $request->nim,
        'kelas' => $request->kelas,
    ]);

    return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
}

public function destroy($uuid)
{
    $user = User::where('uuid', $uuid)->firstOrFail();
    $user->delete();

    return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus!');
}
}
