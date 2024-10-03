<script setup>
import { Head } from '@inertiajs/vue3';
</script>


<template>
    <Head title="401" />
    <section class="flex items-center justify-center h-screen p-16 bg-gray-50 light:bg-gray-700">
        <div class="container flex flex-col items-center justify-center">
            <div class="flex flex-col gap-6 max-w-md text-center">
                <h2 class="font-extrabold text-9xl text-gray-600 dark:text-gray-1000">
                    <span class="sr-only">Error</span>401
                </h2>
                <p class="text-2xl md:text-3xl dark:text-gray-500">No tienes autorización para ver esta página</p>
                <a href="home" class="px-8 py-4 text-xl font-semibold rounded bg-blue-500 text-gray-50 hover:text-gray-200">Volver al inicio</a>
            </div>
        </div>
    </section>
</template>
