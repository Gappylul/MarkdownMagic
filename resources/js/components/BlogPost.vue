<template>
  <div v-if="loading" class="flex items-center justify-center min-h-screen">
    <div class="text-xl text-gray-600">Loading...</div>
  </div>

  <div v-else-if="error" class="flex items-center justify-center min-h-screen">
    <div class="text-xl text-gray-600">{{ error }}</div>
  </div>

  <div v-else class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold mb-4">{{ blog.title }}</h1>
    <div class="text-gray-600 mb-8">
      By <span class="font-medium">{{ blog.username }}</span>
      <span class="text-gray-400 ml-4">{{ formatDate(blog.created_at) }}</span>
    </div>
    <div class="prose max-w-none" v-html="renderedContent"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { marked } from 'marked'
import DOMPurify from 'dompurify'
import axios from 'axios'

const props = defineProps({
  username: String,
  slug: String
})

const blog = ref(null)
const loading = ref(true)
const error = ref(null)

const renderedContent = computed(() => {
  if (!blog.value) return ''
  return DOMPurify.sanitize(marked(blog.value.content))
})

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
}

onMounted(async () => {
  try {
    const response = await axios.get(`/api/blogs/${props.username}/${props.slug}`)
    blog.value = response.data
  } catch (err) {
    error.value = 'Blog post not found'
    console.error('Error fetching blog:', err)
  } finally {
    loading.value = false
  }
})
</script> 