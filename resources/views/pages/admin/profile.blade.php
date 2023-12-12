@extends('layouts.main')
@section('content')
<div class="h-full w-full p-3 flex gap-1 relative overflow-hidden">
    <prof-component></prof-component>
    <!-- <div class="w-[350px] h-full flex flex-col border p-5 ">
        <div class="h-[180px] w-full  flex items-center">
            @if (Auth::user()->image != '')
                <div class="flex items-center gap-2">
                    <a class="bg-slate-700 w-24 h-24 rounded-md flex items-center justify-center relative shadow">
                        <img src="{{ asset('images/'. $user->image) }}" class="object-cover w-full h-full rounded-md">
                        <div id="show"  class="bg-[#00B0F0]/10 cursor-pointer hover:bg-[#00B0F0]/20 group transition w-full h-10 absolute bottom-0 right-0 flex items-center justify-center text-white">
                            <span class="material-symbols-outlined text-gray-50 group-hover:text-gray-100">
                                photo_camera
                            </span>
                        </div>
                    </a>
                <div class="flex flex-col gap-1">
                    <span class="font-bold text-lg text-gray-500">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                    <span class="text-xs text-gray-300 font-bold">School ID:  {{ $user->school_id }}</span>
                </div>
            </div>
            @else
                <div class="flex items-center gap-2">
                        <div class="bg-slate-700 w-24 h-24 rounded-md flex items-center justify-center relative">
                            <span class="text-white font-bold text-6xl">{{ $user->first_name[0] }}</span>
                            <div id="show" class="bg-[#00B0F0]/10 hover:bg-[#00B0F0]/20 group transition w-full h-10 rounded-br-md rounded-bl-md absolute bottom-0 right-0 flex items-center justify-center text-white">
                                <span class="material-symbols-outlined text-gray-50 group-hover:text-gray-100">
                                    photo_camera
                                </span>
                            </div>
                        </div>
                    <div class="flex flex-col gap-1">
                        <span class="font-bold text-lg text-gray-500">{{ $user->last_name }} {{ $user->first_name }} {{ $user->middle_name[0] }}.</span>
                        <span class="text-xs text-gray-300 font-bold">School ID:  {{ $user->school_id }}</span>
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
                        <div class="w-28 flex-shrink-0"><span class="font-semibold text-gray-400">Email:</span></div>
                        <div class="flex-1 flex"><span class="text-gray-400 font-bold">{{ $user->email }}</span></div>
                    </li>
                    <li class="flex">
                        <div class="w-28 flex-shrink-0"><span class="font-semibold text-gray-400">Gender:</span></div>
                        <div class="flex-1 flex"><span class="capitalize text-gray-400 font-bold">{{ $user->gender }}</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
     <div class="flex-1 flex flex-col gap-1">
        <div class="flex-1 border">
            <x-personal-information :personalInfo="$personalInfo" :user="$user" />
        </div>
        <div class="flex-1 border">
            <x-contact-information :contactInfo="$contactInfo" :user="$user" />
        </div>
    </div>
    <div class="bg-gray-500/60 w-full absolute h-full hidden" id="showForm">

        <x-change_photo/>
    </div> -->
</div>
@endsection

@section('scripts')
{{-- <script src="{{ asset('js/fetch_single_data.js') }}"></script> --}}
@endsection



