<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa de Lotificación - Nueva Jerusalem</title>
    <meta name="description" content="Plano completo de la Lotificación Nueva Jerusalem en formato PDF.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #0d1117;
            --surface: #161b22;
            --border:  #30363d;
            --accent:  #d2a8ff;
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
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header-info h1 {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 4px;
        }

        .page-header-info p {
            font-size: 13px;
            color: var(--muted);
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--accent2);
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 18px;
            border-radius: 8px;
            transition: opacity .2s, transform .2s;
        }

        .btn-download:hover { opacity: .85; transform: translateY(-1px); }

        /* PDF VIEWER */
        .pdf-container {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            flex: 1;
        }

        .pdf-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            height: 85vh;
        }

        object, embed {
            border-radius: 8px;
        }

        .pdf-fallback {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 16px;
            color: var(--muted);
            font-size: 14px;
            text-align: center;
        }

        .pdf-fallback a {
            color: var(--accent2);
            font-weight: 600;
            text-decoration: underline;
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
            <span class="topbar-title">Mapa de Lotificación</span>
        </div>
        <a href="{{ route('login') }}" id="btn-ir-login">🔐 Iniciar sesión</a>
    </header>

    <main>
        <div class="page-header">
            <div class="page-header-info">
                <h1>Mapa de Lotificación</h1>
                <p>Nueva Jerusalem &mdash; Plano completo</p>
            </div>
            <a href="{{ asset('mapa-lotificacion.pdf') }}" download="mapa-lotificacion-nueva-jerusalem.pdf"
               class="btn-download" id="btn-descargar-pdf">
                 Descargar PDF
            </a>
        </div>

        <div class="pdf-container">
            <div class="pdf-wrapper">
                <object data="{{ asset('mapa-lotificacion.pdf') }}" type="application/pdf" width="100%" height="100%">
                    <embed src="{{ asset('mapa-lotificacion.pdf') }}" type="application/pdf" width="100%" height="100%" />
                    <div class="pdf-fallback">
                        <span>Tu navegador no soporta la visualización de PDF.</span>
                        <a href="{{ asset('mapa-lotificacion.pdf') }}" id="btn-descargar-pdf-fallback">Descargar PDF aquí</a>
                    </div>
                </object>
            </div>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} Lotificación Nueva Jerusalem &mdash; Portal de Asesores
    </footer>

</body>
</html>
