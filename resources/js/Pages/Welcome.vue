<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Simplified Header -->
        <nav class="bg-white dark:bg-gray-800 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <Link :href="route('dashboard')" class="flex items-center">
                        <ApplicationMark class="block h-8 w-auto text-indigo-600" />
                        <span class="ml-2 text-xl font-semibold text-gray-800 dark:text-gray-200">MarkdownMagic</span>
                    </Link>

                    <div class="flex items-center space-x-4">
                        <template v-if="!$page.props.auth.user">
                            <Link :href="route('login')" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                Sign In
                            </Link>
                            <Link v-if="canRegister" :href="route('register')"
                                  class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                                Get Started
                            </Link>
                        </template>
                        <Link v-else :href="route('dashboard')"
                              class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                            Dashboard
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl font-bold text-gray-900 dark:text-white mb-6">
                    Transform Markdown into Beautiful HTML
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    Unleash the power of your content with our intuitive Markdown to HTML converter. Perfect for developers, writers, and content creators who value simplicity and elegance.
                </p>

                <div class="flex justify-center space-x-4">
                    <Link :href="route('register')"
                          class="px-8 py-4 bg-indigo-600 text-white rounded-lg text-lg hover:bg-indigo-700 transition-colors shadow-lg">
                        Start Converting Free
                    </Link>
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="bg-white dark:bg-gray-800 py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-3 gap-12">
                    <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Lightning Fast Conversion</h3>
                        <p class="text-gray-600 dark:text-gray-400">Convert documents in milliseconds with our optimized processing engine. Perfect for large files and batch processing.</p>
                    </div>

                    <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Customizable Output</h3>
                        <p class="text-gray-600 dark:text-gray-400">Add custom CSS classes, choose between multiple themes, or bring your own templates.</p>
                    </div>

                    <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Reliable & Secure</h3>
                        <p class="text-gray-600 dark:text-gray-400">Enterprise-grade security with automatic backups and version history. Your data stays private.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code Example Section -->
        <div class="py-20 bg-gray-50 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">How It Works</h2>
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                            Convert your Markdown in three simple steps:
                        </p>
                        <ol class="space-y-6">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <span class="flex items-center justify-center h-8 w-8 bg-indigo-600 text-white rounded-full">1</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">Write or Paste Markdown</h4>
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">Use our elegant editor or paste existing content</p>
                                </div>
                            </li>
                            <!-- Add steps 2-3 similarly -->
                        </ol>
                    </div>
                    <div class="bg-gray-800 p-6 rounded-xl shadow-xl">
                        <div class="mockup-code">
                            <pre class="text-sm"><code class="text-green-400"># Hello World</code>
<code class="text-gray-300">This is **bold** text</code>
<code class="text-blue-400">[Visit us](https://example.com)</code>
<span class="block mt-4 text-yellow-400">&lt;!-- Converted HTML --&gt;</span>
<code class="text-green-400">&lt;h1&gt;Hello World&lt;/h1&gt;</code>
<code class="text-gray-300">&lt;p&gt;This is &lt;strong&gt;bold&lt;/strong&gt; text&lt;/p&gt;</code>
<code class="text-blue-400">&lt;a href="https://example.com"&gt;Visit us&lt;/a&gt;</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-indigo-600 dark:bg-indigo-800 py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Join Thousands of Happy Users</h2>
                <p class="text-lg text-indigo-100 mb-8">Start converting your Markdown today. No credit card required.</p>
                <div class="flex justify-center space-x-4">
                    <Link :href="route('register')"
                          class="px-8 py-3 bg-white text-indigo-600 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg">
                        Get Started Free
                    </Link>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    © {{ new Date().getFullYear() }} MarkdownMagic. Built with Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </p>
            </div>
        </footer>
    </div>
</template>
