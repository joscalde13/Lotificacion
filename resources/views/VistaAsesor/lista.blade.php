<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Lotes - Lotificación Nueva Jerusalem</title>
    <meta name="description" content="Lista de lotes vendidos, en reserva y pendientes de enganche de la Lotificación Nueva Jerusalem.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #0d1117;
            --surface: #161b22;
            --border:  #30363d;
            --accent:  #58a6ff;
            --text:    #e6edf3;
            --muted:   #8b949e;
            --card:    #21262d;
            --radius:  12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 24px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            gap: 12px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar a.back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--muted);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 14px;
            border: 1px solid var(--border);
            border-radius: 6px;
            transition: all .2s;
        }

        .topbar a.back-btn:hover {
            color: var(--text);
            border-color: var(--accent);
            background: rgba(88,166,255,.08);
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
        }

        /* MAIN */
        main {
            flex: 1;
            padding: 28px 24px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* HEADER CARD */
        .page-header {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 20px;
            border-top: 3px solid var(--accent);
        }

        .page-header h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
        }

        /* GRID LAYOUT */
        .grid-layout {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 16px;
        }

        @media (max-width: 900px) {
            .grid-layout { grid-template-columns: 1fr; }
        }

        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 18px;
        }

        /* SEARCH */
        .search-label {
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 14px;
            color: var(--text);
            font-family: inherit;
            outline: none;
            transition: border-color .2s;
        }

        input[type="text"]:focus { border-color: var(--accent); }

        /* LOTE LIST */
        .lote-list {
            margin-top: 14px;
            max-height: 560px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 6px;
            scrollbar-width: thin;
            scrollbar-color: var(--border) transparent;
        }

        .lote-btn {
            width: 100%;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px 14px;
            cursor: pointer;
            text-align: left;
            transition: border-color .18s, background .18s;
            font-family: inherit;
        }

        .lote-btn:hover { background: rgba(88,166,255,.06); border-color: rgba(88,166,255,.4); }
        .lote-btn.active { border-color: var(--accent); background: rgba(88,166,255,.1); }

        .lote-btn-code {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            display: block;
        }

        .lote-btn-estado {
            font-size: 11px;
            color: var(--muted);
            display: block;
            margin-top: 2px;
        }

        .empty-msg {
            font-size: 13px;
            color: var(--muted);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 16px;
            text-align: center;
        }

        /* DETAIL PANEL */
        .detail-header {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 16px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .detail-field {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
        }

        .detail-field.full { grid-column: 1 / -1; }

        .detail-field-label {
            font-size: 11px;
            color: var(--muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 4px;
        }

        .detail-field-value {
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .placeholder-msg {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            color: var(--muted);
            font-size: 14px;
            border: 1px dashed var(--border);
            border-radius: 8px;
        }

        footer {
            text-align: center;
            padding: 16px;
            color: var(--muted);
            font-size: 12px;
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body x-data="{
    search: '',
    selectedId: null,
    lotes: {{ Js::from($lotes->map(fn($lote) => [
        'id' => $lote->id,
        'codigo' => $lote->codigo,
        'estado' => $lote->estado,
        'estado_label' => \App\Models\Lote::LABELS[$lote->estado] ?? ucfirst($lote->estado),
        'fecha_cambio' => $lote->getRawOriginal('fecha_cambio_estado')
            ? \Illuminate\Support\Carbon::parse($lote->getRawOriginal('fecha_cambio_estado'), 'UTC')->timezone('America/Guatemala')->format('d/m/Y H:i')
            : 'Sin registro',
        'adquiriente' => $lote->nombre_adquiriente ?: 'No registrado',
        'observaciones' => $lote->observaciones ?: 'Sin observaciones',
    ])->values()) }},
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

    <header class="topbar">
        <div class="topbar-left">
            <a href="{{ route('home') }}" class="back-btn" id="btn-volver-inicio">← Volver</a>
            <span class="topbar-title">Lista de Lotes</span>
        </div>
        <a href="{{ route('login') }}" class="back-btn" id="btn-ir-login">🔐 Iniciar sesión</a>
    </header>

    <main>
        <div class="page-header">
            <h1>Lista de lotes</h1>
            <p>Lotes vendidos, en reserva y pendientes de enganche</p>
        </div>

        <div class="grid-layout">
            <!-- PANEL IZQUIERDO: Búsqueda y lista -->
            <div class="panel">
                <label class="search-label">Buscar</label>
                <input x-model.debounce.250ms="search" type="text" placeholder="Código o nombre" id="input-buscar-lote" />

                <div class="lote-list">
                    <template x-for="lote in filtered()" :key="lote.id">
                        <button
                            type="button"
                            class="lote-btn"
                            :class="selectedId === lote.id ? 'active' : ''"
                            @click="selectedId = lote.id"
                        >
                            <span class="lote-btn-code" x-text="lote.codigo"></span>
                            <span class="lote-btn-estado" x-text="lote.estado_label"></span>
                        </button>
                    </template>

                    <div x-show="filtered().length === 0" class="empty-msg">
                        No hay lotes vendidos, en reserva o pendientes de enganche.
                    </div>
                </div>
            </div>

            <!-- PANEL DERECHO: Detalle -->
            <div class="panel">
                <template x-if="selected()">
                    <div>
                        <div class="detail-header">
                            Detalle de lote <span x-text="selected().codigo"></span>
                        </div>

                        <div class="detail-grid">
                            <div class="detail-field">
                                <div class="detail-field-label">Estado</div>
                                <div class="detail-field-value" x-text="selected().estado_label"></div>
                            </div>

                            <div class="detail-field">
                                <div class="detail-field-label">Fecha de cambio</div>
                                <div class="detail-field-value" x-text="selected().fecha_cambio"></div>
                            </div>

                            <div class="detail-field full">
                                <div class="detail-field-label">Nombre de quien adquirió / reservó</div>
                                <div class="detail-field-value" x-text="selected().adquiriente"></div>
                            </div>

                            <div class="detail-field full">
                                <div class="detail-field-label">Observaciones</div>
                                <div class="detail-field-value" x-text="selected().observaciones"></div>
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="!selected()">
                    <div class="placeholder-msg">
                        Selecciona un lote de la lista para ver su información.
                    </div>
                </template>
            </div>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Lotificación Nueva Jerusalem &mdash; Portal de Asesores
    </footer>

</body>
</html>
