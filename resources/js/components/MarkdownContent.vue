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
  htmlContent.value = marked(props.content || '');
});
</script>

<template>
  <div class="prose dark:prose-invert max-w-none" v-html="htmlContent"></div>
</template> 