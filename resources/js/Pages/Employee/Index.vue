<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Table, message, Button } from 'ant-design-vue';
import { h } from 'vue';

const props = defineProps({
    employees: Array,
});

const columns = [
    {
        title: 'First Name',
        dataIndex: 'first_name',
        key: 'first_name',
    },
    {
        title: 'Last Name',
        dataIndex: 'last_name',
        key: 'last_name',
    },
    {
        title: 'Company',
        dataIndex: ['company', 'name'],
        key: 'company',
    },
    {
        title: 'Email',
        dataIndex: 'email',
        key: 'email',
    },
    {
        title: 'Phone',
        dataIndex: 'phone',
        key: 'phone',
    },
    {
        title: 'Actions',
        key: 'actions',
        customRender: ({ text, record }) => {
            return h('span', [
                h(Link, {
                    href: `/employee/${record.id}/edit`,
                    class: 'text-indigo-600 hover:text-indigo-900 mr-2'
                }, 'Edit'),
                h(Button, {
                    type: 'primary',
                    danger: true,
                    onClick: () => handleDelete(record.id),
                    class: 'ml-2'
                }, 'Delete')
            ]);
        }
    }
];

const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this employee?')) {
        axios.delete(`/employee/${id}`)
            .then(() => {
                message.success('Employee deleted successfully.');
                window.location.reload();
            })
            .catch(() => {
                message.error('Failed to delete employee.');
            });
    }
};
</script>
<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Employees</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <Link href="/employee/create" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 mb-4">
                            Add Employee
                        </Link>
                        <Table :columns="columns" :dataSource="employees" rowKey="id" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


