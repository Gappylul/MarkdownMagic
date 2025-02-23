<script setup>
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import MarkdownEditor from '@/Components/MarkdownEditor.vue';

const props = defineProps({
    blog: {
        type: Object,
        default: null
    }
});

const form = ref({
    title: props.blog?.title || '',
    content: props.blog?.content || ''
});

const errors = ref({});
const processing = ref(false);

const submit = () => {
    processing.value = true;
    
    if (props.blog) {
        // Update existing blog
        router.put(route('blog.update', props.blog.id), form.value, {
            onSuccess: () => {
                processing.value = false;
            },
            onError: (err) => {
                errors.value = err;
                processing.value = false;
            }
        });
    } else {
        // Create new blog
        router.post(route('blog.store'), form.value, {
            onSuccess: () => {
                processing.value = false;
            },
            onError: (err) => {
                errors.value = err;
                processing.value = false;
            }
        });
    }
};
</script>

<template>
    <AppLayout :title="blog ? 'Edit Blog' : 'New Blog'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ blog ? 'Edit Blog' : 'Write New Blog' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                :class="{ 'border-red-500': errors.title }"
                            >
                            <p v-if="errors.title" class="mt-1 text-sm text-red-600">{{ errors.title }}</p>
                        </div>

                        <div class="mt-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content</label>
                            <MarkdownEditor
                                id="content"
                                v-model="form.content"
                                class="mt-1"
                                :class="{ 'border-red-500': errors.content }"
                            />
                            <p v-if="errors.content" class="mt-1 text-sm text-red-600">{{ errors.content }}</p>
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <button
                                type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                :disabled="processing"
                            >
                                {{ blog ? 'Update' : 'Publish' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template> 