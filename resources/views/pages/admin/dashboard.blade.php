@extends('layouts.main')

@section('content')

<div class="h-full w-full flex flex-col p-12 px-20  lg:p-0 lg:px-10">
    <div class="h-full flex flex-col">
        <div class="flex items-center justify-between h-[100px] relative ">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-gray-400 text-5xl lg:text-3xl">
                    dashboard
                </span>
                <h1 class="text-3xl font-bold text-gray-400 lg:text-2xl">Dashboard </h1>
            </div>
        </div>
        <dashboard-component></dashboard-component>
    </div>
</div>

@endsection
