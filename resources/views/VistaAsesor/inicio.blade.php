<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotificación Nueva Jerusalem - Asesor</title>
    <meta name="description" content="Portal del asesor para consultar lotes, mapa y disponibilidad de la Lotificación Nueva Jerusalem.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d1117;
            --surface:   #161b22;
            --border:    #30363d;
            --accent:    #58a6ff;
            --accent2:   #3fb950;
            --accent3:   #f78166;
            --text:      #e6edf3;
            --muted:     #8b949e;
            --card-bg:   #21262d;
            --card-hover:#2d333b;
            --radius:    14px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP BAR */
        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 12px 24px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
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
            border-color: var(--accent);
            background: rgba(88, 166, 255, .08);
        }

        /* HERO */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 64px 24px 48px;
            text-align: center;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255, 255, 255, .05);
            border: 1px solid var(--border);
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 999px;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800;
            line-height: 1.15;
            color: var(--text);
            margin-bottom: 14px;
        }

        .hero p {
            color: var(--muted);
            font-size: 16px;
            max-width: 460px;
            line-height: 1.6;
            margin-bottom: 56px;
        }

        /* CARDS GRID */
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            max-width: 920px;
            width: 100%;
            margin: 0 auto;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px 28px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 14px;
            transition: transform .22s ease, border-color .22s ease, background .22s ease, box-shadow .22s ease;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity .22s;
        }

        .card:hover {
            transform: translateY(-4px);
            background: var(--card-hover);
            box-shadow: 0 16px 40px rgba(0,0,0,.45);
        }

        .card:hover::before { opacity: 1; }

        /* Card color accents - Neutral */
        .card-lista { border-top: 3px solid var(--border); }
        .card-lista:hover { border-color: var(--muted); }
        .card-lista::before { background: linear-gradient(180deg, rgba(255,255,255,.03) 0%, transparent 60%); }

        .card-index { border-top: 3px solid var(--border); }
        .card-index:hover { border-color: var(--muted); }
        .card-index::before { background: linear-gradient(180deg, rgba(255,255,255,.03) 0%, transparent 60%); }

        .card-mapa { border-top: 3px solid var(--border); }
        .card-mapa:hover { border-color: var(--muted); }
        .card-mapa::before { background: linear-gradient(180deg, rgba(255,255,255,.03) 0%, transparent 60%); }

        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: rgba(255, 255, 255, .05);
            border: 1px solid var(--border);
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        .card-desc {
            font-size: 14px;
            color: var(--muted);
            line-height: 1.55;
            flex: 1;
        }

        .card-arrow {
            font-size: 20px;
            color: var(--muted);
            transition: transform .22s, color .22s;
            align-self: flex-end;
        }

        .card:hover .card-arrow {
            transform: translateX(4px);
            color: var(--text);
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 20px;
            color: var(--muted);
            font-size: 12px;
            border-top: 1px solid var(--border);
        }

        @media (max-width: 600px) {
            .hero { padding: 40px 16px 32px; }
            .cards { padding: 0 4px; }
        }
    </style>
</head>
<body>

    <!-- TOP BAR: Botón ir al Login -->
    <header class="topbar">
        <a href="{{ route('login') }}" id="btn-ir-login">
            🔐 Iniciar sesión (Oficina)
        </a>
    </header>

    <!-- HERO -->
    <main class="hero">
        <span class="hero-badge">Portal Asesor</span>
        <h1>Lotificación<br>Nueva Jerusalem</h1>
        <p>Consulta el estado de los lotes, el mapa de la lotificación y el listado interactivo sin necesidad de iniciar sesión.</p>

        <div class="cards">

            <!-- LISTA DE LOTES -->
            <a href="{{ route('asesor.lista') }}" class="card card-lista" id="btn-lista-lotes">
                <div class="card-icon icon-lista">📋</div>
                <div class="card-title">Lista de Lotes</div>
                <div class="card-desc">
                    Consulta los lotes vendidos, en reserva y pendientes de enganche con sus detalles y adquirientes.
                </div>
                <div class="card-arrow">→</div>
            </a>

            <!-- LOTIFICACION INDEX -->
            <a href="{{ route('asesor.index') }}" class="card card-index" id="btn-lotificacion-index">
                <div class="card-icon icon-index">🗂️</div>
                <div class="card-title">Lotificación Interactiva</div>
                <div class="card-desc">
                    Vista interactiva con todos los lotes codificados por color según su estado actual.
                </div>
                <div class="card-arrow">→</div>
            </a>

            <!-- MAPA -->
            <a href="{{ route('asesor.mapa') }}" class="card card-mapa" id="btn-ver-mapa">
                <div class="card-icon icon-mapa">🗺️</div>
                <div class="card-title">Ver Mapa</div>
                <div class="card-desc">
                    Visualiza el plano completo de la lotificación en formato PDF directamente en el navegador.
                </div>
                <div class="card-arrow">→</div>
            </a>

        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Lotificación Nueva Jerusalem &mdash; Portal de Asesores
    </footer>

</body>
</html>
