import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import Chart from 'chart.js/auto';

Alpine.plugin(focus);

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();
