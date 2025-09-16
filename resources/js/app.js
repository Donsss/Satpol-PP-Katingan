import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'aos/dist/aos.css'; 
import 'lightbox2/dist/css/lightbox.min.css';
import 'lightbox2/dist/js/lightbox.min.js';
import AOS from 'aos';

AOS.init();