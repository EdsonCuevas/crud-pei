<template>
    <div class="relative text-gray-500 focus-within:text-purple-600">
        <select class="rounded block w-full pl-10 mt-1 text-sm text-black focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input" 
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="input" :placeholder="text" :required="required">
        <option value="" selected>{{ text }}</option>
        <option v-for="op in options" :key="op.id" :value="op.id">
            {{ op. }}
        </option>
        </select> 
        <div class="absolute inset-y-0 flex items-center ml-3 pointer-events-none">
        <slot></slot>
        </div>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  
  defineProps(['modelValue', 'text', 'options', 'required']);
  
  defineEmits(['update:modelValue']);
  
  const input = ref(null);
  
  onMounted(() => {
      if (input.value.hasAttribute('autofocus')) {
          input.value.focus();
      }
  });
  </script>
  