<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-zinc-900">
            <flux:heading size="lg">Resumen de lotes</flux:heading>
            <flux:subheading>Estado general de la Lotificación Nueva Jerusalem</flux:subheading>

            <div class="mt-4 grid gap-4 md:grid-cols-2 xl:grid-cols-5">
                <div class="rounded-lg border border-neutral-200 p-4 dark:border-neutral-700">
                    <div class="text-sm text-neutral-500 dark:text-neutral-300">Total de lotes</div>
                    <div class="mt-1 text-3xl font-bold text-neutral-900 dark:text-white">{{ $totalLotes }}</div>
                </div>

                @foreach ($byEstado as $estado)
                    <div class="rounded-lg border border-neutral-200 p-4 dark:border-neutral-700">
                        <div class="flex items-center gap-2 text-sm text-neutral-500 dark:text-neutral-300">
                            <span class="inline-block h-2.5 w-2.5 rounded-full" style="background-color: {{ $estado['color'] }}"></span>
                            {{ $estado['label'] }}
                        </div>
                        <div class="mt-1 text-2xl font-bold text-neutral-900 dark:text-white">{{ $estado['total'] }}</div>
                        <div class="text-xs text-neutral-500 dark:text-neutral-300">{{ $estado['percentage'] }}%</div>
                    </div>
                @endforeach
            </div>

           

            <div class="mt-5 flex flex-wrap gap-2">
                <flux:button variant="primary" :href="route('lotificacion.index')" wire:navigate>
                    Ver lotes
                </flux:button>

                <flux:button variant="filled" :href="route('lotificacion.lista')" wire:navigate>
                    Ver lista de lotes
                </flux:button>

                <flux:button variant="filled" :href="route('lotificacion.mapa')" wire:navigate>
                    Ver mapa de lotificación
                </flux:button>

                
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-2">
            <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-zinc-900">
                <flux:heading size="lg">Ultimos cambios</flux:heading>
                <div class="mt-4 overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-neutral-200 text-left text-neutral-500 dark:border-neutral-700 dark:text-neutral-300">
                                <th class="py-2 pe-3">Lote</th>
                                <th class="py-2 pe-3">Estado</th>
                                <th class="py-2 pe-3">Adquiriente</th>
                                <th class="py-2">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ultimosCambios as $cambio)
                                <tr class="border-b border-neutral-100 dark:border-neutral-800">
                                    <td class="py-2 pe-3 font-semibold text-neutral-900 dark:text-white">{{ $cambio->codigo }}</td>
                                    <td class="py-2 pe-3 text-neutral-700 dark:text-neutral-200">{{ \App\Models\Lote::LABELS[$cambio->estado] ?? ucfirst($cambio->estado) }}</td>
                                    <td class="py-2 pe-3 text-neutral-700 dark:text-neutral-200">{{ $cambio->nombre_adquiriente ?: '-' }}</td>
                                    <td class="py-2 text-neutral-700 dark:text-neutral-200">{{ $cambio->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($cambio->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-neutral-500 dark:text-neutral-300">No hay cambios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-zinc-900">
                <flux:heading size="lg">Pendientes de enganche</flux:heading>
                <div class="mt-4 overflow-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-neutral-200 text-left text-neutral-500 dark:border-neutral-700 dark:text-neutral-300">
                                <th class="py-2 pe-3">Lote</th>
                                <th class="py-2 pe-3">Nombre</th>
                                <th class="py-2">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendientesRecientes as $pendiente)
                                <tr class="border-b border-neutral-100 dark:border-neutral-800">
                                    <td class="py-2 pe-3 font-semibold text-neutral-900 dark:text-white">{{ $pendiente->codigo }}</td>
                                    <td class="py-2 pe-3 text-neutral-700 dark:text-neutral-200">{{ $pendiente->nombre_adquiriente ?: '-' }}</td>
                                    <td class="py-2 text-neutral-700 dark:text-neutral-200">{{ $pendiente->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($pendiente->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-neutral-500 dark:text-neutral-300">No hay pendientes registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
