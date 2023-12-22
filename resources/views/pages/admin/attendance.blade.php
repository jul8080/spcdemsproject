@extends('layouts.main')

@section('content')

    <div class="h-full w-full desktop:p-14 desktop:px-32 laptop:p-1">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28 laptop:pl-5">
                <div class="flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-400 desktop:text-3xl laptop:2xl">
                        calendar_apps_script
                    </span>
                    <h1 class="desktop:text-2xl laptop:text-2xl font-semibold text-gray-400">Attendance</h1>
                </div>
            </div>
            <attendance-component></attendance-component>
        </div>

    </div>

@endsection
