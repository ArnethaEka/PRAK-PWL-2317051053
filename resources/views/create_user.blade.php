@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Buat Pengguna Baru</h1>

    <form action="{{ route('user.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <!-- Input Nama -->
        <div>
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" id="nama" name="nama" 
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <!-- Input NPM -->
        <div>
            <label for="npm" class="block text-sm font-medium text-gray-700">NPM</label>
            <input type="text" id="npm" name="npm" 
                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>

        <!-- Select Kelas -->
        <div>
            <label for="kelas_id" class="block text-sm font-medium text-gray-700">Kelas</label>
            <select id="kelas_id" name="kelas_id" 
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                @foreach ($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-gray-800 hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection