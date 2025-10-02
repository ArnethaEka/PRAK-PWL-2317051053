@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center w-full  py-10">
  <div class="bg-white rounded-xl p-6 w-full max-w-2xl">
    <h1 class="text-xl font-bold mb-6 text-center text-[#92A8D1]">📋 Daftar Pengguna</h1>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse rounded-lg">
        <thead>
          <tr class="bg-[#92A8D1] text-white">
            <th class="py-2 px-4 text-left rounded-tl-lg">ID</th>
            <th class="py-2 px-4 text-left">Nama</th>
            <th class="py-2 px-4 text-left">NPM</th>
            <th class="py-2 px-4 text-left rounded-tr-lg">Kelas</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $index => $user)
          <tr class="hover:bg-[#F7CAC9]/30 transition">
            <td class="py-2 px-4 border-b">{{ $user->id }}</td>
            <td class="py-2 px-4 border-b">{{ $user->nama }}</td>
            <td class="py-2 px-4 border-b">{{ $user->npm }}</td>
            <td class="py-2 px-4 border-b">{{ $user->nama_kelas }}</td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center py-3 text-gray-500">
              Belum ada data pengguna.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
