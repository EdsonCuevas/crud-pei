<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 flex flex-col items-center justify-start p-4 sm:p-6">
      <!-- Card Preview -->
      <div class="w-full max-w-md mb-8 h-64">
        <div class="relative w-full h-full perspective">
          <div class="card-container absolute w-full h-full" :class="{ 'is-flipped': isFlipped }">
            <!-- Front of card -->
            <div class="card-face card-front absolute w-full h-full">
              <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl p-6 flex flex-col justify-between overflow-hidden">
                <div class="shine-effect"></div>
                <div class="flex justify-between items-start relative z-10">
                  <div class="w-16 h-10">
                    <img v-if="cardType" :src="getCardLogo" :alt="cardType" class="w-full h-full object-contain" />
                    <div v-else class="w-full h-full bg-white/20 rounded"></div>
                  </div>
                  <img src="/placeholder.svg?height=30&width=45" alt="Chip" class="h-8" />
                </div>
                
                <div class="text-xl text-white tracking-widest font-mono relative z-10">
                  {{ formattedCardNumber || '#### #### #### #####' }}
                </div>
                
                <div class="flex justify-between relative z-10">
                  <div>
                    <div class="text-white/60 text-xs mb-1">Card Holder</div>
                    <div class="text-white text-sm tracking-wide">
                      {{ cardName || 'FULL NAME' }}
                    </div>
                  </div>
                  <div>
                    <div class="text-white/60 text-xs mb-1">Expires</div>
                    <div class="text-white text-sm tracking-wide">
                      {{ expiryMonth || 'MM' }}/{{ expiryYear || 'YY' }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Back of card -->
            <div class="card-face card-back absolute w-full h-full">
              <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl relative overflow-hidden">
                <div class="shine-effect"></div>
                <div class="absolute top-8 w-full h-8 bg-black/30"></div>
                <div class="absolute bottom-8 right-6 w-3/4">
                  <div class="text-white/60 text-xs mb-1">CVV</div>
                  <div class="bg-white h-8 rounded flex items-center justify-end pr-4">
                    {{ cvv || '•••' }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Form -->
      <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden">
        <form @submit.prevent="handleSubmit" class="p-6 space-y-4">
          <!-- Card Number -->
          <div>
            <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-1">
              Card Number
            </label>
            <input
              id="cardNumber"
              v-model="cardNumber"
              type="text"
              maxlength="19"
              class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              :class="{ 'border-red-500': errors.cardNumber }"
              @input="formatCardNumber"
            />
            <span v-if="errors.cardNumber" class="text-red-500 text-xs mt-1">
              {{ errors.cardNumber }}
            </span>
          </div>
  
          <!-- Card Name -->
          <div>
            <label for="cardName" class="block text-sm font-medium text-gray-700 mb-1">
              Cardholder Name
            </label>
            <input
              id="cardName"
              v-model="cardName"
              type="text"
              class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
              :class="{ 'border-red-500': errors.cardName }"
            />
            <span v-if="errors.cardName" class="text-red-500 text-xs mt-1">
              {{ errors.cardName }}
            </span>
          </div>
  
          <div class="flex space-x-4">
            <!-- Expiry Date -->
            <div class="flex-1">
              <label for="expiryMonth" class="block text-sm font-medium text-gray-700 mb-1">
                Expiry Date
              </label>
              <div class="flex space-x-2">
                <select
                  id="expiryMonth"
                  v-model="expiryMonth"
                  class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  :class="{ 'border-red-500': errors.expiryMonth }"
                >
                  <option value="">MM</option>
                  <option v-for="month in 12" :key="month" :value="month.toString().padStart(2, '0')">
                    {{ month.toString().padStart(2, '0') }}
                  </option>
                </select>
                <select
                  id="expiryYear"
                  v-model="expiryYear"
                  class="flex-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  :class="{ 'border-red-500': errors.expiryYear }"
                >
                  <option value="">YY</option>
                  <option v-for="year in 10" :key="year" :value="(currentYear + year).toString().slice(-2)">
                    {{ (currentYear + year).toString().slice(-2) }}
                  </option>
                </select>
              </div>
              <span v-if="errors.expiryDate" class="text-red-500 text-xs mt-1">
                {{ errors.expiryDate }}
              </span>
            </div>
  
            <!-- CVV -->
            <div class="w-1/3">
              <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">
                CVV
              </label>
              <input
                id="cvv"
                v-model="cvv"
                type="text"
                maxlength="4"
                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                :class="{ 'border-red-500': errors.cvv }"
                @focus="isFlipped = true"
                @blur="isFlipped = false"
              />
              <span v-if="errors.cvv" class="text-red-500 text-xs mt-1">
                {{ errors.cvv }}
              </span>
            </div>
          </div>
  
          <button
            type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors mt-6"
          >
            Validate Card
          </button>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'

  const props = defineProps(['submitDonation'])
  
  const cardNumber = ref('')
  const cardName = ref('')
  const expiryMonth = ref('')
  const expiryYear = ref('')
  const cvv = ref('')
  const isFlipped = ref(false)
  const errors = ref({})
  const currentYear = new Date().getFullYear()
  
  // Card type detection
  const cardType = computed(() => {
    const num = cardNumber.value.replace(/\D/g, '')
    if (num.startsWith('4')) return 'visa'
    if (/^5[1-5]/.test(num)) return 'mastercard'
    if (/^3[47]/.test(num)) return 'amex'
    return null
  })
  
  // Card logo getter
  const getCardLogo = computed(() => {
    switch (cardType.value) {
      case 'visa':
        return 'https://cdn.jsdelivr.net/gh/aaronfagan/svg-credit-card-payment-icons/flat/visa.svg'
      case 'mastercard':
        return 'https://cdn.jsdelivr.net/gh/aaronfagan/svg-credit-card-payment-icons/flat/mastercard.svg'
      case 'amex':
        return 'https://cdn.jsdelivr.net/gh/aaronfagan/svg-credit-card-payment-icons/flat/amex.svg'
      default:
        return null
    }
  })
  
  // Format card number with spaces
  const formatCardNumber = () => {
    let value = cardNumber.value.replace(/\D/g, '')
    if (cardType.value === 'amex') {
      value = value.substring(0, 15)
      cardNumber.value = value.replace(/(\d{4})(\d{6})(\d{5})/, '$1 $2 $3').trim()
    } else {
      value = value.substring(0, 16)
      cardNumber.value = value.replace(/(\d{4})(?=\d)/g, '$1 ').trim()
    }
  }
  
  const formattedCardNumber = computed(() => {
    if (!cardNumber.value) return ''
    return cardNumber.value
  })
  
  // Validation
  const validateForm = () => {
    errors.value = {}
    
    if (!cardNumber.value) {
      errors.value.cardNumber = 'Card number is required'
    } else if (cardType.value === 'amex' && !/^\d{4}\s\d{6}\s\d{5}$/.test(cardNumber.value)) {
      errors.value.cardNumber = 'Invalid Amex card number'
    } else if (cardType.value !== 'amex' && !/^\d{4}\s\d{4}\s\d{4}\s\d{4}$/.test(cardNumber.value)) {
      errors.value.cardNumber = 'Invalid card number'
    }
    
    if (!cardName.value) {
      errors.value.cardName = 'Cardholder name is required'
    }
    
    if (!expiryMonth.value || !expiryYear.value) {
      errors.value.expiryDate = 'Expiry date is required'
    }
    
    if (!cvv.value) {
      errors.value.cvv = 'CVV is required'
    } else if ((cardType.value === 'amex' && !/^\d{4}$/.test(cvv.value)) || 
               (cardType.value !== 'amex' && !/^\d{3}$/.test(cvv.value))) {
      errors.value.cvv = 'Invalid CVV'
    }
    
    return Object.keys(errors.value).length === 0
  }
  
  const handleSubmit = () => {
    if (validateForm()) {
        // Ejecuta submitDonation cuando la validación es exitosa
        props.submitDonation({
            cardNumber: cardNumber.value,
            cardName: cardName.value,
            expiry: `${expiryMonth.value}/${expiryYear.value}`,
            cvv: cvv.value
        });
    }
};

  </script>
  
  <style scoped>
  .perspective {
    perspective: 1000px;
  }
  
  .card-container {
    transition: transform 0.8s;
    transform-style: preserve-3d;
  }
  
  .card-container.is-flipped {
    transform: rotateY(180deg);
  }
  
  .card-face {
    backface-visibility: hidden;
  }
  
  .card-front {
    z-index: 2;
  }
  
  .card-back {
    transform: rotateY(180deg);
  }
  
  .shine-effect {
    position: absolute;
    top: -100%;
    left: -100%;
    right: -100%;
    bottom: -100%;
    background: linear-gradient(
      to bottom,
      rgba(255, 255, 255, 0) 0%,
      rgba(255, 255, 255, 0.1) 30%,
      rgba(255, 255, 255, 0.2) 50%,
      rgba(255, 255, 255, 0.1) 70%,
      rgba(255, 255, 255, 0) 100%
    );
    transform: rotate(35deg);
    pointer-events: none;
  }
  
  .card-front .shine-effect,
  .card-back .shine-effect {
    animation: shine 3s ease-in-out infinite;
  }
  
  @keyframes shine {
    0% { transform: translateX(-200%) rotate(35deg); }
    100% { transform: translateX(200%) rotate(35deg); }
  }
  </style>