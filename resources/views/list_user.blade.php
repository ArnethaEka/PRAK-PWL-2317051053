@extends('layouts.app')

@section('content')

<style>
    .modal-bg {
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(0,0,0,0.3);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999;
        opacity: 0; pointer-events: none;
        transition: opacity 0.3s;
    }
    .modal-bg.active { opacity: 1; pointer-events: auto; }
    .modal-box {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(89,247,254,0.15);
        min-width: 350px;
        max-width: 95vw;
        padding: 2rem 2.5rem;
        animation: popIn 0.4s cubic-bezier(.68,-0.55,.27,1.55);
    }
    @keyframes popIn {
        0% { transform: scale(0.7); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>

<div id="createModal" class="modal-bg">
    <div class="modal-box">
        <h5 class="mb-3 fw-bold" style="background: linear-gradient(90deg, #a1c4fd, #c2e9fb); -webkit-background-clip: text; color: transparent;">Tambah User</h5>
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold">Nama:</label>
                <input type="text" name="nama" class="form-control rounded-3" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">NPM:</label>
                <input type="text" name="npm" class="form-control rounded-3" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Kelas:</label>
                <select name="kelas_id" class="form-select rounded-3" required>
                    <option value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" onclick="closeModal('createModal')">Batal</button>
                <button type="submit" class="btn text-white fw-semibold" style="background: linear-gradient(90deg, #89f7fe, #66a6ff); border: none; border-radius: 8px;">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal-bg">
    <div class="modal-box" id="editModalContent">
        <!-- Edit form will be injected by JS -->
    </div>
</div>

<div id="deleteModal" class="modal-bg">
    <div class="modal-box text-center">
        <h5 class="mb-3 fw-bold" style="background: linear-gradient(90deg, #ff9a9e, #fad0c4); -webkit-background-clip: text; color: transparent;">Konfirmasi Hapus</h5>
        <p>Yakin ingin menghapus user ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="d-flex justify-content-center gap-2 mt-3">
                <button type="button" class="btn btn-secondary" onclick="closeModal('deleteModal')">Batal</button>
                <button type="submit" class="btn text-white fw-semibold" style="background: linear-gradient(90deg, #ff9a9e, #fad0c4); border: none; border-radius: 8px;">🗑️ Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).classList.add('active');
}
function closeModal(id) {
    document.getElementById(id).classList.remove('active');
}
function showEditModal(user) {
    let modal = document.getElementById('editModal');
    let content = document.getElementById('editModalContent');
    content.innerHTML = `
        <h5 class=\"mb-3 fw-bold\" style=\"background: linear-gradient(90deg, #89f7fe, #66a6ff); -webkit-background-clip: text; color: transparent;\">Edit User</h5>
        <form action=\"/user/${user.id}\" method=\"POST\">
            @csrf
            @method('PUT')
            <div class=\"mb-3\">
                <label class=\"fw-semibold\">Nama:</label>
                <input type=\"text\" name=\"nama\" class=\"form-control rounded-3\" value=\"${user.nama}\" required>
            </div>
            <div class=\"mb-3\">
                <label class=\"fw-semibold\">NPM:</label>
                <input type=\"text\" name=\"npm\" class=\"form-control rounded-3\" value=\"${user.npm}\" required>
            </div>
            <div class=\"mb-3\">
                <label class=\"fw-semibold\">Kelas:</label>
                <select name=\"kelas_id\" class=\"form-select rounded-3\" required>
                    <option value=\"\">Pilih Kelas</option>
                    ${window.kelasOptions}
                </select>
            </div>
            <div class=\"d-flex justify-content-end gap-2\">
                <button type=\"button\" class=\"btn btn-secondary\" onclick=\"closeModal('editModal')\">Batal</button>
                <button type=\"submit\" class=\"btn text-white fw-semibold\" style=\"background: linear-gradient(90deg, #89f7fe, #66a6ff); border: none; border-radius: 8px;\">� Simpan</button>
            </div>
        </form>
    `;
    openModal('editModal');
}
function showDeleteModal(userId) {
    let form = document.getElementById('deleteForm');
    form.action = `/user/${userId}`;
    openModal('deleteModal');
}
window.kelasOptions = `@foreach ($kelas as $k)<option value='{{ $k->id }}'>{{ $k->nama_kelas }}</option>@endforeach`;
</script>

<div class="container mt-5">

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success text-center fw-semibold rounded-3 mb-4">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center fw-semibold rounded-3 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-4" style="background: #fff; max-width: 950px; margin: 0 auto;">
        <!-- Header -->
        <div class="px-4 py-3 rounded-top-4"
             style="background: linear-gradient(90deg, #a1c4fd, #c2e9fb);">
            <h5 class="mb-0 fw-bold text-white d-flex align-items-center">Daftar User (Mahasiswa)</h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">
            <div class="mb-3 text-end">
                <button type="button" class="btn text-white shadow-sm" style="background: linear-gradient(90deg, #a1c4fd, #c2e9fb); border-radius: 10px; padding: 6px 18px; font-weight:600;" onclick="openModal('createModal')">➕ Tambah User</button>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle mb-0">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #a1c4fd, #c2e9fb); color: white;">
                            <th class="py-3">ID</th>
                            <th class="py-3">Nama</th>
                            <th class="py-3">NPM</th>
                            <th class="py-3">Kelas</th>
                            <th class="py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr style="background-color:#fafafa; transition: 0.3s;"
                                onmouseover="this.style.backgroundColor='#eef4ff'"
                                onmouseout="this.style.backgroundColor='#fafafa'">
                                <td class="py-3 text-secondary fw-semibold" style="font-size:13px;">{{ $user->id }}</td>
                                <td class="py-3 text-dark fw-semibold">{{ $user->nama }}</td>
                                <td class="py-3 text-secondary fw-semibold">{{ $user->npm }}</td>
                                <td class="py-3 text-secondary fw-semibold">{{ $user->kelas->nama_kelas ?? '-' }}</td>
                                <td class="py-3 d-flex justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <button type="button"
                                            class="btn text-white shadow-sm"
                                            style="background: linear-gradient(90deg, #89f7fe, #66a6ff); border-radius: 10px; padding: 6px 14px; font-weight:600;"
                                            onclick='showEditModal(@json($user))'>
                                        ✏️ Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button"
                                            class="btn text-white shadow-sm"
                                            style="background: linear-gradient(90deg, #ff9a9e, #fad0c4); border-radius: 10px; padding: 6px 14px; font-weight:600;"
                                            onclick='showDeleteModal({{ $user->id }})'>
                                        🗑️ Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Form Edit moved to modal -->
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted fw-semibold">
                                    Belum ada user yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script toggle edit -->
<script>
function toggleEditForm(id) {
    const form = document.getElementById('editForm' + id);
    form.style.display = (form.style.display === 'none' || form.style.display === '') 
        ? 'table-row' : 'none';
}
</script>
@endsection
