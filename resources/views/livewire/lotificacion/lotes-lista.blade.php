<section class="space-y-6">
    <div class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:heading size="lg">Lista de lotes</flux:heading>
        <flux:subheading>Lotes vendidos, en reserva y pendientes de enganche</flux:subheading>
    </div>

    <div class="grid gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-1">
            <flux:input wire:model.debounce.300ms="search" type="text" label="Buscar" placeholder="Codigo o nombre" />

            <div class="mt-4 max-h-140 space-y-2 overflow-auto">
                @forelse ($lotes as $lote)
                    <button type="button" wire:key="lista-lote-{{ $lote->id }}" wire:click="selectLote({{ $lote->id }})"
                        class="w-full rounded-lg border px-3 py-2 text-left transition {{ $selectedLote && $selectedLote->id === $lote->id ? 'border-zinc-900 bg-zinc-100 dark:border-white dark:bg-zinc-700' : 'border-zinc-200 dark:border-zinc-700' }}">
                        <div class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $lote->codigo }}</div>
                        <div class="text-xs text-zinc-600 dark:text-zinc-300">
                            {{ \App\Models\Lote::LABELS[$lote->estado] ?? ucfirst($lote->estado) }}
                        </div>
                    </button>
                @empty
                    <div
                        class="rounded-lg border border-zinc-200 px-3 py-4 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                        No hay lotes vendidos, en reserva o pendientes de enganche.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-2">
            @if ($selectedLote)
                <flux:heading size="lg">Detalle de lote {{ $selectedLote->codigo }}</flux:heading>

                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Estado</div>
                        <div class="text-sm font-semibold text-zinc-900 dark:text-white">
                            {{ \App\Models\Lote::LABELS[$selectedLote->estado] ?? ucfirst($selectedLote->estado) }}
                        </div>
                    </div>

                    <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Fecha de cambio</div>
                        <div class="text-sm font-semibold text-zinc-900 dark:text-white">
                            {{ $selectedLote->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($selectedLote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : 'Sin registro' }}
                        </div>
                    </div>

                    <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700 sm:col-span-2">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Nombre de quien adquirio / reservo</div>
                        <div class="text-sm font-semibold text-zinc-900 dark:text-white">
                            {{ $selectedLote->nombre_adquiriente ?: 'No registrado' }}
                        </div>
                    </div>

                    <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700 sm:col-span-2">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400">Observaciones</div>
                        <div class="text-sm text-zinc-900 dark:text-white">
                            {{ $selectedLote->observaciones ?: 'Sin observaciones' }}
                        </div>
                    </div>
                </div>
            @else
                <div
                    class="rounded-lg border border-zinc-200 px-3 py-6 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                    Selecciona un lote de la lista para ver su informacion.
                </div>
            @endif
        </div>
    </div>
</section>