<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lotificación Nueva Jerusalem - Asesor</title>
    <meta name="description"
        content="Portal del asesor para consultar lotes, mapa y disponibilidad de la Lotificación Nueva Jerusalem.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8f9fa;
            color: #1f2937;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* TOP BAR */
        header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
            display: flex;
            justify-content: flex-end;
        }

        header a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.2s;
        }

        header a:hover {
            background: #1d4ed8;
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px 24px 40px;
        }

        /* HERO SECTION */
        .hero-badge {
            display: inline-block;
            background: #dbeafe;
            color: #1e40af;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 24px;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            text-align: center;
            color: #111827;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .hero-description {
            text-align: center;
            color: #6b7280;
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 48px;
            line-height: 1.6;
        }

        /* CARDS GRID */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
        }

        .card {
            display: flex;
            flex-direction: column;
            padding: 32px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            position: relative;
        }

        .card:hover {
            border-color: #2563eb;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.1);
            transform: translateY(-4px);
        }

        .card-icon {
            width: 56px;
            height: 56px;
            background: #eff6ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 24px;
            color: #2563eb;
        }

        .card:hover .card-icon {
            background: #2563eb;
            color: white;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .card-description {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 16px;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid #f3f4f6;
        }

        .card-link {
            font-size: 14px;
            font-weight: 500;
            color: #2563eb;
        }

        .card-arrow {
            font-size: 18px;
            color: #2563eb;
            transition: transform 0.2s;
        }

        .card:hover .card-arrow {
            transform: translateX(4px);
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 24px;
            color: #9ca3af;
            font-size: 13px;
            border-top: 1px solid #e5e7eb;
            background: #ffffff;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            main {
                padding: 40px 20px 32px;
            }

            h1 {
                font-size: 2rem;
            }

            .cards-grid {
                gap: 16px;
            }

            .card {
                padding: 24px;
            }
        }

        @media (max-width: 480px) {
            main {
                padding: 32px 16px 24px;
            }

            h1 {
                font-size: 1.75rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- TOP BAR -->
    <header>
        
        <a href="{{ route('login') }}">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                <polyline points="10 17 15 12 10 7"></polyline>
                <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
            Iniciar sesión
        </a>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        
        <span class="hero-badge">Portal Asesor</span>
        <h1>Lotificación Nueva Jerusalem</h1>
        <p class="hero-description">
            Consulta el estado de los lotes, el mapa de la lotificación y el listado interactivo sin necesidad de
            iniciar sesión.
        </p>

        <!-- CARDS -->
        <div class="cards-grid">
            <!-- LISTA DE LOTES -->
            <a href="{{ route('asesor.lista') }}" class="card">
                <div class="card-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"></path>
                    </svg>
                </div>
                <h3 class="card-title">Lista de Lotes</h3>
                <p class="card-description">
                    Consulta los lotes vendidos, en reserva y pendientes de enganche con sus detalles y adquirientes.
                </p>
                <div class="card-footer">
                    <span class="card-link">Ver detalles</span>
                    <span class="card-arrow">→</span>
                </div>
            </a>

            <!-- LOTIFICACION INDEX -->
            <a href="{{ route('asesor.index') }}" class="card">
                <div class="card-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                </div>
                <h3 class="card-title">Lotificación Interactiva</h3>
                <p class="card-description">
                    Vista interactiva con todos los lotes codificados por color según su estado actual.
                </p>
                <div class="card-footer">
                    <span class="card-link">Ver detalles</span>
                    <span class="card-arrow">→</span>
                </div>
            </a>

            <!-- MAPA -->
            <a href="{{ route('asesor.mapa') }}" class="card">
                <div class="card-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                </div>
                <h3 class="card-title">Ver Mapa</h3>
                <p class="card-description">
                    Visualiza el plano completo de la lotificación en formato PDF directamente en el navegador.
                </p>
                <div class="card-footer">
                    <span class="card-link">Ver detalles</span>
                    <span class="card-arrow">→</span>
                </div>
            </a>
        </div>
        
    </main>

    <!-- FOOTER -->
    <footer>
        &copy; {{ date('Y') }} Lotificación Nueva Jerusalem &mdash; Portal de Asesores.
        
        </p>
        
        <span style="color:rgba(255,255,255,0.65); font-weight:600; ">Desarrollado por Jsoft </span>
    </footer>

</body>

</html>
