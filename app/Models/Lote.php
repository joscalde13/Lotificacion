<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    public const ESTADO_DISPONIBLE = 'disponible';

    public const ESTADO_VENDIDO = 'vendido';

    public const ESTADO_RESERVA = 'reserva';

    public const ESTADO_PENDIENTE_ENGANCHE = 'pendiente_enganche';

    /**
     * @var array<int, string>
     */
    public const ESTADOS = [
        self::ESTADO_DISPONIBLE,
        self::ESTADO_VENDIDO,
        self::ESTADO_RESERVA,
        self::ESTADO_PENDIENTE_ENGANCHE,
    ];

    /**
     * @var array<string, string>
     */
    public const LABELS = [
        self::ESTADO_DISPONIBLE => 'Disponible',
        self::ESTADO_VENDIDO => 'Vendido',
        self::ESTADO_RESERVA => 'Reserva oficina',
        self::ESTADO_PENDIENTE_ENGANCHE => 'Pendiente de enganche',
    ];

    /**
     * @var array<string, string>
     */
    public const COLORS = [
        self::ESTADO_DISPONIBLE => '#16a34a',
        self::ESTADO_VENDIDO => '#b91c1c',
        self::ESTADO_RESERVA => '#eab308',
        self::ESTADO_PENDIENTE_ENGANCHE => '#a855f7',
    ];

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'codigo',
        'estado',
        'fecha_cambio_estado',
        'observaciones',
        'nombre_adquiriente',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_cambio_estado' => 'datetime',
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function estadoOptions(): array
    {
        return self::LABELS;
    }

    public function color(): string
    {
        return self::COLORS[$this->estado] ?? self::COLORS[self::ESTADO_DISPONIBLE];
    }

    public function estadoLabel(): string
    {
        return self::LABELS[$this->estado] ?? ucfirst($this->estado);
    }
}
