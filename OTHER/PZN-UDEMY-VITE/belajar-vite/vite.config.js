import { defineConfig } from 'vite'

export default defineConfig({
    build: {
        outDir: 'production', // ? mengubah nama filder build dari dist menjadi production
        rollupOptions: {
            input: { // ? menambahkan multi-page app
                index: 'index.html', // ? defaultnya cuman ini
                about: 'about.html', // ? untuk halaman about
                contact: 'other/contact.html' // ? untuk halaman contact
            }
        }
    },
    server: {
        port: 5173 // ? mengubah port menjadi localhost:3000
    }
})

// ? masih banyak config lain, silahkan baca di [https://vite.dev/config/]