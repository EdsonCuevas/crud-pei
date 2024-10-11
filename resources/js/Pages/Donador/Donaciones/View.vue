<script setup>

import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
  
const donationType = ref('single')

import { reactive } from 'vue'
  
  const paymentDetails = reactive({
    title: 'App Eventifica - Mayo',
    amount: '199,00',
    paymentMethod: 'Tarjeta de crédito de MasterCard x-1234',
    paymentNote: 'Verá "App Eventifica - Mayo" en el estado de cuenta de su tarjeta.',
    vendorName: 'Eventifica',
    vendorWebsite: 'https://www.eventifica.com',
    vendorEmail: 'pagos@eventifica.com',
    exchangeRate: '$ 9.170,51 UYU = $ 199,00 USD',
    exchangeRateUnit: '1 UYU = 0,0217 USD',
    transactionId: 'XXXXXXXXXXX035530W',
    paymentFormatId: 'P-XXXX285',
    purchaseAmount: '14,99',
    totalAmount: '14,99'
  })
  
  const printDetails = () => {
    console.log('Printing details...')
  }
</script>

<template>
    <AuthenticatedLayout>
    <Head title="Donation" />
    <div class="min-h-screen flex items-center justify-center p-4">
      <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-[#004481] text-white p-4 flex justify-between items-center">
          <div class="flex items-center space-x-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="text-white"
            >
              <rect width="20" height="14" x="2" y="5" rx="2" />
              <line x1="2" x2="22" y1="10" y2="10" />
            </svg>
            <h2 class="text-lg font-semibold">{{ paymentDetails.title }}</h2>
          </div>
          <span class="text-xl font-bold">- $ {{ paymentDetails.amount }}</span>
        </div>
        <div class="p-6 space-y-6">
          <div class="flex justify-between items-start">
            <div class="space-y-2">
              <h3 class="font-semibold text-[#004481]">Pagado con</h3>
              <p>{{ paymentDetails.paymentMethod }}</p>
              <p class="text-sm text-gray-500">{{ paymentDetails.paymentNote }}</p>
            </div>
            <div class="text-right space-y-2">
              <h3 class="font-semibold text-[#004481]">Información del vendedor</h3>
              <p class="font-semibold">{{ paymentDetails.vendorName }}</p>
              <a :href="paymentDetails.vendorWebsite" class="text-[#004481] hover:underline">
                {{ paymentDetails.vendorWebsite }}
              </a>
              <p class="text-[#004481]">{{ paymentDetails.vendorEmail }}</p>
            </div>
          </div>
          <div class="space-y-2">
            <h3 class="font-semibold text-[#004481]">Tipo de cambio</h3>
            <p>{{ paymentDetails.exchangeRate }}</p>
            <p>{{ paymentDetails.exchangeRateUnit }}</p>
          </div>
          <div class="space-y-2">
            <h3 class="font-semibold text-[#004481]">Id. de transacción</h3>
            <p>{{ paymentDetails.transactionId }}</p>
          </div>
          <div class="space-y-2">
            <h3 class="font-semibold text-[#004481]">Id. del formato de pago</h3>
            <p>{{ paymentDetails.paymentFormatId }}</p>
          </div>
          <div class="space-y-2">
            <h3 class="font-semibold text-[#004481]">Detalles de la compra</h3>
            <div class="flex justify-between">
              <span>Importe de compra</span>
              <span>$ {{ paymentDetails.purchaseAmount }}</span>
            </div>
            <div class="flex justify-between font-semibold">
              <span>Total</span>
              <span>$ {{ paymentDetails.totalAmount }}</span>
            </div>
          </div>
          <button
            @click="printDetails"
            class="w-full bg-[#004481] hover:bg-[#043b6f] text-white py-2 px-4 rounded flex items-center justify-center transition duration-300"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="mr-2 h-4 w-4"
            >
              <polyline points="6 9 6 2 18 2 18 9" />
              <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
              <rect width="12" height="8" x="6" y="14" />
            </svg>
            Imprimir los detalles
          </button>
        </div>
      </div>
    </div>
    </AuthenticatedLayout>
</template>