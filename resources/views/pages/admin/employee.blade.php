@extends('layouts.main')

@section('content')

    <div class="h-full w-full desktop:p-14 desktop:px-32 relative overflow-hidden laptop:p-1">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28 laptop:pl-5">
                <div class="flex items-center justify-center">
                    <span class="material-symbols-outlined text-gray-400 desktop:text-3xl laptop:2xl">
                        group
                    </span>
                    <h1 class="desktop:text-2xl laptop:text-2xl font-semibold text-gray-400">Employees</h1>
                </div>
            </div>
            <employee-component date="{{ $todayDate }}"></employee-component>
        </div>

    </div>
@endsection
