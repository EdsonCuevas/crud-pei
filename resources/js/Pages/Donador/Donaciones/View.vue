<script setup>

import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';

import numeroALetras from '@/Utils/numeroALetras';

import { Printer  } from 'lucide-vue-next'

const props = defineProps({
  donacion: {
    type: Object
  },
});

const donacion = ref({
  fechaHora: '2023-05-15 14:30:22',
  numeroTransaccion: 'DON-' + props.donacion.id,
  nombreDonante: 'Juan Pérez',
  metodoPago: 'Credit Card',
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
  mensajeAgradecimiento: 'We sincerely appreciate your generous donation. Your support is critical to continuing our mission and making a positive impact on the lives of young people. Thanks to your trust, we are able to move forward with projects that make a real difference in the community.',
  informacionContacto: 'Fundación CTI, Av. Universidad No. 333, Colonia Las Víboras, Colima, C.P. 28040 | support@cti.com | +52 313 141 0000',
  datosFiscales: 'RFC: '+ props.donacion.user.rfc,
  codigoQR: 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=https://fundacion.bbva.mx/donacion/DON-2023051501'
})

// Definir la función convertirNumero
const convertirNumero = (numero) => {
  return numeroALetras(numero, { plural: 'PESOS', singular: 'PESO' });
};

const Imprimir = () => {
  // Aquí iría la lógica para generar y descargar el PDF
  window.print();
}

</script>

<template>
  <AuthenticatedLayout>
    <div class="flex items-center justify-center p-4">
      <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-[#004481] text-white p-6">
          <h1 class="text-3xl font-bold text-center">Donation Receipt</h1>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Columna izquierda -->
            <div class="space-y-4">
              <div>
                <p class="font-semibold text-[#004481]">Date and time of donation:</p>
                <p>{{ new Date(props.donacion.created_at).toLocaleString() }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Donor's name:</p>
                <p>{{ props.donacion.user.name }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Method of payment:</p>
                <p>{{ donacion.metodoPago }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Donation amount:</p>
                <p class="text-xl font-bold text-[#004481]">${{ props.donacion.value }}MXN</p>
                <p class="text-sm text-gray-600">{{ convertirNumero(props.donacion.value) }}MXN</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Program or cause supported:</p>
                <p>{{ props.donacion.proram.title }}</p>
              </div>
            </div>

            <!-- Columna derecha -->
            <div class="space-y-4">
              <div>
                <p class="font-semibold text-[#004481]">Transaction number:</p>
                <p>{{ donacion.numeroTransaccion }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Donation status:</p>
                <p class="text-green-600 font-bold">{{ donacion.estado }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Contact information:</p>
                <p class="text-sm">{{ donacion.informacionContacto }}</p>
              </div>
              <div v-if="donacion.datosFiscales">
                <p class="font-semibold text-[#004481]">Fiscal data:</p>
                <p>{{ donacion.datosFiscales }}</p>
              </div>
              <div>
                <p class="font-semibold text-[#004481]">Concept:</p>
                <p>{{ props.donacion.concept }}</p>
              </div>
            </div>
          </div>

          <!-- Sección inferior -->
          <div class="mt-6 space-y-4">
            <div>
              <p class="font-semibold text-[#004481]">Thank you message:</p>
              <p class="italic text-gray-700 bg-gray-100 p-3 rounded-lg">{{ donacion.mensajeAgradecimiento }}</p>
            </div>
            <div class="flex justify-end mt-6">
              <button @click="Imprimir"
                  class="bg-[#004481] text-white px-4 py-2 rounded-md hover:bg-[#003366] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#004481] transition duration-300 flex items-center space-x-2">
                  <Printer class="w-6 h-6" />
                  <span>Print Receipt</span>
                  
              </button>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>

</template>
