<x-layouts::app :title="__('Dashboard')">

    <div class="max-w-7xl mx-auto px-6 py-6">

        @role('admin')
            @include('dashboard.partials.admin')
        @endrole

        @role('petugas')
            @include('dashboard.partials.petugas')
        @endrole

        @role('peminjam')
            @include('dashboard.partials.peminjam')
        @endrole

    </div>

</x-layouts::app>
