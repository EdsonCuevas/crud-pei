<script setup>

import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/Donors/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
  
const donationType = ref('single')
</script>

<template>
    <Head title="Donation" />
    <AuthenticatedLayout>
    <div class="flex items-center justify-center p-4">
      <div class="w-full max-w-2xl   bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6">
          <h1 class="text-2xl font-bold text-[#004481] mb-5 text-center">
           Donation
          </h1>
          
          <div class="flex space-x-2 mb-6">
            <button
              @click="donationType = 'single'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'single' ? 'bg-blue-500 text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
            Single donation
             </button>
            <button
              @click="donationType = 'monthly'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'monthly' ? 'bg-blue-500 text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
            Monthly donation
            </button>
          </div>
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Select your contribution amount</h3>
            <div class="grid grid-cols-3 gap-2 mb-2">
              <button
                v-for="amount in ['$100', '$500', '$1000']"
                :key="amount"
                class="py-2 px-4 border border-[#004481] text-[#004481] rounded-md hover:bg-blue-500 hover:text-white transition-colors duration-200"
              >
                {{ amount }}
              </button>
            </div>
            <input
              type="text"
              placeholder="Other amount"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
            />
          </div>
          
          
          
          <div class="text-xs text-center text-gray-500 mb-4">
            Secure donation.<br />
            Your data will be encrypted
          </div>
          
          <button class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-[#004481] transition-colors duration-200">
            Continue
          </button>
        </div>
      </div>
    </div>
    </AuthenticatedLayout>
</template>