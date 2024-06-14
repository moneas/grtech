<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    logo: null,
    website: ''
});

const handleLogoChange = (event) => {
    form.logo = event.target.files[0];
};

const submit = () => {
    form.post(route('company.store'), {
        onSuccess: () => form.reset()
    });
};
</script>

<template>
    <Head title="Create Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                                <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>

                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                                <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</div>
                            </div>

                            <div class="mt-4">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input id="logo" type="file" class="mt-1 block w-full" @change="handleLogoChange" />
                                <div v-if="form.errors.logo" class="text-red-600 text-sm mt-1">{{ form.errors.logo }}</div>
                            </div>

                            <div class="mt-4">
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <input id="website" v-model="form.website" type="text" class="mt-1 block w-full" />
                                <div v-if="form.errors.website" class="text-red-600 text-sm mt-1">{{ form.errors.website }}</div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">Create Company</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
