@extends('layouts.main')

@section('content')

    <div class="h-full w-full p-14 px-32">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-400 desktop:text-3xl laptop:2xl">
                            sync_lock
                        </span>
                    <h1 class="desktop:text-2xl laptop:text-2xl font-semibold text-gray-400">Reset User Password</h1>
                </div>
            </div>
            <resetpassword-component></resetpassword-component>
            <!-- Vue component here.. -->
        </div>

    </div>

@endsection