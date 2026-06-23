<section class="space-y-6">
    <div class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:heading size="lg">Lotificacion Nueva Jerusalem</flux:heading>
        <flux:subheading>Listado interactivo de codigos de lotes</flux:subheading>
    </div>

    <div class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
        <div class="mb-4">
            <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Buscar lote</label>
            <input
                wire:model.live.debounce.250ms="search"
                type="text"
                placeholder="Ejemplo: 18B1"
                class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 outline-none ring-0 transition focus:border-zinc-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white"
            />
        </div>

        <div class="mb-4 flex items-center justify-between">
            <div class="grid gap-2 text-sm md:grid-cols-2 lg:grid-cols-4">
                <div>🟢 Lote disponible</div>
                <div>🔴 Lote vendido</div>
                <div>🟡 Reserva de oficina</div>
                <div>🟣 Pendiente de enganche</div>
            </div>

            <a href="{{ route('lotificacion.reporte') }}" wire:navigate class="rounded-md bg-emerald-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-emerald-700 dark:bg-emerald-700 dark:hover:bg-emerald-800">
                ⬇ Descargar reporte
            </a>
        </div>

        <div class="grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8">
            @forelse ($filteredLotes as $codigo => $lote)
                <button
                    type="button"
                    wire:key="lote-{{ $codigo }}"
                    wire:click="openLote('{{ $codigo }}')"
                    class="rounded-md border px-3 py-2 text-left text-xs font-semibold text-zinc-900 transition hover:opacity-90 dark:text-white"
                    style="background-color: {{ $lote['color'] }}22; border-color: {{ $lote['color'] }};"
                    title="{{ $lote['estado_label'] }}"
                >
                    {{ $codigo }}
                </button>
            @empty
                <div class="col-span-full rounded-md border border-zinc-200 px-3 py-4 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                    No se encontraron lotes con ese criterio.
                </div>
            @endforelse
        </div>
    </div>

    <livewire:lotificacion.lote-modal wire:key="lotificacion-lote-modal" />
</section>
