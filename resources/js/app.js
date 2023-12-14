import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ScannerComponent from './components/ScannerComponent.vue';
// admin page component
import DashboardComponent from './components/admin/DashboardComponent.vue';
import AttendanceComponent from './components/admin/AttendanceComponent.vue';
import EmployeeComponent from './components/admin/EmployeeComponent.vue';
import ProfComponent from './components/admin/ProfComponent.vue'
// users page component
import LogsComponent from './components/users/LogsComponent.vue'
import ProfileComponent from './components/users/ProfileComponent.vue'
//admin and user image sidebar
import AdminimageComponent from './components/sidebarImage/AdminimageComponent.vue'
import UserimageComponent from './components/sidebarImage/UserimageComponent.vue'
app.component('scanner-component', ScannerComponent);
app.component('dashboard-component', DashboardComponent);
app.component('attendance-component', AttendanceComponent);
app.component('employee-component', EmployeeComponent);
app.component('logs-component', LogsComponent);
app.component('profile-component', ProfileComponent);
app.component('prof-component', ProfComponent);
app.component('adminimage-component', AdminimageComponent);
app.component('userimage-component', UserimageComponent);

app.mount('#app');
