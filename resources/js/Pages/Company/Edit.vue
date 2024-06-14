<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    company: Object,
    errors: Object,
});

const form = useForm({
    name: props.company.name,
    email: props.company.email,
    logo: null,
    website: props.company.website
});

const handleLogoChange = (selectedFiles) => {
    console.log(selectedFiles.target.files[0])
    form.logo = selectedFiles.target.files[0];
    console.log(form);
}

const submit = () => {
    const formData = new FormData();
    formData.append('_method', 'PUT');
    formData.append('name', form.name);
    formData.append('email', form.email);
    if (form.logo) {
        formData.append('logo', form.logo);
    }
    formData.append('website', form.website);

    router.post(route('company.update', props.company.id), formData, {
        onSuccess: () => form.reset()
    });
};
const logoUrl = computed(() => {
    return props.company.logo ? `/storage/${props.company.logo}` : null;
});
</script>
<template>
    <Head title="Edit Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Company</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">

                            <!-- Name -->
                            <div class="mt-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                                <div v-if="form.errors.name" class="text-red-600 text-sm mt-1">{{ form.errors.name }}</div>
                            </div>

                            <!-- Email -->
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                                <div v-if="form.errors.email" class="text-red-600 text-sm mt-1">{{ form.errors.email }}</div>
                            </div>

                            <!-- Logo -->
                            <div class="mt-4">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input id="logo" type="file" class="mt-1 block w-full" @change="handleLogoChange" />
                                <div v-if="form.errors.logo" class="text-red-600 text-sm mt-1">{{ form.errors.logo }}</div>
                                <div v-if="logoUrl" class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Current Logo</label>
                                    <img :src="logoUrl" alt="Company Logo" class="mt-1 h-20 w-20 object-cover">
                                </div>
                            </div>

                            <!-- Website -->
                            <div class="mt-4">
                                <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                <input id="website" v-model="form.website" type="text" class="mt-1 block w-full" />
                                <div v-if="form.errors.website" class="text-red-600 text-sm mt-1">{{ form.errors.website }}</div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">Update Company</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
