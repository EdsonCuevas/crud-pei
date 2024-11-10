<template>
    <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-xl">
  <h2 class="text-2xl font-bold mb-6 bg-gradient-to-r from-[#004481] to-[#1464A5] bg-clip-text text-transparent animate-writing">
    Registro de Gastos
  </h2>
      
      <form @submit.prevent="handleSubmit" class="space-y-4">
        <div class="space-y-2 transform transition-all duration-300 hover:scale-105">
          <label for="value" class="block text-sm font-medium text-gray-700">
            Valor
          </label>
          <div class="relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <span class="text-gray-500 sm:text-sm">$</span>
            </div>
            <input
              type="number"
              name="value"
              id="value"
              v-model="form.value"
              class="focus:ring-[#1464A5] focus:border-[#1464A5] block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md transition-all duration-300"
              placeholder="0.00"
            />
          </div>
        </div>
        
        <div class="space-y-2 transform transition-all duration-300 hover:scale-105">
          <label for="reason" class="block text-sm font-medium text-gray-700">
            Motivo
          </label>
          <input
            type="text"
            name="reason"
            id="reason"
            v-model="form.reason"
            class="focus:ring-[#1464A5] focus:border-[#1464A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md transition-all duration-300"
            placeholder="Ingrese el motivo del gasto"
          />
        </div>
        
        <div class="space-y-2 transform transition-all duration-300 hover:scale-105">
          <label for="origin" class="block text-sm font-medium text-gray-700">
            Origen
          </label>
          <input
            type="text"
            name="origin"
            id="origin"
            v-model="form.origin"
            class="focus:ring-[#1464A5] focus:border-[#1464A5] block w-full shadow-sm sm:text-sm border-gray-300 rounded-md transition-all duration-300"
            placeholder="Ingrese el origen del gasto"
          />
        </div>
        
        <div class="space-y-2 transform transition-all duration-300 hover:scale-105">
          <label for="date" class="block text-sm font-medium text-gray-700">
            Fecha
          </label>
          <div class="relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <CalendarIcon class="h-5 w-5 text-gray-400" />
            </div>
            <input
              type="date"
              name="date"
              id="date"
              v-model="form.date"
              class="focus:ring-[#1464A5] focus:border-[#1464A5] block w-full pl-10 sm:text-sm border-gray-300 rounded-md transition-all duration-300"
            />
          </div>
        </div>
        
        <button  @click="closeModal2"
          type="submit"
          class="w-full bg-gradient-to-r from-[#004481] to-[#1464A5] text-white font-bold py-2 px-4 rounded transition-all duration-500 transform hover:scale-105 hover:shadow-lg hover:from-[#1464A5] hover:to-[#004481]"
        >
          Registrar
        </button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { reactive } from 'vue'
  import { CalendarIcon } from 'lucide-vue-next'
  
  const form = reactive({
    value: '',
    reason: '',
    origin: '',
    date: ''
  })
  const closeModal2 = () => {
  const event = new KeyboardEvent('keydown', {
    key: 'Escape',
    code: 'Escape',
    keyCode: 27,
    bubbles: true
  });
  
  document.dispatchEvent(event);
};
  
  
  </script>
  
  <style scoped>
  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
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
  animation: writing 2s steps(30) forwards;
}
  </style>