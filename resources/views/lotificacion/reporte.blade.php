<x-layouts::app :title="__('Reporte de Lotificación')">
    <div class="space-y-8">

        <div class=" from-blue-600 to-blue-800 p-8 text-white shadow-lg dark:from-blue-700 dark:to-blue-900">
            <div class="relative z-10 text-center">
                <h1 class="mb-2 text-4xl font-bold">Reporte de Lotificación</h1>
                <p class="mb-6 text-blue-100">Nueva Jerusalem - Estado de lotes vendidos, reservados y pendientes</p>

            </div>
            <div class="absolute right-0 top-0 h-40 w-40 bg-white/10 rounded-full -mr-20 -mt-20"></div>
        </div>
        <a href="{{ route('lotificacion.reporte.descargar') }}"
            class="flex w-fit mx-auto items-center gap-2 rounded-lg bg-white px-6 py-3 font-semibold text-blue-600 transition hover:bg-blue-50 dark:bg-blue-900 dark:text-white dark:hover:bg-blue-800">
            Descargar reporte en PDF
        </a>
        
        <div
            class="rounded-lg border border-gray-200 bg-gray-50 p-6 text-center text-sm text-gray-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-gray-400">
            <p>Reporte generado el {{ now('America/Guatemala')->format('d \\d\\e F \\d\\e Y \\a \\l\\a\\s H:i') }}</p>
            <p class="mt-1 text-xs">Nueva Jerusalem - Lotificación</p>
        </div>
    </div>
</x-layouts::app>
