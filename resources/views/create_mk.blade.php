@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4" 
         style="background: linear-gradient(135deg, #f7cac9, #92a8d1); max-width: 750px; margin: 0 auto;">
        
        <!-- Header -->
        <div class="card-header text-center text-white rounded-top-4" 
             style="background: linear-gradient(90deg, #92a8d1, #f7cac9);">
            <h3 class="mb-0 fw-bold"> Tambah Mata Kuliah Baru </h3>
        </div>

        <!-- Body -->
        <div class="card-body p-5 bg-white rounded-bottom-4">
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

            <form action="{{ route('matakuliah.store') }}" method="POST" class="px-3">
                @csrf

                <div class="mb-4 d-flex align-items-center justify-content-center">
                    <label for="nama_mk" class="form-label fw-semibold text-dark me-3 mb-0" style="width: 180px;">
                        Nama Mata Kuliah
                    </label>
                    <input type="text" id="nama_mk" name="nama_mk" 
                           class="form-control border-0 shadow-sm rounded-3 p-3"
                           placeholder="Contoh: Pemrograman Web Lanjut" 
                           required
                           style="width: 70%; background-color:#f9f9f9;">
                </div>

                <div class="mb-4 d-flex align-items-center justify-content-center">
                    <label for="sks" class="form-label fw-semibold text-dark me-3 mb-0" style="width: 180px;">
                        Jumlah SKS
                    </label>
                    <input type="number" id="sks" name="sks" 
                           class="form-control border-0 shadow-sm rounded-3 p-3"
                           placeholder="Masukkan jumlah SKS" required
                           style="width: 70%; background-color:#f9f9f9;">
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn px-4 py-2 fw-bold text-white shadow-sm"
                            style="background: linear-gradient(90deg, #92a8d1, #b0c4de); border: none;">
                         Simpan
                    </button>
                    <a href="{{ url('/matakuliah') }}" 
                       class="btn px-4 py-2 fw-bold text-white ms-2 shadow-sm"
                       style="background: linear-gradient(90deg, #f7cac9, #f4a6b7); border: none;">
                         Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
