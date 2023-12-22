@extends('layouts.main')

@section('content')

    <div class="h-full w-full p-14 px-32">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-400 text-5xl">
                            sync_lock
                        </span>
                    <h1 class="text-3xl font-bold text-gray-400">New Password</h1>
                </div>
            </div>
            <newpassword-component user-id="{{ $user->id }}"></newpassword-component>
            <!-- {{ $user->id }} -->
            <!-- Vue component here.. -->
        </div>

    </div>

@endsection