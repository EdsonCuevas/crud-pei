<template>
    <div class="relative text-gray-500 focus-within:text-purple-600">
        <input class="rounded block w-full pl-10 mt-1 text-sm text-black focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" :placeholder="text" :type="type" :required="required" :accept="accept" > 
        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
        <slot></slot>
        </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  
  defineProps(['modelValue', 'text', 'type', 'required', 'accept']);
  
  defineEmits(['update:modelValue']);
  
  const input = ref(null);
  
  onMounted(() => {
      if (input.value.hasAttribute('autofocus')) {
          input.value.focus();
      }
  });
  </script>
  