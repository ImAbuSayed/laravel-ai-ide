import './bootstrap';
import Alpine from 'alpinejs'
import hljs from 'highlight.js';

window.Alpine = Alpine
Alpine.start()

document.addEventListener('DOMContentLoaded', (event) => {
  document.querySelectorAll('pre code').forEach((el) => {
    hljs.highlightElement(el);
  });
});
