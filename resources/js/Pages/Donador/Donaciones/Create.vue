<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const selectedAmount = ref(''); // Para almacenar el monto seleccionado

// Definimos el prop 'donaciones' que será un array de donaciones
const props = defineProps({
  programas: {
    type: Array,
  },
});

// Función para validar que solo se ingresen números
const validateNumberInput = (event) => {
  const value = event.target.value;
  // Remover cualquier carácter que no sea número
  const sanitizedValue = value.replace(/[^0-9]/g, '');
  selectedAmount.value = sanitizedValue; // Actualiza el valor con solo números
};
</script>

<template>
  <Head title="Donation" />
  <AuthenticatedLayout>
    <div class="flex items-center justify-center p-4">
      <div class="w-full max-w-2xl bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6">
          <h1 class="text-2xl font-bold text-[#004481] mb-5 text-center">
            Donation
          </h1>

          <div class="mb-6">
            <label class="text-sm font-semibold text-[#004481] mb-2">Transaction number</label>
            <div class="grid grid-cols-3 gap-2 mb-2"></div>

            <!-- Este input tendrá su propia variable para no interferir con el de abajo -->
            <input
              id="transactionNumber"
              type="text"
              v-model="transactionNumber"
              placeholder="Bank reference"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
            />
          </div>

          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Select your contribution amount</h3>
            <div class="grid grid-cols-3 gap-2 mb-2">
              <button
                v-for="amount in ['$100', '$500', '$1000']"
                :key="amount"
                @click="selectedAmount = amount.replace('$', '')"
                :class="[ 
                  'py-2 px-4 border border-[#004481] text-[#004481] rounded-md transition-colors duration-200',
                  selectedAmount === amount.replace('$', '') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 hover:text-white'
                ]"
              >
                {{ amount }}
              </button>
            </div>

            <!-- El input refleja el valor seleccionado o manualmente introducido -->
            <input
              v-model="selectedAmount"
              type="text"
              placeholder="Other amount"
              @input="validateNumberInput"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
            />
          </div>


          <!-- Aquí agregamos el combobox que selecciona los programas de las donaciones -->
          <div class="mt-4">
            <label class="block text-sm font-semibold text-[#004481] mb-2">Select a program</label>

            <select id="donacion"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
            >
              <option disabled value="">Select a program</option>

              <option v-for="programa in programas" :key="programa.id" class="text-gray-700">
                {{ programa.title }}
              </option>
            </select>
          </div>  <br />

          <div class="text-xs text-center text-gray-500 mb-4">
            <br />
            Secure donation.<br />
            Your data will be encrypted

            <br />

          </div>

          <button class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-[#004481] transition-colors duration-200">
            Continue
          </button>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
