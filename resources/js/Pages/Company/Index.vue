<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, h } from 'vue';
import { Table, message, Image } from 'ant-design-vue';
import { Button as AButton } from 'ant-design-vue'; // Import AButton from Ant Design Vue

const props = defineProps({
    companies: Array
});

function deleteCompany(id) {
    if (confirm('Are you sure you want to delete this company?')) {
        this.$inertia.delete(`/companies/${id}`, {
            onSuccess: () => message.success('Company deleted successfully')
        });
    }
}

const columns = [
    {
        title: 'Name',
        dataIndex: 'name',
        key: 'name',
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
    },
    {
        title: 'Website',
        dataIndex: 'website',
        key: 'website',
        customRender: (text) => h('a', {
            href: text.value,
            target: '_blank',
            rel: 'noopener noreferrer',
            style: { color: 'blue' }
        }, text.value)
    },
    { 
        title: 'Logo', 
        dataIndex: 'logo', 
        key: 'logo', 
        customRender: (logo) => h(Image, { 
            src: "storage/"+logo.value,
            alt: 'Company Logo', 
            style: { 
                height: 'auto', 
                maxWidth: '100px' 
            } 
        }) 
    },
    {
        title: 'Actions',
        key: 'actions',
        customRender: ({ text, record }) => {
            return h('span', [
                h(Link, {
                    href: `/company/${record.id}/edit`,
                    class: 'text-indigo-600 hover:text-indigo-900 mr-2' // Add custom classes for styling
                }, () => 'Edit'), // Pass a function to the default slot
                h(AButton, {
                    type: 'primary',
                    class: 'text-white bg-red-600 border border-red-600 hover:bg-red-700 focus:ring focus:ring-red-300' // Add custom classes for styling
                }, () => 'Delete') // Pass a function to the default slot
            ]);
        }

    }
];
</script>

<template>
    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/company/create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-4">
                            Create Company
                        </Link>
                        <!-- Success Message -->
                        
                        <Table :columns="columns" :dataSource="props.companies" rowKey="id" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
