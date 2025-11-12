<!DOCTYPE html>
<html lang="en" data-theme="light">

@extends('layouts.head')

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Page content here -->
            <div class="flex-1 p-4 lg:p-8 overflow-y-auto">
                @yield('content')
            </div>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content flex flex-col">
                <!-- Sidebar content here -->
                <li class="mb-4">
                    <a class="text-2xl font-bold" href="{{ route('dashboard') }}">
                        <x-heroicon-o-book-open class="w-8 h-8" />
                        Perpustakaan
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}">
                        <x-heroicon-o-home class="w-6 h-6" />
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}">
                        <x-heroicon-o-book-open class="w-6 h-6" />
                        Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.index') }}">
                        <x-heroicon-o-tag class="w-6 h-6" />
                        Kategori Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('members.index') }}">
                        <x-heroicon-o-users class="w-6 h-6" />
                        Anggota
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}">
                        <x-heroicon-o-user class="w-6 h-6" />
                        User
                    </a>
                </li>

                <li>
                    <a href="{{ route('fines.index') }}">
                    <x-heroicon-o-banknotes class="w-6 h-6" />
                        Denda
                    </a>
                </li>

                <li>
                    <a href="{{ route('borrows.index') }}">
                        <x-heroicon-o-arrows-right-left class="w-6 h-6" />
                        Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}">
                        <x-heroicon-o-clipboard-document-list class="w-6 h-6" />
                        Laporan
                    </a>
                </li>

                <li class="mt-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-x-2">
                            <x-heroicon-o-arrow-left-on-rectangle class="w-6 h-6" />
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
