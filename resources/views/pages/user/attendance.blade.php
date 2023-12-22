@extends('layouts.main')
@section('content')
<div class="h-full w-full flex flex-col desktop:p-10 laptop:p-3 desktop:px-32">
    <div class="flex items-center justify-start h-[100px] laptop:mt-20">
        <span class="material-symbols-outlined text-gray-400 desktop:text-3xl laptop:2xl" id="btn">
            calendar_apps_script
        </span>
        <h1 class="desktop:text-2xl laptop:text-2xl font-semibold text-gray-400">My Attendance</h1>
    </div>
    <logs-component></logs-component>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection
