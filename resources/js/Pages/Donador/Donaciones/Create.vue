<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import Card from '@/Components/Card.vue';
import Swal from 'sweetalert2';

const selectedAmount = ref(null); // Cambia el valor inicial a null
const transactionNumber = ref('');
const selectedProgramId = ref('');
const errorMessage = ref('');
const showModal = ref(false);

const props = defineProps({
  programas: {
    type: Array,
  },
});

const validateNumberInput = (event) => {
  let value = event.target.value;

  if (value.startsWith('0')) {
    errorMessage.value = '';
    value = '';
  } else {
    errorMessage.value = '';
  }

  selectedAmount.value = value;
};

const openModal = () => {
  if (!selectedAmount.value || !transactionNumber.value || !selectedProgramId.value) {
    errorMessage.value = "Please fill in all fields before continuing.";
  } else {
    errorMessage.value = '';
    showModal.value = true;
  }
};

const closeModal = () => {
  showModal.value = false;
};

const submitDonation = () => {
  router.post('/donor-donations', {
    amount: selectedAmount.value,
    transaction_number: transactionNumber.value,
    program_id: selectedProgramId.value,
  });
  Swal.fire({
    title: 'Success!',
    text: 'Donation has been successfully completed!',
    icon: 'success',
    timer: 2000,
    showConfirmButton: false
});
  closeModal();

};
</script>

<template>
  <Head title="Donation" />
  <AuthenticatedLayout>
    <div class="flex items-center justify-center p-4">
      <div class="w-full max-w-2xl bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6">
          <h1 class="text-2xl font-bold mb-6 bg-gradient-to-r from-[#004481] to-[#1464A5] bg-clip-text text-transparent animate-writing">
            Donation
          </h1>

          <div>
            <div class="mb-6 animate-slide-in-left" style="animation-delay: 0.2s;">
              <label class="text-sm font-semibold text-[#004481] mb-2">Donation concept</label>
              <input
                id="transactionNumber"
                type="text"
                v-model="transactionNumber"
                placeholder="Concept"
                class="focus:ring-[#1464A5] focus:border-[#1464A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md transition-all duration-300   w-full px-3 py-2 border border-gray-300 rounded-md"
              />
            </div>

            <div class="mb-6 animate-slide-in-left" style="animation-delay: 0.4s;">
              <h3 class="text-sm font-semibold text-[#004481] mb-2">Select your contribution amount</h3>
              <div class="grid grid-cols-3 gap-2 mb-2">
                <button
                  v-for="amount in ['$100', '$500', '$1000']"
                  :key="amount"
                  @click="selectedAmount = parseInt(amount.replace('$', ''))"
                  :class="['py-2 px-4 border border-[#004481] transition-all duration-300', selectedAmount === parseInt(amount.replace('$', '')) ? 'bg-blue-500 text-white' : 'hover:bg-blue-500 hover:text-white']"
                >
                  {{ amount }}
                </button>
              </div>

              <input
                v-model.number="selectedAmount"
                type="number"
                placeholder="Other amount"
                @input="validateNumberInput"
                class="w-full px-3 py-2 border border-gray-300 rounded-md"
              />
            </div>

            <div class="mt-4 animate-slide-in-left" style="animation-delay: 0.6s;">
              <label class="block text-sm font-semibold text-[#004481] mb-2">Select a program</label>
              <select v-model="selectedProgramId" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                <option disabled value="">Select a program</option>
                <option v-for="programa in programas" :key="programa.id" :value="programa.id">
                  {{ programa.title }}
                </option>
              </select>
            </div>
            <br>
            <p v-if="errorMessage" class="text-red-500 text-sm animate-fade-in-up">{{ errorMessage }}</p>
            <br>
            <button @click="openModal" class="w-full bg-gradient-to-r from-[#004481] to-[#1464A5] text-white font-bold py-2 px-4 rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481]">
              Continue
            </button>
          </div>

          <!-- Modal para Confirmar la Donación -->
          <Modal :show="showModal" @close="closeModal" maxWidth="2xl" closeable>
            <Card :submitDonation="submitDonation" />
          </Modal>

          <br>
          <div class="text-xs text-center text-gray-500 mb-4 animate-fade-in-up" style="animation-delay: 1s;">
            Secure donation.<br />
            Your data will be encrypted
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>


<style scoped>
/* Fade-in animation */
@keyframes fadeIn {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

/* Slide-in animation */
@keyframes slideInLeft {
  0% {
    transform: translateX(-30px);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

.animate-fade-in-up {
  animation: fadeIn 1s ease-out forwards;
}

.animate-slide-in-left {
  animation: slideInLeft 1s ease-out forwards;
}

@keyframes bounce {
    0%, 100% {
      transform: translateY(-25%);
      animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
    }
    50% {
      transform: translateY(0);
      animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }
  }
  
  @keyframes writing {
  0% {
    width: 0;
  }
  100% {
    width: 100%;
  }
}

.animate-writing {
  display: inline-block;
  white-space: nowrap;
  overflow: hidden;
  width: 0;
  animation: writing 3s steps(30) forwards;
}
</style>
