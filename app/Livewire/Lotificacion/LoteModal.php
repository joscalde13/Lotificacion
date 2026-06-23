<?php

namespace App\Livewire\Lotificacion;

use App\Models\Lote;
use Flux\Flux;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class LoteModal extends Component
{
    use AuthorizesRequests;

    public bool $showModal = false;

    public ?int $loteId = null;

    public string $codigo = '';

    public string $estado = Lote::ESTADO_DISPONIBLE;

    public ?string $fechaCambioEstado = null;

    public ?string $observaciones = null;

    public ?string $nombreAdquiriente = null;

    /**
     * @var array<string, string>
     */
    public array $estadoOptions = [];

    public function mount(): void
    {
        $this->estadoOptions = Lote::estadoOptions();
    }

    #[On('lote-selected')]
    public function open(string $codigo): void
    {
        $lote = Lote::query()->where('codigo', $codigo)->first();

        if (! $lote) {
            Flux::toast(variant: 'danger', text: __('El lote seleccionado no existe en la base de datos.'));

            return;
        }

        $this->authorize('view', $lote);

        $this->loteId = $lote->id;
        $this->codigo = $lote->codigo;
        $this->estado = $lote->estado;
        $rawFechaCambio = $lote->getRawOriginal('fecha_cambio_estado');
        $this->fechaCambioEstado = $rawFechaCambio
            ? Carbon::parse($rawFechaCambio, 'UTC')->timezone('America/Guatemala')->format('Y-m-d H:i:s')
            : null;
        $this->observaciones = $lote->observaciones;
        $this->nombreAdquiriente = $lote->nombre_adquiriente;
        $this->showModal = true;
    }

    public function save(): void
    {
        if (! $this->loteId) {
            return;
        }

        $lote = Lote::query()->findOrFail($this->loteId);

        $this->authorize('update', $lote);

        $validated = $this->validate([
            'estado' => ['required', 'in:'.implode(',', Lote::ESTADOS)],
            'observaciones' => ['nullable', 'string', 'max:1000'],
            'nombreAdquiriente' => ['nullable', 'string', 'max:255', 'required_if:estado,'.Lote::ESTADO_VENDIDO.','.Lote::ESTADO_RESERVA.','.Lote::ESTADO_PENDIENTE_ENGANCHE],
        ]);

        $estadoCambio = $lote->estado !== $validated['estado'];

        $lote->estado = $validated['estado'];
        $lote->observaciones = $validated['observaciones'];
        $lote->nombre_adquiriente = in_array($validated['estado'], [Lote::ESTADO_VENDIDO, Lote::ESTADO_RESERVA, Lote::ESTADO_PENDIENTE_ENGANCHE], true)
            ? $validated['nombreAdquiriente']
            : null;

        if ($estadoCambio) {
            $lote->fecha_cambio_estado = now('UTC');
        }

        $lote->save();

        $rawFechaCambio = $lote->getRawOriginal('fecha_cambio_estado');
        $this->fechaCambioEstado = $rawFechaCambio
            ? Carbon::parse($rawFechaCambio, 'UTC')->timezone('America/Guatemala')->format('Y-m-d H:i:s')
            : null;

        $this->showModal = false;

        Flux::toast(variant: 'success', text: __('Estado del lote actualizado correctamente.'));

        $this->dispatch('lote-updated');
    }

    public function getCanEditProperty(): bool
    {
        return Auth::user()?->role === 'oficina';
    }

    public function render()
    {
        return view('livewire.lotificacion.lote-modal');
    }
}
