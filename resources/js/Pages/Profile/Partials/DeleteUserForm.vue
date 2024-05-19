<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import ButtonDefault from '@/Components/Buttons/ButtonDefault.vue';
import InputGroup from '@/Components/Forms/InputGroup.vue';

import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6">
        <header>
            <p class="mt-1 text-sm text-gray-600">
                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.
            </p>
        </header>

        <ButtonDefault 
            @click="confirmUserDeletion" 
            label="Delete Account" 
            customClasses="rounded bg-danger text-white cursor-pointer p-3 font-medium" />

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete your account?
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    Once your account is deleted, all of its resources and data will be permanently deleted. Please
                    enter your password to confirm you would like to permanently delete your account.
                </p>

                <div class="mt-6">
                    <InputGroup
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Password"
                    @keyup.enter="deleteUser"
                    label="Confirmation Password"
                    required
                    autofocus
                    autocomplete="password_confirmation"                  
                    customClasses="w-full"
                />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end space-x-3">
             
                    <ButtonDefault 
                        label="Cancel" 
                        customClasses="rounded border border-primary text-primary cursor-pointer" 
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="closeModal"
                    />

                    <ButtonDefault 
                        label="Delete Account" 
                        customClasses="rounded bg-danger text-white cursor-pointer" 
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="deleteUser"
                    />

                </div>
            </div>
        </Modal>
    </section>
</template>
