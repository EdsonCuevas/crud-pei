<template>
    <Header/>
    <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
      <div class="w-full max-w-2xl   bg-white rounded-lg shadow-xl overflow-hidden">
        <div class="p-6">
          <h1 class="text-2xl font-bold text-[#004481] mb-5 text-center">
            You are one step away from supporting the dream of thousands of students.
          </h1>
          
          <div class="flex space-x-2 mb-6">
            <button
              @click="donationType = 'single'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'single' ? 'bg-[#004481] text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
            Single donation
             </button>
            <button
              @click="donationType = 'monthly'"
              :class="[
                'flex-1 py-2 px-4 rounded-md transition-colors duration-200',
                donationType === 'monthly' ? 'bg-[#004481] text-white' : 'bg-white text-[#004481] border border-[#004481]'
              ]"
            >
            Monthly donation
            </button>
          </div>
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Select your contribution amount</h3>
            <div class="grid grid-cols-3 gap-2 mb-2">
              <button
                v-for="amount in ['$350', '$500', '$750']"
                :key="amount"
                class="py-2 px-4 border border-[#004481] text-[#004481] rounded-md hover:bg-[#004481] hover:text-white transition-colors duration-200"
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
          
          <div class="mb-6">
            <h3 class="text-sm font-semibold text-[#004481] mb-2">Fill in your personal data</h3>
            <div class="space-y-2">
              <input
                type="text"
                placeholder="Name(s)"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="text"
                placeholder="Paternal Last Name"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="text"
                placeholder="Maternal Last Name"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="email"
                placeholder="E-mail"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
              <input
                type="tel"
                placeholder="Phone"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#004481]"
              />
            </div>
          </div>
          
          <div class="text-xs text-center text-gray-500 mb-4">
            Secure donation.<br />
            Your data will be encrypted
          </div>
          
          <button class="w-full py-3 bg-[#1973B8] text-white rounded-md hover:bg-[#004481] transition-colors duration-200">
            Continue
          </button>
        </div>
      </div>
    </div>
    <Footer />
  </template>
  
  <script setup>
   import Footer from '@/Components/Footer.vue';
   import Header from '@/Components/Header.vue';
  import { ref } from 'vue'
  
  const donationType = ref('single')
  </script>