<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import Pagination from "@/Components/Pagination.vue";
import InputGroup from '@/Components/Forms/InputGroup.vue'
import DefaultCard from '@/Components/Forms/DefaultCard.vue'
import { ref } from 'vue';
import SelectGroupTwo from '@/Components/Forms/SelectGroup/SelectGroupTwo.vue'
import InputError from '@/Components/InputError.vue';

import { Head, useForm, usePage, router } from '@inertiajs/vue3';

defineProps({
  categories: {
    type: Object,
    required: true
  },
  suppliers: {
    type: Object,
    required: true
  },

  product: {
    type: Object,
    required: true
  }
});

let product = usePage().props.product.data;

const form = useForm({
  name: product.name,
  image: null,
  category_id: product.category.id,
  supplier_id: product.supplier.id
})

const handleFileUpload = (event) => {
  form.image = event.target.files[0];
}

const updateProduct = () => {

  router.post(route("products.update", product.id), {
    _method: 'patch',
    name: form.name,
    image:form.image,
    category_id: form.category_id,
    supplier_id: form.supplier_id,  });

};

</script>

<template>

  <Head title="Products" />
  <AuthenticatedLayout>
    <DefaultLayout>
      <div class="grid grid-cols-1">
        <div class="flex flex-col ">
          <!-- Contact Form Start -->
          <DefaultCard cardTitle="Add Product">
            <form @submit.prevent="updateProduct">
              <div class="p-6.5">

                <div>
                  <InputGroup v-model="form.name" label="Name" type="text" placeholder="Enter product name"
                    customClasses="mb-4.5" />

                  <InputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                  <label class="mb-2.5 block text-black dark:text-white">
                    Image
                  </label>
                  <input @change="handleFileUpload" type="file" class="mb-4.5 w-full cursor-pointer rounded-lg 
                         border-[1.5px] border-stroke bg-transparent font-medium 
                         outline-none transition 
                         file:mr-5 file:border-collapse 
                         file:cursor-pointer file:border-0 
                         file:border-r file:border-solid file:border-stroke file:bg-whiter 
                         file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 
                         focus:border-primary active:border-primary disabled:cursor-default 
                         disabled:bg-whiter dark:border-form-strokedark 
                         dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 
                         dark:file:text-white dark:focus:border-primary" />
                  <InputError :message="form.errors.image" class="mt-2" />
                </div>

                <div class="mb-4.5">
                  <label class="mb-2.5 block text-black dark:text-white"> Category </label>

                  <div class="relative z-20 bg-transparent dark:bg-form-input">
                    <select v-model="form.category_id" id="category_id"
                      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                      :class="{
                        ' text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300'
                          : form.errors.category_id
                      }">
                      <option value="" disabled>Select category</option>
                      <option v-for="item in categories.data" :key="item.id" :value="item.id">
                        {{ item.name }}
                      </option>
                    </select>
                  </div>
                  <InputError :message="form.errors.category_id" class="mt-2" />
                </div>

                <div class="mb-4.5">
                  <label class="mb-2.5 block text-black dark:text-white"> Supplier </label>

                  <div class="relative z-20 bg-transparent dark:bg-form-input">
                    <select v-model="form.supplier_id" id="supplier_id"
                      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                      :class="{
                        ' text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300'
                          : form.errors.supplier_id
                      }">
                      <option value="" disabled>Select supplier</option>
                      <option v-for="item in suppliers.data" :key="item.id" :value="item.id">
                        {{ item.name }}
                      </option>
                    </select>
                  </div>
                  <InputError :message="form.errors.supplier_id" class="mt-2" />
                </div>

                <button type="submit"
                  class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90">
                  Update
                </button>
              </div>
            </form>
          </DefaultCard>
          <!-- Contact Form End -->
        </div>

      </div>
    </DefaultLayout>
  </AuthenticatedLayout>
</template>
