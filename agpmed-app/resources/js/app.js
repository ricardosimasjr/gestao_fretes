import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import.meta.glob([
    '../images/**',
    '../storage/app/public/comprovantes/**',
]);
