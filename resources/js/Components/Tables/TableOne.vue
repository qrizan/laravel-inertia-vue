<script setup lang="ts">
import { ref } from 'vue'

import BrandOne from '@/assets/images/brand/brand-01.svg'
import BrandTwo from '@/assets/images/brand/brand-02.svg'
import BrandThree from '@/assets/images/brand/brand-03.svg'
import BrandFour from '@/assets/images/brand/brand-04.svg'
import BrandFive from '@/assets/images/brand/brand-05.svg'

const brandData = ref([
  {
    name: 'Google',
    conversion: 4.8
  },
  {
    name: 'Twitter',
    conversion: 4.3
  },
  {
    name: 'Github',
    conversion: 3.7
  },
  {
    name: 'Vimeo',
    conversion: 2.5
  },
  {
    name: 'Facebook',
    conversion: 4.2
  }
])
</script>

<template>
  <div
    class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1"
  >
    <h4 class="mb-5 text-xl font-semibold text-black dark:text-white">Top Channels</h4>

    <div class="flex flex-col">

      <div
        v-for="(brand, key) in brandData"
        :key="key"
        :class="`grid grid-cols-5 sm:grid-cols-5 ${
          key === brandData.length - 1 ? '' : 'border-b border-stroke dark:border-strokedark'
        }`"
      >
        <div class="items-center xl:p-5">
          <p class="hidden text-black dark:text-white sm:block">{{ brand.name }}</p>
        </div>

        <div class="items-center justify-center p-2.5 sm:flex xl:p-5">
          <p class="text-meta-5">{{ brand.conversion }}%</p>
        </div>
      </div>
    </div>
  </div>
</template>
