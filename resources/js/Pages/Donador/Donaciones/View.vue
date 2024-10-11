<script setup>

import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const donationType = ref('single')

import numeroALetras from '@/Utils/numeroALetras';

import { reactive } from 'vue'
const props = defineProps({
  donacion: {
    type: Object
  },
});

const donacion = ref({
  fechaHora: '2023-05-15 14:30:22',
  numeroTransaccion: 'DON-2023051501',
  nombreDonante: 'Juan Pérez',
  metodoPago: 'Tarjeta de Crédito',
  cantidad: 1000.00,
  cantidadEnLetras: 'Mil pesos 00/100 M.N.',
  proyectoApoyado: 'Programa de Educación para Niños',
  desglose: {
    'Educación': 40,
    'Infraestructura': 30,
    'Administración': 20,
    'Reserva': 10
  },
  frecuencia: 'Donación única',
  estado: 'Exitosa',
  mensajeAgradecimiento: 'Gracias por su generosa donación. Su apoyo hace posible nuestro trabajo y marca la diferencia en la vida de muchos niños.',
  informacionContacto: 'Fundación CTI, Av. Universidad No. 333, Colonia Las Víboras, Colima, Colima, C.P. 28040 | support@cti.com | +52 313 141 0000',
  datosFiscales: 'RFC: BBA830831LJ2',
  codigoQR: 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://fundacion.bbva.mx/donacion/DON-2023051501'
})

// Definir la función convertirNumero
const convertirNumero = (numero) => {
  return numeroALetras(numero, { plural: 'PESOS', singular: 'PESO' });
};

const descargarPDF = () => {
  // Aquí iría la lógica para generar y descargar el PDF
  console.log('Descargando PDF...')
}

const enviarPorEmail = () => {
  // Aquí iría la lógica para enviar el recibo por email
  console.log('Enviando recibo por email...')
}
</script>

<template>
  <AuthenticatedLayout>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-[#004481] text-white p-6">
          <h1 class="text-3xl font-bold text-center">Recibo de Donación</h1>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Columna izquierda -->
            <div class="space-y-4">
              <div>
                <p class="font-semibold text-[#004481]">Fecha y hora de la donación:</p>
                <p>{{ props.donacion.created_at }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Nombre del donante:</p>
                <p>{{ props.donacion.user.name }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Método de pago:</p>
                <p>{{ donacion.metodoPago }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Cantidad de la donación:</p>
                <p class="text-xl font-bold text-[#004481]">${{ props.donacion.value }}MXN</p>
                <p class="text-sm text-gray-600">{{ convertirNumero(props.donacion.value) }}MXN</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Proyecto o causa apoyada:</p>
                <p>{{ props.donacion.concept }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Frecuencia de la donación:</p>
                <p>{{ donacion.frecuencia }}</p>
              </div>
            </div>

            <!-- Columna derecha -->
            <div class="space-y-4">
              <div>
                <p class="font-semibold text-[#004481]">Número de transacción:</p>
                <p>{{ donacion.numeroTransaccion }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Estado de la donación:</p>
                <p class="text-green-600 font-bold">{{ donacion.estado }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Desglose de la donación:</p>
                <ul class="list-disc list-inside pl-4">
                  <li v-for="(porcentaje, concepto) in donacion.desglose" :key="concepto">
                    {{ concepto }}: {{ porcentaje }}%
                  </li>
                </ul>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Información de contacto:</p>
                <p class="text-sm">{{ donacion.informacionContacto }}</p>
              </div>
              <div v-if="donacion.datosFiscales">
                <p class="font-semibold text-[#004481]">Datos fiscales:</p>
                <p>{{ donacion.datosFiscales }}</p>
              </div>
            </div>
          </div>

          <!-- Sección inferior -->
          <div class="mt-6 space-y-4">
            <div>
              <p class="font-semibold text-[#004481]">Mensaje de agradecimiento:</p>
              <p class="italic text-gray-700 bg-gray-100 p-3 rounded-lg">{{ donacion.mensajeAgradecimiento }}</p>
            </div>
            <div class="flex justify-center">
              <img :src="donacion.codigoQR" alt="Código QR de la donación" class="w-32 h-32">
            </div>
            <div class="flex justify-between mt-6">
              <button @click="descargarPDF"
                class="bg-[#004481] text-white px-6 py-2 rounded-md hover:bg-[#003366] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#004481] transition duration-300">
                Descargar PDF
              </button>
              <button @click="enviarPorEmail"
                class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-300">
                Enviar por Email
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>

</template>
