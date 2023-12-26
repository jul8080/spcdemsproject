@extends('layouts.main')
@section('content')
<div class="h-full p-1 flex gap-1 relative overflow-hidden">
    <div class="desktop:w-[350px] laptop:w-[300px] h-full flex flex-col border p-5">
        <div class="h-[180px] w-full  flex items-center">
            @if ($user->image != '')
            <div class="flex items-center gap-2">
                <div class="bg-slate-700 w-[150px] desktop:w-[130px] laptop:h-[100px] desktop:h-[110px] rounded-md flex items-center justify-center shadow">
                    <img src="{{ asset('images/'. $user->image) }}" class="object-cover w-full h-full rounded-md">
                </div>
                <div class="flex flex-col gap-1">
                    <span class="font-semibold text-lg text-gray-500">{{ $user->last_name }} {{ $user->first_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                </div>
            </div>
            @else
            <div class="flex items-center gap-2">
                <div class="bg-slate-700 w-24 h-24 rounded-md items-center flex justify-center">
                    <div class="w-[150px] desktop:w-[130px] laptop:h-[100px] desktop:h-[110px] flex justify-center items-center">
                        <span class="text-white font-bold text-4xl capitalize">{{ $user->first_name[0] }}{{ $user->last_name[0] }}</span>
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-lg text-gray-500 capitalize">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                </div>
            </div>
            @endif
        </div>

        <div class="flex-1 flex flex-col">

            <div class="h-12 w-full flex items-center">
                <span class="material-symbols-outlined desktop:text-3xl text-gray-400">
                    account_box
                </span>
                <span class="font-semibold desktop:text-2xl text-gray-400">Profile Detail</span>
            </div>
            <div class="flex-1 pt-5 flex flex-col">
                <ul class="flex flex-col gap-5">
                    <li class="flex items-center laptop:gap-2">
                        <div class="desktop:w-28 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Email:</span></div>
                        <div class="flex"><span class="text-gray-400 laptop:text-sm">{{ $user->email }}</span></div>
                    </li>
                    <li class="flex items-center laptop:gap-2">
                        <div class="desktop:w-28 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Gender:</span></div>
                        <div class="flex"><span class="capitalize text-gray-400 laptop:text-sm">{{ $user->gender }}</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="flex-1 p-1 flex flex-col">
    <div class="flex-1 border">
        <x-user-information :user="$user" />
    </div>
    <div class="flex-1 border">
        <x-user-contact-info :user="$user" />
    </div>
</div>
</div>
@endsection