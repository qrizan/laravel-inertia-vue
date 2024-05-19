<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import DefaultCard from '@/Components/Forms/DefaultCard.vue'

import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <DefaultLayout>
            <div class="max-w-7xl mx-auto space-y-6">
                <DefaultCard cardTitle="Profile Information">
                    <div class="p-4">
                        <UpdateProfileInformationForm
                            :must-verify-email="mustVerifyEmail"
                            :status="status"
                            class="max-w-xl"
                        />
                    </div>
                </DefaultCard>

                <DefaultCard cardTitle="Update Password">
                    <div class="p-4">
                        <UpdatePasswordForm class="max-w-xl" />
                    </div>
                </DefaultCard>


                <DefaultCard cardTitle="Delete Account">
                    <div class="p-4">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </DefaultCard>
            </div>
        </DefaultLayout>
    </AuthenticatedLayout>
</template>
