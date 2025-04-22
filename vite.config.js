import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
    vue({
      template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
    }),
  ],
  resolve: {
    alias: {
      vue: 'vue/dist/vue.esm-bundler.js',
    },
  },
  build: {
    rollupOptions: {
      output: {
        manualChunks: {
          vendor: ['vue', 'axios', 'lodash'], // Separate large libraries
          daisyui: ['daisyui'],
        },
      },
    },
    chunkSizeWarningLimit: 1000, // Increase limit to suppress warnings
  },
});
