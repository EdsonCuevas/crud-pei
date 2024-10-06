import axios from 'axios';
window.axios = axios;
import $ from 'jquery';
window.jQuery = window.$ = $;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
