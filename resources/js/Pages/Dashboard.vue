<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import MarkdownContent from '@/Components/MarkdownContent.vue';

const props = defineProps({
    blogs: Object,
    stats: Object
});

const deleteBlog = (blogId) => {
    if (confirm('Are you sure you want to delete this blog post?')) {
        router.delete(route('blog.destroy', blogId));
    }
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Posts</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ stats.total_posts }}
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Words</div>
                        <div class="mt-1 text-3xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ stats.total_words }}
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Latest Post</div>
                        <div class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ stats.latest_post_date }}
                        </div>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recent Posts</h3>
                    </div>
                    <div v-if="blogs.data.length === 0" class="p-6 text-center text-gray-500 dark:text-gray-400">
                        You haven't written any blogs yet
                    </div>
                    <div v-else>
                        <div v-for="blog in blogs.data" :key="blog.id" 
                            class="p-6 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ blog.title }}
                                    </h4>
                                    <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        Created {{ new Date(blog.created_at).toLocaleDateString() }}
                                    </div>
                                    <div class="mt-2 text-gray-600 dark:text-gray-400 line-clamp-2">
                                        <MarkdownContent :content="blog.content" />
                                    </div>
                                </div>
                                <div class="ml-4 flex items-center space-x-3">
                                    <Link
                                        :href="route('blog.edit', blog.id)"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                                        title="Edit"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </Link>
                                    <button
                                        @click="deleteBlog(blog.id)"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        title="Delete"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                    <Link
                                        :href="route('blog.show', { user: blog.user.name, blog: blog.slug })"
                                        class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
                                        title="View"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
