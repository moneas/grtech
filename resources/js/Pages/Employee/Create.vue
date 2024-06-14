<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    companies: Array
});

const form = useForm({
    first_name: '',
    last_name: '',
    company_id: '',
    email: '',
    phone: ''
});

const submit = () => {
    form.post('/employee');
};
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Employee</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" v-model="form.first_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                            </div>
                            <div class="mb-4">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" v-model="form.last_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required />
                            </div>
                            <div class="mb-4">
                                <label for="company_id" class="block text-sm font-medium text-gray-700">Company</label>
                                <select v-model="form.company_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option v-for="company in companies" :key="company.id" :value="company.id">{{ company.name }}</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" v-model="form.email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" v-model="form.phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


