<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import MarkdownContent from '@/Components/MarkdownContent.vue';

const props = defineProps({
  blogs: Object,
  filters: Object,
  isDashboard: Boolean
});

const deleteBlog = (blogId) => {
  if (confirm('Are you sure you want to delete this blog post?')) {
    router.delete(route('blog.destroy', blogId));
  }
};
</script>

<template>
  <AppLayout title="My Blogs">
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          My Blog Posts
        </h2>
        <Link
          :href="route('blog.editor')"
          class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 ease-in-out flex items-center gap-2"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
          </svg>
          Write New Blog
        </Link>
      </div>
    </template>

    <div v-if="$page.props?.flash?.message" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
      <div class="bg-green-50 dark:bg-green-900 p-4 rounded-md">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
          </div>
          <div class="ml-3">
            <p class="text-sm font-medium text-green-800 dark:text-green-200">
              {{ $page.props.flash.message }}
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="py-6">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Search -->
        <div class="mb-6">
          <form method="GET" :action="route(isDashboard ? 'blog.dashboard' : 'blog.index')" class="flex gap-4">
            <div class="flex-1">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                  </svg>
                </div>
                <input
                  name="search"
                  type="text"
                  :value="filters.search"
                  placeholder="Search blogs..."
                  class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-700 rounded-lg leading-5 bg-white dark:bg-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:text-gray-200"
                >
              </div>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Search
            </button>
          </form>
        </div>

        <!-- Blog List -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
          <div v-if="!blogs.data.length" class="p-6 text-center text-gray-500 dark:text-gray-400">
            {{ isDashboard ? "You haven't written any blogs yet" : 'No blogs found' }}
          </div>
          
          <div v-else>
            <div v-for="blog in blogs.data" :key="blog.id" class="border-b border-gray-200 dark:border-gray-700 last:border-b-0">
              <div class="p-6">
                <div class="flex items-center justify-between">
                  <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                      {{ blog.title }}
                    </h3>
                    <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                      Created {{ new Date(blog.created_at).toLocaleDateString() }}
                    </div>
                    <div class="mt-2 text-gray-600 dark:text-gray-400 line-clamp-2">
                      <MarkdownContent :content="blog.content" />
                    </div>
                  </div>
                  <div class="ml-4 flex items-center space-x-3">
                    <Link
                      :href="route('blog.show', { user: blog.user.name, blog: blog.slug })"
                      class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300"
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

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
              <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                  <Link
                    v-if="blogs.prev_page_url"
                    :href="blogs.prev_page_url"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                  >
                    Previous
                  </Link>
                  <Link
                    v-if="blogs.next_page_url"
                    :href="blogs.next_page_url"
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                  >
                    Next
                  </Link>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                  <div>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                      Showing
                      <span class="font-medium">{{ blogs.from }}</span>
                      to
                      <span class="font-medium">{{ blogs.to }}</span>
                      of
                      <span class="font-medium">{{ blogs.total }}</span>
                      results
                    </p>
                  </div>
                  <div>
                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                      <Link
                        v-for="link in blogs.links"
                        :key="link.label"
                        :href="link.url"
                        :class="[
                          link.active ? 'bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-600 dark:text-indigo-200' : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700',
                          'relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                        ]"
                        v-html="link.label"
                      />
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template> 