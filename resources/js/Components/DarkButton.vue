<template>
    <button :type="type" class="rounded-lg border border-transparent bg-blue-500 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-600 focus:outline-none focus:ring active:bg-purple-600">
      <slot/>
    </button>
  </template>
  
  <script setup>
  defineProps({
      type: {
          type: String,
          default: 'submit',
      },
  });
  </script>
  