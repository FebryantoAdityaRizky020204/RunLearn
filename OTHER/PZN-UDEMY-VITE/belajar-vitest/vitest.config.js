import { defineConfig } from "vite";

export default defineConfig({
    test: {
        dir: 'tests', // ? file unit test yang dijalankan hanya yg didalam folder tests
        globals: true, // ? vitest terdaftar di global scope
        coverage: {
            provider: 'istanbul', // ? mengganti provider coverage, default v8
        }
    }
});