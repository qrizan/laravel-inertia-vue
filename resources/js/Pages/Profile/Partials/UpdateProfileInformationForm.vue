<script setup>
import InputError from '@/Components/InputError.vue';
import InputGroup from '@/Components/Forms/InputGroup.vue'

import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information and email address.
            </p>
        </header>
        
        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputGroup
                    label="Name"
                    type="text"
                    id="name"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"                  
                    placeholder="Enter your first name"
                    customClasses="w-full"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputGroup
                    label="Email"
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="name"                  
                    placeholder="Enter your email"
                    customClasses="w-full"
                />


                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
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
