/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ScannerComponent from './components/ScannerComponent.vue';
import AttendanceComponent from './components/admin/AttendanceComponent.vue';
import EmployeeComponent from './components/admin/EmployeeComponent.vue';
app.component('scanner-component', ScannerComponent);
app.component('attendance-component', AttendanceComponent);
app.component('employee-component', EmployeeComponent);

app.mount('#app');
