<script setup lang="ts">
const props = defineProps(['subtitle', 'title', 'customClasses'])
</script>

<template>
  <!-- ====== Forms Section Start -->
  <div
    class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
  >
    <div class="flex flex-wrap items-center">
      <div class="hidden w-full xl:block xl:w-1/2">
        <div class="py-17.5 px-26 text-center">
          <router-link class="mb-5.5 inline-block" to="/">
            <h1 class="text-3xl	font-bold">Inventory App</h1>
          </router-link>

          <p class="font-medium 2xl:px-20">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit suspendisse.
          </p>

          <span class="mt-15 inline-block">
            <img src="@/assets/images/illustration/illustration-03.svg" alt="illustration" />
          </span>
        </div>
      </div>
      <div class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2">
        <div class="w-full p-4 sm:p-10 xl:p-15">
          <h2 class="mb-7 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
            {{ props.title }}
          </h2>

          <slot></slot>
        </div>
      </div>
    </div>
  </div>
  <!-- ====== Forms Section End -->
</template>
