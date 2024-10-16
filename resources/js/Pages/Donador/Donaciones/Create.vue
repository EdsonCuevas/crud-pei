<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'; // Asegúrate de tener esta importación


const selectedAmount = ref('');
const transactionNumber = ref('');
const selectedProgramId = ref(''); // Para el ID del programa seleccionado

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

const submitDonation = () => {
  // Enviamos los datos al controlador usando la ruta resource
  router.post('/donor-donations', {
    amount: selectedAmount.value,
    transaction_number: transactionNumber.value,
    program_id: selectedProgramId.value,
  });
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

          <form @submit.prevent="submitDonation">
            <!-- Aquí están los campos que ya tienes definidos -->
            <div class="mb-6">
              <label class="text-sm font-semibold text-[#004481] mb-2">Donation concept</label>
              <input
                id="transactionNumber"
                type="text"
                v-model="transactionNumber"
                placeholder="Concept"
                class="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
            </div>

            <div class="mb-6">
              <h3 class="text-sm font-semibold text-[#004481] mb-2">Select your contribution amount</h3>
              <div class="grid grid-cols-3 gap-2 mb-2">
                <button
                  v-for="amount in ['$100', '$500', '$1000']"
                  :key="amount"
                  @click="selectedAmount = amount.replace('$', '')"
                  :class="['py-2 px-4 border border-[#004481]', selectedAmount === amount.replace('$', '') ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 hover:text-white']"
                >
                  {{ amount }}
                </button>
              </div>
              <input
                v-model="selectedAmount"
                type="number"
                placeholder="Other amount"
                @input="validateNumberInput"
                class="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
            </div>

            <div class="mt-4">
              <label class="block text-sm font-semibold text-[#004481] mb-2">Select a program</label>
              <select v-model="selectedProgramId" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option disabled value="">Select a program</option>
                <option v-for="programa in programas" :key="programa.id" :value="programa.id">
                  {{ programa.title }}
                </option>
              </select>
            </div>
            
            <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-[#004481]">
              Continue
            </button>
          </form>  <br />

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
