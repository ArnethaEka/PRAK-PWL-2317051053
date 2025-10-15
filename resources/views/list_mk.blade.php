@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4"
         style="background: #fff; max-width: 900px; margin: 0 auto;">

        <!-- Header -->
        <div class="px-4 py-3 rounded-top-4"
             style="background: linear-gradient(90deg, #92a8d1, #f7cac9);">
            <h5 class="mb-0 fw-bold text-white d-flex align-items-center">
                Daftar Mata Kuliah
            </h5>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <!-- Tombol Tambah -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ url('/matakuliah/create') }}"
                   class="btn text-white fw-semibold shadow-sm"
                   style="background: #92a8d1; border: none; padding: 8px 16px; border-radius: 8px; transition: 0.3s;"
                   onmouseover="this.style.opacity='0.85'"
                   onmouseout="this.style.opacity='1'">
                    Tambah Mata Kuliah Baru
                </a>
            </div>

            <!-- Pesan sukses -->
            @if(session('success'))
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            confirmButtonColor: '#92a8d1',
                        });
                    });
                </script>
            @endif

            <!-- Tabel Mata Kuliah -->
            <div class="table-responsive">
                <table class="table text-center align-middle mb-0"
                       style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #92a8d1, #f7cac9); color: white;">
                            <th class="py-3" style="border-top-left-radius: 10px;">ID</th>
                            <th class="py-3">Nama Mata Kuliah</th>
                            <th class="py-3">SKS</th>
                            <th class="py-3" style="border-top-right-radius: 10px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mks as $mk)
                            <tr style="background-color:#fafafa; transition: 0.3s;"
                                onmouseover="this.style.backgroundColor='#f0f4ff'"
                                onmouseout="this.style.backgroundColor='#fafafa'">
                                <td class="py-3 text-secondary fw-semibold">{{ $mk->id }}</td>
                                <td class="py-3 text-dark fw-semibold">{{ $mk->nama_mk }}</td>
                                <td class="py-3 text-secondary fw-semibold">{{ $mk->sks }}</td>
                                <td class="py-3">
                                    <!-- Tombol Edit -->
                                    <button type="button"
                                            class="btn btn-sm text-white"
                                            style="background: #92a8d1; border-radius: 6px; padding: 4px 10px; margin-right: 4px;"
                                            onclick="toggleEditForm('{{ $mk->id }}')">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <form id="deleteForm{{ $mk->id }}" 
                                          action="{{ route('matakuliah.destroy', $mk->id) }}" 
                                          method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="btn btn-sm text-white"
                                                style="background: #f4a6b7; border-radius: 6px; padding: 4px 10px;"
                                                onclick="confirmDelete('{{ $mk->id }}')">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Form Edit (Hidden) -->
                            <tr id="editForm{{ $mk->id }}" style="display: none;">
                                <td colspan="4" class="bg-light p-4 rounded-3">
                                    <form action="{{ route('matakuliah.update', $mk->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3 text-start">
                                            <label for="nama_mk_{{ $mk->id }}" class="fw-semibold">Nama Mata Kuliah:</label>
                                            <input type="text" id="nama_mk_{{ $mk->id }}" name="nama_mk"
                                                   class="form-control rounded-3"
                                                   value="{{ $mk->nama_mk }}" required>
                                        </div>

                                        <div class="mb-3 text-start">
                                            <label for="sks_{{ $mk->id }}" class="fw-semibold">SKS:</label>
                                            <input type="number" id="sks_{{ $mk->id }}" name="sks"
                                                   class="form-control rounded-3"
                                                   value="{{ $mk->sks }}" required>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn text-white fw-semibold"
                                                    style="background: #92a8d1; border: none; border-radius: 6px; padding: 6px 14px;">
                                                Update
                                            </button>
                                            <button type="button"
                                                    class="btn text-white fw-semibold"
                                                    style="background: #f4a6b7; border: none; border-radius: 6px; padding: 6px 14px;"
                                                    onclick="toggleEditForm('{{ $mk->id }}')">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted fw-semibold">
                                    Belum ada data mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toggleEditForm(id) {
    const form = document.getElementById('editForm' + id);
    form.style.display = (form.style.display === 'none' || form.style.display === '') 
        ? 'table-row' : 'none';
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin hapus data ini?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f4a6b7',
        cancelButtonColor: '#92a8d1',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + id).submit();
        }
    });
}
</script>
@endsection
