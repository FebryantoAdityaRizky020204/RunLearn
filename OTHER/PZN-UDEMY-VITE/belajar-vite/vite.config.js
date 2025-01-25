import { defineConfig } from 'vite'

export default defineConfig({
    build: {
        outDir: 'production' // ? mengubah nama filder build dari dist menjadi production
    },
    server: {
        port: 5173 // ? mengubah port menjadi localhost:3000
    }
})

// ? masih banyak config lain, silahkan baca di [https://vite.dev/config/]