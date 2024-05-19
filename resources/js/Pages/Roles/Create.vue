<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import DefaultCard from '@/Components/Forms/DefaultCard.vue'
import InputGroup from '@/Components/Forms/InputGroup.vue'
import vSelect from "vue-select";

defineProps({
  permissions: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  title: "",
  selectedPermissions: [],
});

const createRole = () => {
  form.post(route("roles.store"), {
    preserveScroll: true,
  });
};
</script>

<template>

  <Head title="Create Role" />

  <AuthenticatedLayout>
    <DefaultLayout>

      <div class="grid grid-cols-1">
        <div class="flex flex-col ">
          <DefaultCard cardTitle="Add Role">
            <form @submit.prevent="createRole">
              <div class="p-6.5">

                <div class="mb-4.5">
                  <InputGroup v-model="form.title" label="Title" type="text" placeholder="Enter role title" />

                  <InputError :message="form.errors.title" class="mt-2" />
                </div>

                <div class="mb-4.5">
                  <label class="mb-2.5 block text-black dark:text-white"> Permissions </label>

                  <div class="relative z-20 bg-transparent dark:bg-form-input">
                    <v-select v-model="form.selectedPermissions" multiple :reduce="(permission) => permission.id"
                      :options="permissions.data" label="title"
                      class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent py-3 px-5 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
                      :class="{
                        ' text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300'
                        :form.errors.category_id
                      }"
                      >

                    </v-select>
                    <InputError class="mt-2" :message="form.errors.selectedPermissions" />
                  </div>
                </div>

                <button
                type="submit"
                class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
              >
                Save
              </button>
              </div>
            </form>

          </DefaultCard>
        </div>
      </div>



    </DefaultLayout>
  </AuthenticatedLayout>
</template>