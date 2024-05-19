<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import Pagination from "@/Components/Pagination.vue"
import InputGroup from '@/Components/Forms/InputGroup.vue'
import Swal from 'sweetalert2'

import { Head, Link, usePage, useForm, router } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'

defineProps({
  products: {
    type: Object,
    required: true
  }
})

const page = usePage();
let search = ref(usePage().props.search), pageNumber = ref(1);

let productsUrl = computed(() => {
  let url = new URL(route("products.index"));
  url.searchParams.append("page", pageNumber.value);

  if (search.value) {
    url.searchParams.append("search", search.value);
  }

  return url;
});

const updatedPageNumber = (link) => {
  pageNumber.value = link.url.split("=")[1];
};

watch(
  () => productsUrl.value,
  (updatedProductsUrl) => {
    router.visit(updatedProductsUrl, {
      preserveScroll: true,
      preserveState: true,
      replace: true,
    });
  }
);


const deleteForm = useForm({});

const deleteProduct = (productId) => {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      deleteForm.delete(route("products.destroy", productId), {
        preserveScroll: true,
      });
      Swal.fire({
        title: "Deleted!",
        text: "Your data has been deleted.",
        icon: "success"
      });
    }
  });

}

</script>

<template>

  <Head title="Products List" />
  <AuthenticatedLayout>
    <DefaultLayout>
      <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
        <div class="pb-4 px-5">
          <div class="flex flex-col justify-between sm:flex-row mt-4">
            <InputGroup v-model="search" type="text" autocomplete="off" placeholder="Search..." autofocus
              customClasses="block" />

            <div class="mt-4 sm:ml-16 sm:flex-none">
              <Link v-if="page.props.can.product_create" :href="route('products.create')" class="
                  inline-flex items-center justify-center rounded
                bg-primary px-4 py-2 text-sm font-medium text-white shadow-sm 
                  hover:bg-indigo-700">
              Add Product
              </Link>
            </div>

          </div>
        </div>

        <!-- Table Header -->
        <div class="grid grid-cols-5 border-t border-stroke py-4.5 px-4 
               dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
          <div class="col-span-3 flex items-center">
            <p class="font-medium">Product Name</p>
          </div>
          <div class="col-span-2 hidden items-center sm:flex">
            <p class="font-medium">Category</p>
          </div>
          <div class="col-span-1 flex items-center">
            <p class="font-medium">Supplier</p>
          </div>
          <div class="col-span-1 flex items-center">
            <p class="font-medium">Created At</p>
          </div>
          <div class="col-span-1 flex items-center">
            <p class="font-medium"></p>
          </div>
        </div>

        <!-- Table Rows -->
        <div v-for="product in products.data" :key="product.id" class="grid grid-cols-5 border-t border-stroke 
                 py-4.5 px-4 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
          <div class="col-span-3 flex items-center">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
              <div class="h-12.5 w-15 rounded-md">
                <img :src="product.image" :alt="`Product: ${product.name}`" />
              </div>
              <p class="text-sm font-medium text-black dark:text-white">{{ product.name }}</p>
            </div>
          </div>
          <div class="col-span-2 hidden items-center sm:flex">
            <p class="text-sm font-medium text-black dark:text-white">{{ product.category.name }}</p>
          </div>
          <div class="col-span-1 flex items-center">
            <p class="text-sm font-medium text-black dark:text-white">{{ product.supplier.name }}</p>
          </div>
          <div class="col-span-1 flex items-center">
            <p class="text-sm font-medium text-black dark:text-white">{{ product.created_at }}</p>
          </div>
          <div class="col-span-1 flex items-center">
            <Link v-if="page.props.can.product_edit" :href="route('products.edit', product.id)"
              class="text-indigo-600 hover:text-indigo-900">
            Edit
            </Link>
            <button v-if="page.props.can.product_delete" @click="deleteProduct(product.id)"
              class="ml-2 text-indigo-600 hover:text-indigo-900">
              Delete
            </button>

          </div>
        </div>
      </div>

      <Pagination :data="products" :updatedPageNumber="updatedPageNumber" />
    </DefaultLayout>
  </AuthenticatedLayout>
</template>