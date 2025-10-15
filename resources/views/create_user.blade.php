@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4" style="background: linear-gradient(135deg, #f7cac9, #92a8d1);">
        <div class="card-header text-center text-white rounded-top-4" 
             style="background: linear-gradient(90deg, #92a8d1, #f7cac9);">
            <h3 class="mb-0 fw-bold">🩵 Tambah Pengguna Baru 🩷</h3>
        </div>

        <div class="card-body p-4 bg-white rounded-bottom-4">
            @if(session('success'))
                <div class="alert alert-success text-center fw-semibold rounded-3">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST" class="px-2">
                @csrf

                <!-- Input Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold text-[#92A8D1]">Nama</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        class="form-control border-2 rounded-3" 
                        placeholder="Masukkan nama pengguna" 
                        required
                        style="border-color: #f7cac9;"
                    >
                </div>

                <!-- Input NPM -->
                <div class="mb-3">
                    <label for="npm" class="form-label fw-semibold text-[#92A8D1]">NPM</label>
                    <input 
                        type="text" 
                        id="npm" 
                        name="npm" 
                        class="form-control border-2 rounded-3" 
                        placeholder="Masukkan NPM pengguna" 
                        required
                        style="border-color: #f7cac9;"
                    >
                </div>

                <!-- Select Kelas -->
                <div class="mb-3">
                    <label for="kelas_id" class="form-label fw-semibold text-[#92A8D1]">Kelas</label>
                    <select 
                        id="kelas_id" 
                        name="kelas_id" 
                        class="form-select border-2 rounded-3" 
                        style="border-color: #f7cac9;" 
                        required
                    >
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center mt-4">
                    <button 
                        type="submit" 
                        class="btn px-4 py-2 fw-bold text-white" 
                        style="background: linear-gradient(90deg, #92a8d1, #f7cac9); border: none; transition: 0.3s;"
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'"
                    >
                        💾 Simpan
                    </button>

                    <a 
                        href="{{ url('/user') }}" 
                        class="btn px-4 py-2 fw-bold text-white ms-2" 
                        style="background: linear-gradient(90deg, #f7cac9, #92a8d1); border: none; transition: 0.3s;"
                        onmouseover="this.style.opacity='0.85'"
                        onmouseout="this.style.opacity='1'"
                    >
                        ⬅ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
