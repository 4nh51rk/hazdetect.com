import { defineConfig } from "vite";
import { resolve } from "path";
import vue from "@vitejs/plugin-vue";

export default defineConfig(({ command }) => ({
    base: command === "serve" ? process.env.ASSET_URL || "" : `${process.env.ASSET_URL || ""}/build/`,
    publicDir: false,
    build: {
        manifest: true,
        outDir: "public/build",
        rollupOptions: {
            input: "resources/js/app.js",
        },
    },
    resolve: {
        alias: {
            "@": resolve(__dirname, "resources/js"),
            "/images": resolve(__dirname, "resources/images"),
        },
    },
    plugins: [vue()],
    server: { fs: { allow: [`${process.cwd()}`] }, port: process.env?.VITE_PORT ?? 3000 },
}));
