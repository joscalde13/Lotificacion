<?php

namespace App\Livewire\Lotificacion;

use App\Models\Lote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Lista de lotes')]
class LotesLista extends Component
{
    use AuthorizesRequests;

    public string $search = '';

    public ?int $selectedLoteId = null;

    public function selectLote(int $loteId): void
    {
        $this->selectedLoteId = $loteId;
    }

    public function render()
    {
        $this->authorize('viewAny', Lote::class);

        $query = mb_strtolower(trim($this->search));

        $lotes = Lote::query()
            ->whereIn('estado', [Lote::ESTADO_VENDIDO, Lote::ESTADO_RESERVA, Lote::ESTADO_PENDIENTE_ENGANCHE])
            ->when($query !== '', function ($builder) use ($query) {
                $builder->where(function ($inner) use ($query) {
                    $inner->whereRaw('LOWER(codigo) like ?', ["%{$query}%"])
                        ->orWhereRaw('LOWER(COALESCE(nombre_adquiriente, \"\")) like ?', ["%{$query}%"]);
                });
            })
            ->get()
            ->sortBy('codigo', SORT_NATURAL)
            ->values();

        if ($this->selectedLoteId === null && $lotes->isNotEmpty()) {
            $this->selectedLoteId = $lotes->first()->id;
        }

        $selectedLote = $lotes->firstWhere('id', $this->selectedLoteId);

        return view('livewire.lotificacion.lotes-lista', [
            'lotes' => $lotes,
            'selectedLote' => $selectedLote,
        ]);
    }
}
