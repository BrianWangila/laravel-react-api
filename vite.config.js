import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});


// import reactRefresh from '@vitejs/plugin-react-refresh';
// import { defineConfig } from 'vite'
// import react from '@vitejs/plugin-react'
// import laravel from 'laravel-vite-plugin';

// export default defineConfig(({ command }) => ({
//     base: command === 'serve' ? '' : '/build/',
//     publicDir: 'fake_dir_so_nothing_gets_copied',
//     build: {
//         manifest: true,
//         outDir: 'public/build',
//         rollupOptions: {
//             input: 'resources/js/app.jsx',
//             // plugins: [jsx()]
//         },
//     },
//     // esbuild: {
//     //     loader: { 
//     //         '.js': 'jsx',
//     //     }
//     // },
//     plugins: [
//         laravel({
//             input: [
//                 'resources/sass/app.scss',
//                 'resources/js/app.js',
//                 'resources/css/app.css'
//             ],
//             refresh: true,
//         }),
//         reactRefresh({
//             jsx: 'React',
//         }),
//         react(),
//     ],
// }));


// import reactRefresh from '@vitejs/plugin-react-refresh';


// export default ({ command }) => ({
//     base: command === 'serve' ? '' : '/build/',
//     publicDir: 'fake_dir_so_nothing_gets_copied',
//     build: {
//         manifest: true,
//         outDir: 'public/build',
//         rollupOptions: {
//             input: 'resources/js/app.js',
//         },
//     },
//     plugins: [
//         reactRefresh(),
//     ],
// });



// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//   plugins: [
//     // Laravel Vite Plugin for Laravel asset compilation
//     laravel({
//       input: [
//         // 'resources/sass/app.scss',  // Input SCSS file
//         'resources/js/app.jsx',      // Input JS file (React components)
//         'resources/css/app.css'     // Additional input CSS file
//       ],
//       refresh: true,               // Enable HMR (Hot Module Replacement)
//     }),
//   ],
//   resolve: {
//     alias: {
//       // Define aliases to resolve module paths easily
//       'react': 'react',                     // Alias for React
//       'react-dom': 'react-dom',             // Alias for React DOM
//       '@': '/resources/js',                 // Define the alias for the 'resources/js' directory
//     },
//   },
// });
