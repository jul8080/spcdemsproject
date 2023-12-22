@extends('layouts.main')

@section('content')

<div class="h-full w-full flex flex-col desktop:p-12 laptop:p-3 desktop:px-20">
    <div class="h-full flex flex-col">
        <div class="flex items-center justify-between h-[100px] relative ">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-gray-400 desktop:text-3xl laptop:2xl">
                    dashboard
                </span>
                <h1 class="desktop:text-2xl laptop:text-2xl font-semibold text-gray-400">Dashboard </h1>
            </div>
        </div>
        <userdashboard-component></userdashboard-component>
    </div>
</div>

@endsection

