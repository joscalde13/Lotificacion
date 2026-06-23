<?php

namespace App\Livewire\Lotificacion;

use App\Models\Lote;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Lotificacion Nueva Jerusalem')]
class LotificacionIndex extends Component
{
    use AuthorizesRequests;

    public string $search = '';

    /**
     * @var array<string, array{codigo: string, estado: string, color: string, estado_label: string}>
     */
    public array $lotes = [];

    public function mount(): void
    {
        $this->authorize('viewAny', Lote::class);

        $this->loadLotes();
    }

    #[On('lote-updated')]
    public function loadLotes(): void
    {
        $this->lotes = Lote::query()
            ->orderBy('codigo')
            ->get()
            ->mapWithKeys(fn (Lote $lote): array => [
                $lote->codigo => [
                    'codigo' => $lote->codigo,
                    'estado' => $lote->estado,
                    'color' => $lote->color(),
                    'estado_label' => $lote->estadoLabel(),
                ],
            ])
            ->all();
    }

    public function openLote(string $codigo): void
    {
        $this->dispatch('lote-selected', codigo: $codigo);
    }

    public function render()
    {
        $query = mb_strtolower(trim((string) $this->search));

        $filteredLotes = collect($this->lotes)
            ->filter(function (array $lote, string $codigo) use ($query): bool {
                if ($query === '') {
                    return true;
                }

                return str_contains(mb_strtolower((string) $codigo), $query)
                    || str_contains(mb_strtolower((string) $lote['estado_label']), $query)
                    || str_contains(mb_strtolower((string) $lote['estado']), $query);
            })
            ->all();

        return view('livewire.lotificacion.lotificacion-index', [
            'filteredLotes' => $filteredLotes,
        ]);
    }
}
