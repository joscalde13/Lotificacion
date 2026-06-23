<flux:modal
    wire:model="showModal"
    name="lotificacion-lote-modal"
    class="max-w-lg"
>
    <div class="space-y-6">
        <div class="space-y-2">
            <flux:heading size="lg">Lote {{ $codigo }}</flux:heading>
            <flux:subheading>
                Estado actual: {{ $estadoOptions[$estado] ?? ucfirst($estado) }}
            </flux:subheading>

            <div class="text-sm text-zinc-600 dark:text-zinc-300">
                Fecha del ultimo cambio:
                {{ $fechaCambioEstado ? \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $fechaCambioEstado)->format('d/m/Y H:i') : 'Sin cambios registrados' }}
            </div>

            <div class="text-sm text-zinc-600 dark:text-zinc-300">
                Adquiriente: {{ $nombreAdquiriente ?: 'No registrado' }}
            </div>
        </div>

        @if ($this->canEdit)
            <form wire:submit.prevent="save" class="space-y-5">
                <flux:select wire:model="estado" label="Estado">
                    @foreach ($estadoOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </flux:select>

                <flux:input
                    wire:model="nombreAdquiriente"
                    type="text"
                    label="Nombre de quien adquirio / reservo"
                    placeholder=""
                />

                <flux:textarea
                    wire:model="observaciones"
                    label="Observaciones"
                    rows="3"
                    placeholder=""
                />

                <div class="flex justify-end gap-2">
                    <flux:modal.close>
                        <flux:button variant="filled">Cerrar</flux:button>
                    </flux:modal.close>

                    <flux:button variant="primary" type="submit">Guardar</flux:button>
                </div>
            </form>
        @else
            <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-4 text-sm text-zinc-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                Tu rol ASESOR solo tiene permisos de visualizacion.
            </div>

            <div class="flex justify-end">
                <flux:modal.close>
                    <flux:button variant="primary">Cerrar</flux:button>
                </flux:modal.close>
            </div>
        @endif
    </div>
</flux:modal>
