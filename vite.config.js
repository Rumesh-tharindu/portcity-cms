import { defineConfig } from 'vite'
import inject from '@rollup/plugin-inject'
import laravel from 'laravel-vite-plugin'
import path from 'path'

// export default defineConfig({
//     plugins: [
//         laravel([
//             'resources/js/app.js',
//         ]),
//         {
//             name: 'blade',
//             handleHotUpdate({ file, server }) {
//                 if (file.endsWith('.blade.php')) {
//                     server.ws.send({
//                         type: 'full-reload',
//                         path: '*',
//                     });
//                 }
//             },
//         }
//     ],

// });

export default defineConfig({
    plugins: [
        inject({
            jQuery: 'jquery',
            $: 'jquery',
            Swiper: 'swiper'
        }),            
        laravel([
            'resources/js/app.js',
        ]),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }               
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap/dist/js/bootstrap.min.js'),
        }
    },     
});
