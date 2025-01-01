import './bootstrap';
import { Chart, registerables } from 'chart.js';
import 'chartjs-adapter-luxon';
import Alpine from 'alpinejs';

Chart.register(...registerables);

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.start();
