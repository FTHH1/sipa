<x-layouts::app.sidebar :title="$title ?? null">

    <flux:main class="w-full min-h-screen px-6 py-6">

        <div class="w-full">
            {{ $slot }}
        </div>

    </flux:main>

</x-layouts::app.sidebar>
