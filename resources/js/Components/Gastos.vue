<template>
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6">
          <h1 class="text-3xl font-bold text-white text-center">Comprobante de Gastos</h1>
        </div>
        
        <div class="p-8 space-y-6">
          <div class="flex justify-center">
            <div class="text-center">
              <span class="text-4xl font-bold text-gray-800">
                ${{ formatAmount(expense.amount) }}
              </span>
              <p class="text-sm text-gray-500 mt-1">MXN</p>
            </div>
          </div>
  
          <!-- Details Grid -->
          <div class="grid grid-cols-2 gap-6">
            <div class="space-y-2">
              <label class="text-sm font-medium text-blue-700">Fecha</label>
              <p class="text-gray-800 font-medium">  {{ new Date(props.expense.created_at).toLocaleString() }}
            </p>
            </div>
            
            <div class="space-y-2">
              <label class="text-sm font-medium text-blue-700">Origen</label>
              <p class="text-gray-800 font-medium">{{ props.expense.program.title }}</p>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-6">

          <!-- Concept Section -->
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-700">Reason</label>
            <p class="text-gray-800 font-medium">{{ props.expense.reason }}</p>
          </div>

          <!-- Concept Section -->
          <div class="space-y-2">
            <label class="text-sm font-medium text-blue-700">Nombre</label>
            <p class="text-gray-800 font-medium">{{ props.expense.user.name }}</p>
          </div>
        </div>

        
  
          <!-- Reference Number -->
          <div class="pt-4 border-t border-gray-200">
            <div class="flex justify-between text-sm">
              <span class="text-gray-500">No. de Referencia:</span>
              <span class="text-gray-800 font-medium">GTO-{{ props.expense.id }}</span>
            </div>
          </div>
  
          <!-- Status Badge -->
          <div class="flex justify-center">
            <span class="px-4 py-1 rounded-full text-sm font-medium" 
                  :class="expense.status === 'Aprobado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'">
              {{ expense.status }}
            </span>
          </div>
  
          <!-- Action Buttons -->
          <div class="flex gap-4 pt-4">
            <button @click="printTicket" 
                    class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg flex items-center justify-center gap-2 transition-colors">
              <PrinterIcon class="h-5 w-5" />
              Imprimir
            </button>
            <button @click="closeModal" 
                    class="flex-1 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg flex items-center justify-center gap-2 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>              Salir
            </button>
          </div>
        </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { PrinterIcon } from 'lucide-vue-next'

  const props = defineProps({
  expense: {
    type: Object,
    required: true
  }
});

const closeModal = () => {
  // Crear un evento de tecla presionada para la tecla 'Esc'
  const event = new KeyboardEvent('keydown', {
    key: 'Escape',
    code: 'Escape',
    keyCode: 27,
    bubbles: true
  });
  
  // Despachar el evento 'keydown' para simular la acción de presionar 'Esc'
  document.dispatchEvent(event);
};

  // Sample expense data
  const expense = ref({
    amount: props.expense.value,
    status: 'Aprobado'
  })
  
  // Format amount with commas and decimals
  const formatAmount = (amount) => {
    return amount.toLocaleString('es-MX', {
      minimumFractionDigits: 2,
      maximumFractionDigits: 2
    })
  }
  
 
  
  // Print ticket function
  const printTicket = () => {
    window.print()
  }
  
  </script>
  
  <style scoped>
  @media print {
    .bg-gradient-to-br {
      background: white !important;
    }
    
    button {
      display: none !important;
    }
  }
  </style>