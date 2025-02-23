<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import MarkdownContent from '@/Components/MarkdownContent.vue';

defineProps({
  blog: Object
});
</script>

<template>
  <AppLayout :title="blog.title">
    <Head :title="blog.title" />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ blog.title }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ blog.title }}
          </h1>
          
          <div class="mt-2 flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
            <img :src="blog.user.profile_photo_url" :alt="blog.user.name" class="h-8 w-8 rounded-full">
            <span>{{ blog.user.name }}</span>
            <span>•</span>
            <span>{{ new Date(blog.created_at).toLocaleDateString() }}</span>
          </div>

          <div class="mt-6">
            <MarkdownContent :content="blog.content" />
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<style>
.prose a {
  text-decoration: underline;
}

.prose pre {
  background-color: #1a1a1a;
  color: #fff;
  padding: 1rem;
  border-radius: 0.5rem;
  overflow-x: auto;
}

.prose code {
  color: #e83e8c;
  background-color: rgba(0,0,0,0.05);
  padding: 0.2em 0.4em;
  border-radius: 3px;
}

.prose pre code {
  color: inherit;
  background-color: transparent;
  padding: 0;
}
</style> 