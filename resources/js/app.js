import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ScannerComponent from './components/ScannerComponent.vue';
import QrcodeComponent from './components/QrcodeComponent.vue';
import AttendanceComponent from './components/admin/AttendanceComponent.vue';
import EmployeeComponent from './components/admin/EmployeeComponent.vue';

app.component('scanner-component', ScannerComponent);
app.component('qrcode-component', QrcodeComponent);
app.component('attendance-component', AttendanceComponent);
app.component('employee-component', EmployeeComponent);

app.mount('#app');
