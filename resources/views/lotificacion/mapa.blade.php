<x-layouts::app :title="__('Mapa de Lotificación')">
    <section class="space-y-6">
        <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-zinc-900">
            <div class="flex items-center justify-between">
                <div>
                    <flux:heading size="lg">Mapa de Lotificación</flux:heading>
                    <flux:subheading>Nueva Jerusalem - Plano completo</flux:subheading>
                </div>

                <a href="{{ asset('mapa-lotificacion.pdf') }}" download="mapa-lotificacion-nueva-jerusalem.pdf"
                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800">
                    ⬇️ Descargar PDF
                </a>
            </div>
        </div>

        <div class="rounded-xl border border-neutral-200 bg-white p-5 dark:border-neutral-700 dark:bg-zinc-900">
            <div class="relative overflow-hidden rounded-lg" style="height: 90vh;">
                <object data="{{ asset('mapa-lotificacion.pdf') }}" type="application/pdf" width="100%" height="100%">
                    <embed src="{{ asset('mapa-lotificacion.pdf') }}" type="application/pdf" width="100%"
                        height="100%" />
                    <p class="text-center text-neutral-600 dark:text-neutral-300">
                        Tu navegador no soporta embeds de PDF. <a href="{{ asset('mapa-lotificacion.pdf') }}"
                            class="font-semibold text-blue-600 hover:underline dark:text-blue-400">Descargar PDF
                            aquí</a>.
                    </p>
                </object>
            </div>
        </div>
    </section>
</x-layouts::app>