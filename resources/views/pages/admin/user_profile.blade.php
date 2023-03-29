@extends('layouts.main')
@section('content')
<div class="h-full w-full p-3 flex gap-1 relative overflow-hidden">
    <div class="w-[350px] h-full flex flex-col border p-5 ">
        <div class="h-[180px] w-full  flex items-center">
            @if ($user->image != '')
                <div class="flex items-center gap-2">
                    <a class="bg-slate-700 w-24 h-24 rounded-md flex items-center justify-center shadow">
                        <img src="{{ asset('images/'. $user->image) }}" class="object-cover w-full h-full rounded-md">
                    </a>
                <div class="flex flex-col gap-1">
                    <span class="font-bold text-lg text-gray-500 whitespace-nowrap">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                    <span class="text-xs text-gray-300">School ID:  {{ $user->school_id }}</span>
                    @if ($user->role_as == 'admin')
                    <span class="mt-1 bg-[#00B0F0] self-start text-xs text-white rounded-sm font-semibold px-1 py-[0.15rem]">You</span>

                    @else
                        @if ($user->employee_status == 'active')
                        <span class="mt-1 bg-[#00B0F0] self-start text-xs text-white rounded-sm font-semibold px-1 py-[0.15rem]">{{ $user->employee_status }}</span>
                        @else
                        <span class="mt-1 bg-red-400 self-start text-xs text-white rounded-sm font-semibold px-1 py-[0.15rem]">{{ $user->employee_status }}</span>
                        @endif
                    @endif

                </div>
            </div>
            @else
                <div class="flex items-center gap-2">
                    <div class="bg-slate-700 w-24 h-24 rounded-md items-center flex justify-center">
                        <div class="w-16 h-16 flex justify-center items-start">
                            <span class="text-white font-bold text-6xl capitalize">{{ $user->first_name[0] }}</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-bold text-lg text-gray-500 capitalize">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                        <span class="text-xs text-gray-300">School ID:  {{ $user->school_id }}</span>
                        @if ($user->employee_status == 'active')
                        <span class="mt-1 bg-[#00B0F0] self-start text-xs text-white rounded-sm font-semibold px-1 py-[0.15rem]">{{ $user->employee_status }}</span>
                        @else
                        <span class="mt-1 bg-red-400 self-start text-xs text-white rounded-sm font-semibold px-1 py-[0.15rem]">{{ $user->employee_status }}</span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="flex-1 flex flex-col">

            <div class="h-12 w-full flex items-center">
                <span class="material-symbols-outlined text-3xl text-gray-400">
                    account_box
                </span>
                <span class="font-semibold text-2xl text-gray-400">Profile Detail</span>
            </div>
            <div class="flex-1 pt-5 flex flex-col">
                <ul class="flex flex-col gap-5">
                    <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="text-gray-400">Email:</span></div>
                        <div class="flex-1 flex"><span class="text-gray-400">{{ $user->email }}</span></div>
                    </li>
                    {{-- <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="font-semibold text-gray-400">Status:</span></div>
                        <div class="flex-1 flex"><span class="capitalize text-gray-400 font-bold">{{ $user->entry_level }}</span></div>
                    </li> --}}
                    <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="text-gray-400">Gender:</span></div>
                        <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $user->gender }}</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
     <div class="flex-1 flex flex-col gap-1">
        <div class="flex-1 border">
            <x-user-information :user="$user" />
        </div>
        <div class="flex-1 border">
            <x-user-contact-info :user="$user" />
        </div>
    </div>
    <div class="bg-gray-500/60 w-full absolute h-full hidden" id="showForm">

        <x-change_photo/>
    </div>
</div>
@endsection
