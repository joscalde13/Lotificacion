<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotificación Interactiva - Nueva Jerusalem</title>
    <meta name="description" content="Vista interactiva de todos los lotes de la Lotificación Nueva Jerusalem con código de colores por estado.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #0d1117;
            --surface: #161b22;
            --border:  #30363d;
            --accent:  #3fb950;
            --accent2: #58a6ff;
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

        .topbar a {
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

        .topbar a:hover {
            color: var(--text);
            border-color: var(--accent2);
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
            padding: 24px;
            max-width: 1400px;
            width: 100%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* HEADER CARD */
        .page-header {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 24px;
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

        /* CONTENT PANEL */
        .panel {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 24px;
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
            margin-bottom: 16px;
        }

        input[type="text"]:focus { border-color: var(--accent); }

        /* LEGEND */
        .legend {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--muted);
        }

        /* LOTES GRID */
        .lotes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(88px, 1fr));
            gap: 8px;
        }

        .lote-btn {
            border-radius: 8px;
            border: 2px solid transparent;
            padding: 9px 10px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            cursor: default;
            color: var(--text);
            font-family: inherit;
            transition: transform .15s, box-shadow .15s;
        }

        .lote-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,.35);
        }

        .empty-msg {
            grid-column: 1 / -1;
            text-align: center;
            font-size: 14px;
            color: var(--muted);
            padding: 24px;
            border: 1px solid var(--border);
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
<body>

    <header class="topbar">
        <div class="topbar-left">
            <a href="{{ route('home') }}" id="btn-volver-inicio">← Volver</a>
            <span class="topbar-title">Lotificación Interactiva</span>
        </div>
        <a href="{{ route('login') }}" id="btn-ir-login">🔐 Iniciar sesión</a>
    </header>

    <main>
        <div class="page-header">
            <h1>Lotificación Nueva Jerusalem</h1>
            <p>Listado interactivo de códigos de lotes</p>
        </div>

        <div class="panel">
            <label class="search-label" for="input-buscar">Buscar lote</label>
            <input type="text" id="input-buscar" placeholder="Ejemplo: 18B1" oninput="filtrarLotes(this.value)" />

            <div class="legend">
                <span>🟢 Lote disponible</span>
                <span>🔴 Lote vendido</span>
                <span>🟡 Reserva de oficina</span>
                <span>🟣 Pendiente de enganche</span>
            </div>

            <div class="lotes-grid" id="lotes-grid">
                @forelse ($lotes as $codigo => $lote)
                    <div
                        class="lote-btn"
                        data-codigo="{{ strtolower($codigo) }}"
                        data-estado="{{ strtolower($lote['estado_label']) }}"
                        title="{{ $lote['estado_label'] }}"
                        style="background-color: {{ $lote['color'] }}22; border-color: {{ $lote['color'] }};"
                    >
                        {{ $codigo }}
                    </div>
                @empty
                    <div class="empty-msg">No se encontraron lotes.</div>
                @endforelse
            </div>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Lotificación Nueva Jerusalem &mdash; Portal de Asesores
    </footer>

    <script>
        function filtrarLotes(valor) {
            const q = valor.toLowerCase().trim();
            const items = document.querySelectorAll('#lotes-grid .lote-btn');
            let visibles = 0;

            items.forEach(item => {
                const codigo  = item.dataset.codigo  || '';
                const estado  = item.dataset.estado  || '';
                const coincide = !q || codigo.includes(q) || estado.includes(q);
                item.style.display = coincide ? '' : 'none';
                if (coincide) visibles++;
            });

            // Mostrar mensaje vacío si no hay resultados
            let empty = document.getElementById('lotes-empty-msg');
            if (!empty) {
                empty = document.createElement('div');
                empty.id = 'lotes-empty-msg';
                empty.className = 'empty-msg';
                empty.style.gridColumn = '1 / -1';
                empty.textContent = 'No se encontraron lotes con ese criterio.';
                document.getElementById('lotes-grid').appendChild(empty);
            }
            empty.style.display = (visibles === 0) ? '' : 'none';
        }
    </script>

</body>
</html>
