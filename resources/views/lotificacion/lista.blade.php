<x-layouts::app :title="__('Lista de lotes')">
    <section class="space-y-6" x-data="{
        search: '',
        selectedId: null,
        lotes: @js($lotes->map(fn($lote) => [
            'id' => $lote->id,
            'codigo' => $lote->codigo,
            'estado' => $lote->estado,
            'estado_label' => \App\Models\Lote::LABELS[$lote->estado] ?? ucfirst($lote->estado),
            'fecha_cambio' => $lote->getRawOriginal('fecha_cambio_estado')
                ? \Illuminate\Support\Carbon::parse($lote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i')
                : 'Sin registro',
            'adquiriente' => $lote->nombre_adquiriente ?: 'No registrado',
            'observaciones' => $lote->observaciones ?: 'Sin observaciones',
        ])->values()),
        filtered() {
            const q = this.search.toLowerCase().trim();
            if (!q) return this.lotes;
            return this.lotes.filter(l =>
                l.codigo.toLowerCase().includes(q) ||
                l.adquiriente.toLowerCase().includes(q) ||
                l.estado_label.toLowerCase().includes(q)
            );
        },
        selected() {
            const list = this.filtered();
            if (!list.length) return null;
            const found = list.find(l => l.id === this.selectedId);
            if (found) return found;
            this.selectedId = list[0].id;
            return list[0];
        }
    }" x-init="if (lotes.length) selectedId = lotes[0].id">
        <div class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:heading size="lg">Lista de lotes</flux:heading>
            <flux:subheading>Lotes vendidos, en reserva y pendientes de enganche</flux:subheading>
        </div>

        <div class="grid gap-4 lg:grid-cols-3">
            <div
                class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-1">
                <label class="mb-1 block text-sm font-medium text-zinc-700 dark:text-zinc-200">Buscar</label>
                <input x-model.debounce.250ms="search" type="text" placeholder="Codigo o nombre"
                    class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm text-zinc-900 outline-none ring-0 transition focus:border-zinc-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />

                <div class="mt-4 max-h-140 space-y-2 overflow-auto">
                    <template x-for="lote in filtered()" :key="lote.id">
                        <button type="button" @click="selectedId = lote.id"
                            class="w-full rounded-lg border px-3 py-2 text-left transition"
                            :class="selectedId === lote.id ? 'border-zinc-900 bg-zinc-100 dark:border-white dark:bg-zinc-700' : 'border-zinc-200 dark:border-zinc-700'">
                            <div class="text-sm font-semibold text-zinc-900 dark:text-white" x-text="lote.codigo"></div>
                            <div class="text-xs text-zinc-600 dark:text-zinc-300" x-text="lote.estado_label"></div>
                        </button>
                    </template>

                    <div x-show="filtered().length === 0"
                        class="rounded-lg border border-zinc-200 px-3 py-4 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                        No hay lotes vendidos, en reserva o pendientes de enganche.
                    </div>
                </div>
            </div>

            <div
                class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-2">
                <template x-if="selected()">
                    <div>
                        <flux:heading size="lg">
                            Detalle de lote <span x-text="selected().codigo"></span>
                        </flux:heading>

                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">Estado</div>
                                <div class="text-sm font-semibold text-zinc-900 dark:text-white"
                                    x-text="selected().estado_label"></div>
                            </div>

                            <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700">
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">Fecha de cambio</div>
                                <div class="text-sm font-semibold text-zinc-900 dark:text-white"
                                    x-text="selected().fecha_cambio"></div>
                            </div>

                            <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700 sm:col-span-2">
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">Nombre de quien adquirio / reservo
                                </div>
                                <div class="text-sm font-semibold text-zinc-900 dark:text-white"
                                    x-text="selected().adquiriente"></div>
                            </div>

                            <div class="rounded-lg border border-zinc-200 p-3 dark:border-zinc-700 sm:col-span-2">
                                <div class="text-xs text-zinc-500 dark:text-zinc-400">Observaciones</div>
                                <div class="text-sm text-zinc-900 dark:text-white" x-text="selected().observaciones">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="!selected()">
                    <div
                        class="rounded-lg border border-zinc-200 px-3 py-6 text-sm text-zinc-600 dark:border-zinc-700 dark:text-zinc-300">
                        Selecciona un lote de la lista para ver su informacion.
                    </div>
                </template>
            </div>
        </div>
    </section>
</x-layouts::app>