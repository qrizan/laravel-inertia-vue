<script setup>
import InputError from '@/Components/InputError.vue';
import InputGroup from '@/Components/Forms/InputGroup.vue'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <header>
            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </header>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <div>
                <InputGroup
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    label="Current Password"
                    required
                    autofocus
                    autocomplete="current_password"                  
                    placeholder="Enter your Current Password"
                    customClasses="w-full"
                />

                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <div>
                <InputGroup
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    label="New Password"
                    required
                    autofocus
                    autocomplete="password"                  
                    placeholder="Enter your New Password"
                    customClasses="w-full"
                />

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div>
                <InputGroup
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    label="Confirmation New Password"
                    required
                    autofocus
                    autocomplete="password_confirmation"                  
                    placeholder="Enter your New Password"
                    customClasses="w-full"
                />

                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <input
                    type="submit"
                    value="Save"
                    class="w-1/4 cursor-pointer flex justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                />

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
