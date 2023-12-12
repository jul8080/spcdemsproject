@extends('layouts.main')
@section('content')
<div class="h-full w-full flex flex-col gap-10 p-10 px-32">
    <div class="flex items-end h-[87px]">
        <span class="material-symbols-outlined text-gray-400 text-5xl" id="btn">
            calendar_apps_script
        </span>
        <h1 class="text-3xl font-bold text-gray-400">My Attendance Summary</h1>
    </div>
    <logs-component></logs-component>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection
