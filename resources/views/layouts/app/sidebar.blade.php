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
                href="{{ route('dashboard') }}"
                wire:navigate
            />

            <span class="font-semibold uppercase">
                {{ auth()->check() ? ucfirst(auth()->user()->role) : 'Admin' }}
            </span>

            <flux:sidebar.collapse class="lg:hidden" />

        </flux:sidebar.header>


        {{-- NAV --}}
        <flux:sidebar.nav>

            @auth
            @if(auth()->user()->role === 'admin')

            <flux:sidebar.group heading="Admin" class="grid mt-4">


                {{-- DASHBOARD --}}
                <flux:sidebar.item
                    icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')"
                    wire:navigate
                >
                    Dashboard Admin
                </flux:sidebar.item>


                {{-- USER --}}
                <flux:sidebar.item
                    icon="users"
                    :href="route('admin.users.index')"
                    :current="request()->routeIs('admin.users.*')"
                    wire:navigate
                >
                    User
                </flux:sidebar.item>


                {{-- ALAT MUSIK --}}
                <flux:sidebar.item
                    icon="musical-note"
                    :href="route('alat-musik.index')"
                    :current="request()->routeIs('alat-musik.*')"
                    wire:navigate
                >
                    Alat Musik
                </flux:sidebar.item>


                {{-- KATEGORI --}}
                <flux:sidebar.item
                    icon="tag"
                    :href="route('kategori.index')"
                    :current="request()->routeIs('kategori.*')"
                    wire:navigate
                >
                    Kategori Alat Musik
                </flux:sidebar.item>

                {{-- PEMINJAMAN --}}
                <flux:sidebar.item
                    icon="clipboard"
                    :href="route('peminjaman.index')"
                    :current="request()->routeIs('peminjaman.*')"
                    wire:navigate
                >
                    Peminjaman
                </flux:sidebar.item>



                {{-- LOG --}}
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


        {{-- USER MENU DESKTOP --}}
        @auth
            <x-desktop-user-menu
                class="hidden lg:block"
                :name="auth()->user()->name"
            />
        @endauth


    </flux:sidebar>


    {{-- MOBILE HEADER --}}
    @auth
    <flux:header class="lg:hidden">

        <flux:sidebar.toggle
            class="lg:hidden"
            icon="bars-2"
            inset="left"
        />

        <flux:spacer />

        <flux:dropdown position="top" align="end">

            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />

            <flux:menu>

                <flux:menu.radio.group>

                    <div class="p-0 text-sm font-normal">

                        <div class="flex items-center gap-2 px-1 py-1.5">

                            <flux:avatar
                                :name="auth()->user()->name"
                                :initials="auth()->user()->initials()"
                            />

                            <div class="grid flex-1 text-start leading-tight">

                                <flux:heading class="truncate">
                                    {{ auth()->user()->name }}
                                </flux:heading>

                                <flux:text class="truncate">
                                    {{ auth()->user()->email }}
                                </flux:text>

                            </div>

                        </div>

                    </div>

                </flux:menu.radio.group>


                <flux:menu.separator />


                <flux:menu.radio.group>

                    <flux:menu.item
                        :href="route('profile.edit')"
                        icon="cog"
                        wire:navigate
                    >
                        Settings
                    </flux:menu.item>

                </flux:menu.radio.group>


                <flux:menu.separator />


                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full"
                    >
                        Log Out
                    </flux:menu.item>

                </form>


            </flux:menu>

        </flux:dropdown>

    </flux:header>
    @endauth


    {{-- MAIN CONTENT --}}
    <flux:main class="p-6 w-full min-h-screen">

        {{ $slot }}

    </flux:main>


    @fluxScripts

</body>
</html>
