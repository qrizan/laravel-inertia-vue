<script setup>

defineProps({
  data: {
    type: Object,
    required: true
  },
  updatedPageNumber: {
        type: Function,
        required: true,
    },

})

</script>

<template>
  <div class="max-w-7xl mx-auto py-6">
    <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
      <div class="px-4 py-3 flex items-center justify-between sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden" />
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Showing
              <span class="font-medium">{{ data.meta.from }}</span>
              to
              <span class="font-medium">{{ data.meta.to }}</span>
              of
              <span class="font-medium"> {{ data.meta.total }} </span>
              results
            </p>
          </div>
          <div>
            <nav 
            class="relative z-0 inline-flex -space-x-px " 
            aria-label="Pagination">

              <button 
                @click.prevent="updatedPageNumber(link)"
                v-for="(link, index) in data.meta.links"
                :key="index"
                :disabled="link.active || !link.url"              
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" 
                :class="{
                  'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                  'border-gray-300 text-gray-500 hover:bg-gray-50': !link.active,
                }">
                <span v-html="link.label"></span>
              </button>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
