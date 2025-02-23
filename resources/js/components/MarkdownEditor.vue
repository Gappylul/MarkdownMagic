<script setup>
import { ref, computed } from 'vue';
import { marked } from 'marked';

const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
});

const emit = defineEmits(['update:modelValue']);

const content = computed({
  get: () => props.modelValue,
  set: (value) => emit('update:modelValue', value)
});

const preview = computed(() => marked(content.value || ''));
</script>

<template>
  <div class="flex gap-6 h-[600px]">
    <div class="w-1/2">
      <textarea
        v-model="content"
        class="w-full h-full p-4 font-mono border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-900 dark:text-gray-300 resize-none"
        placeholder="Write your blog post in markdown..."
      ></textarea>
    </div>
    
    <div class="w-1/2">
      <div 
        class="w-full h-full p-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm overflow-y-auto bg-white dark:bg-gray-900"
      >
        <div 
          class="prose dark:prose-invert max-w-none"
          v-html="preview"
        />
      </div>
    </div>
  </div>
</template> 