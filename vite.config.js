import { defineConfig } from 'vite'

// Dev server sends /App requests to the PHP server
export default defineConfig({
  server: {
    port: 3000,
    proxy: {
      '/App': {
        // Backend PHP (XAMPP o php -S); ajusta el puerto si usas otro
        target: 'http://localhost:8000',
        changeOrigin: true,
      },
      // Redirección a /gracias.php debe pasar por PHP, no servirse en estático por Vite
      '/index.php': {
        target: 'http://localhost:8000',
        changeOrigin: true,
      },
      // Redirección a /gracias.php debe pasar por PHP, no servirse en estático por Vite
      '/gracias.php': {
        target: 'http://localhost:8000',
        changeOrigin: true,
      },
    },
  },
})
