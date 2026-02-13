<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen w-full bg-white dark:bg-zinc-800">


{{-- SIDEBAR --}}
<flux:sidebar
    sticky
    collapsible="mobile"
    class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
>

    {{-- HEADER --}}
    <flux:sidebar.header>

        <x-app-logo
            :sidebar="true"
            href="{{ route('home') }}"
            wire:navigate
        />

        <span class="font-semibold uppercase">
            {{ auth()->check() ? ucfirst(auth()->user()->role) : 'Admin' }}
        </span>

        <flux:sidebar.collapse class="lg:hidden" />

    </flux:sidebar.header>


    {{-- NAV --}}
    <flux:sidebar.nav>

        {{-- PETUGAS --}}
        @auth
        @if(auth()->user()->role === 'petugas')

        <flux:sidebar.group heading="Petugas" class="grid mt-4">

            <flux:sidebar.item
                icon="home"
                :href="route('dashboard.petugas')"
                :current="request()->routeIs('dashboard.petugas')"
                wire:navigate
            >
                Dashboard
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="eye"
                :href="route('monitoring.index')"
                :current="request()->routeIs('monitoring.*')"
                wire:navigate
            >
                Monitoring
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="printer"
                :href="route('laporan.index')"
                :current="request()->routeIs('laporan.*')"
                wire:navigate
            >
                Laporan
            </flux:sidebar.item>

        </flux:sidebar.group>

        @endif
        @endauth


      {{-- PEMINJAM --}}
                    @auth
                    @if(auth()->user()->role === 'peminjam')

                    <flux:sidebar.group heading="Peminjam" class="grid mt-4">

                        <flux:sidebar.item
                            icon="musical-note"
                            :href="route('peminjam.daftar-alat-musik')"
                            :current="request()->routeIs('peminjam.alat-musik')"
                            wire:navigate
                        >
                            Daftar Alat Musik
                        </flux:sidebar.item>

                        <flux:sidebar.item
                            icon="archive-box"
                            :href="route('peminjam.pinjaman-saya')"
                            :current="request()->routeIs('peminjam.pinjaman-saya')"
                            wire:navigate
                        >
                            Pinjaman Saya
                        </flux:sidebar.item>


                    </flux:sidebar.group>

                    @endif
                    @endauth



        {{-- ADMIN --}}
        @auth
        @if(auth()->user()->role === 'admin')

        <flux:sidebar.group heading="Admin" class="grid mt-4">

            <flux:sidebar.item
                icon="home"
                :href="route('dashboard')"
                :current="request()->routeIs('dashboard')"
                wire:navigate
            >
                Dashboard Admin
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="users"
                :href="route('admin.users.index')"
                :current="request()->routeIs('admin.users.*')"
                wire:navigate
            >
                User
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="musical-note"
                :href="route('alat-musik.index')"
                :current="request()->routeIs('alat-musik.*')"
                wire:navigate
            >
                Alat Musik
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="tag"
                :href="route('kategori.index')"
                :current="request()->routeIs('kategori.*')"
                wire:navigate
            >
                Kategori
            </flux:sidebar.item>

            <flux:sidebar.item
                icon="clipboard"
                :href="route('peminjaman.index')"
                :current="request()->routeIs('peminjaman.*')"
                wire:navigate
            >
                Peminjaman
            </flux:sidebar.item>

            <flux:sidebar.item
                    icon="arrow-uturn-left"
                    :href="route('admin.pengembalian')"
                    :current="request()->routeIs('admin.pengembalian')"
                    wire:navigate
                >
                    Pengembalian
                </flux:sidebar.item>

            <flux:sidebar.item
                icon="clipboard-document-list"
                :href="route('admin.logs')"
                :current="request()->routeIs('admin.logs')"
                wire:navigate
            >
                Activity Log
            </flux:sidebar.item>

        </flux:sidebar.group>

        @endif
        @endauth

    </flux:sidebar.nav>


    <flux:spacer />


    {{-- USER MENU --}}
    @auth
        <x-desktop-user-menu
            class="hidden lg:block"
            :name="auth()->user()->name"
        />
    @endauth


</flux:sidebar>



{{-- MAIN CONTENT --}}
<flux:main class="p-6 w-full min-h-screen">

    <div class="max-w-7xl mx-auto w-full">

        {{ $slot }}

    </div>

</flux:main>


@fluxScripts

</body>
</html>
