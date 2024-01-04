/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Alpine from "alpinejs";
import mask from "@alpinejs/mask";
import Precognition from "laravel-precognition-alpine";
Alpine.plugin(mask);
Alpine.plugin(Precognition);

window.Alpine = Alpine;
Alpine.start();
