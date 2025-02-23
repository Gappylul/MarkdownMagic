<script setup>
import { onMounted, ref } from 'vue';
import { marked } from 'marked';

const props = defineProps({
  content: {
    type: String,
    required: true
  }
});

const htmlContent = ref('');

onMounted(() => {
  // Configure marked to use Prism for syntax highlighting
  marked.setOptions({
    gfm: true,
    breaks: true
  });

  // Convert markdown to HTML with syntax highlighting
  htmlContent.value = marked(props.content);
});
</script>

<template>
  <div class="prose dark:prose-invert max-w-none" v-html="htmlContent"></div>
</template>

<style>
/* Add custom styles for code blocks */
.prose pre {
  background: #1a1a1a !important;
  border-radius: 0.5rem;
  padding: 1rem;
  margin: 1rem 0;
}

.prose code {
  background: #2d2d2d;
  padding: 0.2rem 0.4rem;
  border-radius: 0.25rem;
  font-size: 0.875em;
}

.prose pre code {
  background: transparent;
  padding: 0;
  border-radius: 0;
  color: #e6e6e6;
}

/* Additional prose styles */
.prose {
  max-width: none;
}

.prose a {
  color: #3b82f6;
  text-decoration: underline;
}

.prose a:hover {
  color: #2563eb;
}

.prose blockquote {
  border-left: 4px solid #e5e7eb;
  padding-left: 1rem;
  font-style: italic;
}

.prose ul {
  list-style-type: disc;
  padding-left: 1.5rem;
}

.prose ol {
  list-style-type: decimal;
  padding-left: 1.5rem;
}

/* Dark mode adjustments */
.dark .prose {
  color: #e5e7eb;
}

.dark .prose a {
  color: #60a5fa;
}

.dark .prose a:hover {
  color: #93c5fd;
}

.dark .prose blockquote {
  border-left-color: #374151;
}
</style> 