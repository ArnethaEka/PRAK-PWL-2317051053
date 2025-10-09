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
            <!-- Tombol di kanan atas -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('matakuliah.create') }}" 
                   class="btn text-white fw-semibold shadow-sm"
                   style="background: #92a8d1; border: none; padding: 8px 16px; border-radius: 8px; transition: 0.3s;"
                   onmouseover="this.style.opacity='0.85'"
                   onmouseout="this.style.opacity='1'">
                    Tambah Mata Kuliah Baru
                </a>
            </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table text-center align-middle mb-0"
                       style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(90deg, #92a8d1, #f7cac9); color: white;">
                            <th class="py-3" style="width: 40%; border-top-left-radius: 10px;">ID</th>
                            <th class="py-3" style="width: 40%;">Nama Mata Kuliah</th>
                            <th class="py-3" style="width: 20%; border-top-right-radius: 10px;">SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mks as $mk)
                            <tr style="background-color:#fafafa; transition: 0.3s;"
                                onmouseover="this.style.backgroundColor='#f0f4ff'"
                                onmouseout="this.style.backgroundColor='#fafafa'">
                                <td class="py-3 text-secondary fw-semibold" style="word-break: break-word;">
                                    {{ $mk->id }}
                                </td>
                                <td class="py-3 text-dark fw-semibold">{{ $mk->nama_mk }}</td>
                                <td class="py-3 text-secondary fw-semibold">{{ $mk->sks }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted fw-semibold">
                                    Belum ada data mata kuliah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tombol Kembali -->
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" 
                   class="btn text-white fw-bold shadow-sm px-4 py-2"
                   style="background: linear-gradient(90deg, #f7cac9, #f4a6b7); border: none; transition: 0.3s;"
                   onmouseover="this.style.opacity='0.85'"
                   onmouseout="this.style.opacity='1'">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
