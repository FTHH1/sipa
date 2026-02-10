<x-layouts::app :title="__('Dashboard')">

    <div class="w-full p-6 space-y-6">
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
