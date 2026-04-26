@extends('parts.layout')

@section('judul_halaman', 'Data Player & Saldo Waktu')

@section('konten')
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">

        <div class="p-6 border-b border-slate-100 bg-white flex justify-between items-center relative overflow-hidden z-10">
            <h3 class="font-extrabold text-slate-800 text-lg flex items-center gap-2 tracking-tight">
                 Daftar Akun Terdaftar
            </h3>
            <span class="bg-blue-50 text-brand-blue border border-blue-200/60 text-xs font-black px-4 py-1.5 rounded-full shadow-sm tracking-wide">
                Total: {{ $users->count() }} Player
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/80 backdrop-blur-sm border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider">Info Player</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 3</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 4</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-center">Saldo PS 5</th>
                        <th class="px-6 py-5 font-extrabold text-xs text-slate-400 uppercase tracking-wider text-right">Bergabung</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-extrabold text-slate-800 tracking-tight text-base mb-0.5">{{ $user->name }}</div>
                                <div class="text-[11px] text-slate-400 font-bold tracking-wide">{{ $user->email }}</div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps3 > 0)
                                    <span class="inline-flex items-center justify-center bg-slate-50 text-brand-blue border border-slate-200 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps3 / 60) }}j {{ $user->saldo_ps3 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps4 > 0)
                                    <span class="inline-flex items-center justify-center bg-slate-50 text-brand-blue border border-slate-200 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps4 / 60) }}j {{ $user->saldo_ps4 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($user->saldo_ps5 > 0)
                                    <span class="inline-flex items-center justify-center bg-slate-50 text-brand-blue border border-slate-200 px-3 py-1.5 rounded-xl text-xs font-black shadow-sm min-w-[70px]">
                                        {{ floor($user->saldo_ps5 / 60) }}j {{ $user->saldo_ps5 % 60 }}m
                                    </span>
                                @else
                                    <span class="text-slate-300 text-xs font-extrabold">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right text-xs text-slate-400 font-bold tracking-wide">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    <p class="font-bold text-sm">Belum ada player yang mendaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
