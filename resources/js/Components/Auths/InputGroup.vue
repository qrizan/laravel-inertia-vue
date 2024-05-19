<script setup>
import { defineComponent, onMounted, ref } from 'vue';

defineProps({
  label: String,
  type: String,
  placeholder: String,
  customClasses: String,
  required: {
    type: Boolean,
    default: false
  }
})

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });</script>

<template>
  <div class="mb-4">
    <label class="mb-2.5 block font-medium text-black dark:text-white">{{ label }}</label>
    <div class="relative">
      <input
        ref="input"
        v-model="model"
        :type="type"
        :placeholder="placeholder"
        class="w-full rounded-lg border border-stroke bg-transparent 
        py-4 pl-6 pr-10 outline-none focus:border-primary focus-visible:shadow-none 
        dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary 
        text-black dark:text-white"
      />

      <span class="absolute right-4 top-4">
        <slot></slot>
      </span>
    </div>
  </div>
</template>
