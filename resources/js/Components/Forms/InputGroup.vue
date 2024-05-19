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

defineExpose({ focus: () => input.value.focus() });

</script>

<template>
  <div :class="customClasses">
    <label class="mb-2.5 block text-black dark:text-white">
      {{ label }}
      <span v-if="required" class="text-meta-1">*</span>
    </label>
    <input
      ref="input"
      v-model="model"
      :type="type"
      :placeholder="placeholder"
      class="
        w-full rounded border-[1.5px] text-black border-stroke bg-transparent 
        py-3 px-5 font-normal outline-none transition focus:border-primary 
        active:border-primary disabled:cursor-default 
        disabled:bg-whiter dark:text-white dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
    />
    
  </div>
</template>
