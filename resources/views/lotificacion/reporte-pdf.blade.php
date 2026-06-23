<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Lotificación</title>
    <style>
        @page {
            margin: 20mm 30mm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #2d3748;
            padding: 15px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 4px solid #2563eb;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1e40af;
            margin: 0;
            letter-spacing: -0.5px;
        }

        .header p {
            font-size: 12px;
            color: #64748b;
            margin: 6px 0 0 0;
            font-weight: 500;
        }

        .fecha {
            text-align: right;
            font-size: 10px;
            color: #64748b;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .resumen {
            margin-bottom: 25px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .resumen-card {
            border: 2px solid #e2e8f0;
            padding: 14px;
            text-align: center;
            border-radius: 6px;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .resumen-card h3 {
            font-size: 10px;
            color: #475569;
            margin: 0 0 8px 0;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .resumen-card .numero {
            font-size: 24px;
            font-weight: 700;
            color: #1e40af;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 10px;
        }

        table thead {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        }

        table th,
        table td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }

        table th {
            font-weight: 700;
            color: #ffffff;
            background: #1e40af;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        table tbody tr {
            background-color: #fff;
        }

        table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        table tbody tr:hover {
            background-color: #f0f9ff;
        }

        .section-title {
            font-weight: 700;
            font-size: 13px;
            margin-top: 22px;
            margin-bottom: 12px;
            color: #1e40af;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .color-box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 2px;
            margin-right: 4px;
            vertical-align: middle;
        }

        .text-center {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        .footer {
            font-size: 9px;
            color: #94a3b8;
            text-align: center;
            margin-top: 35px;
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Lotificación</h1>
        <p>Nueva Jerusalem</p>
    </div>

    <div class="fecha">
        Generado: {{ now('America/Guatemala')->format('d/m/Y H:i') }}
    </div>

    <div class="resumen">
        <div class="resumen-card">
            <h3>Total</h3>
            <div class="numero">{{ $totales['total'] }}</div>
        </div>
        <div class="resumen-card">
            <h3>Vendidos</h3>
            <div class="numero">{{ $totales['vendido'] }}</div>
        </div>
        <div class="resumen-card">
            <h3>Reserva</h3>
            <div class="numero">{{ $totales['reserva'] }}</div>
        </div>
        <div class="resumen-card">
            <h3>Pendientes</h3>
            <div class="numero">{{ $totales['pendiente_enganche'] }}</div>
        </div>
    </div>

    <div class="section-title">Lotes Vendidos ({{ $totales['vendido'] }})</div>
    @if ($grouped->get(\App\Models\Lote::ESTADO_VENDIDO, collect())->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Adquiriente</th>
                    <th>Fecha de venta</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped->get(\App\Models\Lote::ESTADO_VENDIDO, collect()) as $lote)
                    <tr>
                        <td>{{ $lote->codigo }}</td>
                        <td>{{ $lote->nombre_adquiriente ?: '-' }}</td>
                        <td>{{ $lote->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($lote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999; font-size: 10px;">No hay lotes vendidos</p>
    @endif

    <div class="section-title">Lotes en Reserva ({{ $totales['reserva'] }})</div>
    @if ($grouped->get(\App\Models\Lote::ESTADO_RESERVA, collect())->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Reservado por</th>
                    <th>Fecha de reserva</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped->get(\App\Models\Lote::ESTADO_RESERVA, collect()) as $lote)
                    <tr>
                        <td>{{ $lote->codigo }}</td>
                        <td>{{ $lote->nombre_adquiriente ?: '-' }}</td>
                        <td>{{ $lote->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($lote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999; font-size: 10px;">No hay lotes en reserva</p>
    @endif

    <div class="section-title">Lotes Pendientes de Enganche ({{ $totales['pendiente_enganche'] }})</div>
    @if ($grouped->get(\App\Models\Lote::ESTADO_PENDIENTE_ENGANCHE, collect())->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Fecha de asignación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped->get(\App\Models\Lote::ESTADO_PENDIENTE_ENGANCHE, collect()) as $lote)
                    <tr>
                        <td>{{ $lote->codigo }}</td>
                        <td>{{ $lote->nombre_adquiriente ?: '-' }}</td>
                        <td>{{ $lote->getRawOriginal('fecha_cambio_estado') ? \Illuminate\Support\Carbon::parse($lote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="color: #999; font-size: 10px;">No hay lotes pendientes de enganche</p>
    @endif

    <div class="footer">
        Reporte • Lotificación Nueva Jerusalem
    </div>
</body>
</html>
