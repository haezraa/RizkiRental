@extends('layouts.main')

@section('judul_halaman', 'Data Player & Saldo Waktu')

@section('konten')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-lg">Daftar Akun Terdaftar</h3>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full">Total: {{ $users->count() }} Player</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-white border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Info Player</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Saldo PS 3</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Saldo PS 4</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Saldo PS 5</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-400 font-mono">{{ $user->email }}</div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps3 > 0)
                                    <span class="bg-blue-100 text-[#2251a5] px-3 py-1 rounded-md text-xs font-black border border-blue-200">
                                        {{ floor($user->saldo_ps3 / 60) }}j {{ $user->saldo_ps3 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-gray-300 text-xs font-bold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps4 > 0)
                                    <span class="bg-blue-100 text-[#2251a5] px-3 py-1 rounded-md text-xs font-black border border-blue-200">
                                        {{ floor($user->saldo_ps4 / 60) }}j {{ $user->saldo_ps4 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-gray-300 text-xs font-bold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps5 > 0)
                                    <span class="bg-blue-100 text-[#2251a5] px-3 py-1 rounded-md text-xs font-black border border-blue-200">
                                        {{ floor($user->saldo_ps5 / 60) }}j {{ $user->saldo_ps5 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-gray-300 text-xs font-bold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right text-xs text-gray-500 font-medium">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">
                                Belum ada player yang mendaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
