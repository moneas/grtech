<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    employee: Object,
    companies: Array,
    errors: Object // Add errors prop
});

const form = useForm({
    first_name: props.employee.first_name,
    last_name: props.employee.last_name,
    company_id: props.employee.company_id,
    email: props.employee.email,
    phone: props.employee.phone
});

const submit = () => {
    form.put(`/employee/${props.employee.id}`);
};
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Employee</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                                <input 
                                    type="text" 
                                    v-model="form.first_name" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                    required 
                                />
                                <div v-if="props.errors.first_name" class="text-red-600 text-sm mt-1">{{ props.errors.first_name }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                <input 
                                    type="text" 
                                    v-model="form.last_name" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                    required 
                                />
                                <div v-if="props.errors.last_name" class="text-red-600 text-sm mt-1">{{ props.errors.last_name }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="company_id" class="block text-sm font-medium text-gray-700">Company</label>
                                <select 
                                    v-model="form.company_id" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                    required
                                >
                                    <option v-for="company in props.companies" :key="company.id" :value="company.id">{{ company.name }}</option>
                                </select>
                                <div v-if="props.errors.company_id" class="text-red-600 text-sm mt-1">{{ props.errors.company_id }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input 
                                    type="email" 
                                    v-model="form.email" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                />
                                <div v-if="props.errors.email" class="text-red-600 text-sm mt-1">{{ props.errors.email }}</div>
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input 
                                    type="text" 
                                    v-model="form.phone" 
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                                />
                                <div v-if="props.errors.phone" class="text-red-600 text-sm mt-1">{{ props.errors.phone }}</div>
                            </div>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
