@extends('layouts.main')

@section('content')
    <div class="h-full w-full p-3">

        <div class="h-full flex flex-col">
            <div class="h-[300px] flex gap-5">
                <div class="flex-1 flex flex-col">
                    <div class="flex items-end h-[87px]">
                        <div class="flex items-center">
                            <span class="material-symbols-outlined text-gray-400 text-5xl">
                                dashboard
                            </span>
                            <h1 class="text-3xl font-bold text-gray-400">Dashboard</h1>
                        </div>
                        <div class="flex-1 flex items-center justify-end">
                            <a href="#" class="bg-[#00B0F0] py-3 px-5 focus:ring-1 text-white font-bold capitalize text-sm rounded-md hover:bg-[#00B0F0]/90" id="timeIn">add time</a>
                        </div>
                    </div>
                    <div class="flex-1 flex gap-7 pt-7">
                        <div class="bg-[#92D050] flex-nowrap flex-1 flex items-center justify-start pl-10 gap-2">
                            <div class="w-28 h-28 flex items-center justify-center border-4 border-white flex-shrink-0">
                                <span class="material-symbols-outlined text-white text-7xl">
                                    timer
                                </span>
                            </div>
                            <div class="flex flex-col">
                                {{-- <h2 class="text-5xl font-bold text-white">{{ $activeCount }}</h2> --}}
                                <span class="font-semibold text-white text-3xl mb-2">Attendance</span>
                                <span class="text-white text-xs font-semibold">Total Time In: {{ $attendanceIn->count() }}</span>
                                <span class="text-white text-xs font-semibold">Total Time Out: {{ $attendanceOut->count() }}</span>
                            </div>
                        </div>
                        <div class="bg-[#00B0F0] flex-nowrap flex-1 flex items-center justify-start pl-10 gap-2">
                            <div class="w-28 h-28 flex items-center justify-center border-4 border-white flex-shrink-0">
                                <span class="material-symbols-outlined text-white text-7xl">
                                    how_to_reg
                                </span>
                            </div>
                            <div class="flex flex-col">
                                {{-- <h2 class="text-5xl font-bold text-white">{{ $activeCount }}</h2> --}}
                                <span class="font-semibold text-white text-3xl mb-2">Your Status</span>
                                <span class="text-white text-xs font-semibold capitalize">Department: {{ Auth::user()->department }}</span>
                                <span class="text-white text-xs font-semibold capitalize">Position: {{ Auth::user()->position }}</span>
                            </div>
                        </div>
                        <div class="bg-[#FD9913] flex-nowrap flex-1 flex items-center justify-start pl-10 gap-2">
                            <div class="w-28 h-28 flex items-center justify-center border-4 border-white flex-shrink-0">
                                <span class="material-symbols-outlined text-white text-7xl">
                                    event_available
                                </span>
                            </div>
                            <div class="flex flex-col">
                                {{-- <h2 class="text-5xl font-bold text-white">{{ $activeCount }}</h2> --}}
                                <span class="font-semibold text-white text-3xl mb-2">Schedule</span>
                                <span class="text-white text-xs font-semibold">Day: Monday-Saturday</span>
                                <span class="text-white text-xs font-semibold">Day Off: Sunday</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- time in table  --}}
            <div class="flex-1 flex gap-10">
                <div class="flex-1 flex flex-col">
                    <div class="bg-white h-20 flex items-end">
                        <div class="flex-1 flex items-center">
                            <span class="material-symbols-outlined text-[#7F7F7F] text-5xl">
                                timer
                            </span>
                            <h2 class="text-2xl text-[#7F7F7F] font-semibold">Recent Time In</h2>
                        </div>
                    </div>
                    <div class="flex-1 py-2 flex flex-col gap-2">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-[#00B0F0] text-justify h-14">
                                <tr class="">
                                    <th class="text-white capitalize pl-5">date</th>
                                    <th class="text-white capitalize">day</th>
                                    <th class="text-white capitalize">time In</th>
                                </tr>
                            </thead>
                            <tbody class="">
                               @forelse ($attendanceIn as $timeIn)
                               <tr class="odd:bg-gray-100 even:bg-gray-50 h-14">
                                    <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ $timeIn->created_at->toDateString() }}</td>
                                   <td class="text-sm font-semibold text-slate-500 capitalize">{{ $timeIn->day }}</td>
                                   <td class="text-sm font-semibold text-slate-500 capitalize">{{ Carbon\Carbon::parse($timeIn->time)->format('h:i A') }}</td>
                                    {{-- button time out for user --}}
                               </tr>
                               @empty
                               <tr class="h-14 text-justify">
                                   <td class="text-gray-400 font-semibold">No available data right now.</td>
                                </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- time out table--}}
                <div class="flex-1 flex flex-col">
                    <div class="h-20 flex items-end">
                        <div class="flex-1 flex items-center">
                            <span class="material-symbols-outlined text-[#7F7F7F] text-5xl">
                                timer_off
                            </span>
                            <h2 class="text-2xl text-[#7F7F7F] font-semibold">Recent Time Out</h2>
                        </div>
                    </div>
                    <div class="flex-1 py-2 flex flex-col gap-2">
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-red-500 text-justify h-14">
                                <tr>
                                    <th class="text-white capitalize pl-5">date</th>
                                    <th class="text-white capitalize">day</th>
                                    <th class="text-white capitalize">time out</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ($attendanceOut as $timeOff)
                                <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                    <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ $timeOff->created_at->toDateString() }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ $timeOff->day }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ Carbon\Carbon::parse($timeOff->time)->format('h:i A') }}</td>
                                </tr>
                                @empty
                                    <tr class="h-14 text-justify">
                                         <td class="text-gray-400 font-semibold">No available data right now.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end">
                        <a href="{{ route('user.attendance') }}" class="text-[#00B0F0] font-semibold hover:underline">view summary</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- time in form --}}
    <div id="showTimeInForm" class="bg-gray-200/80 h-full fixed top-0 right-0 left-0 bottom-0 m-auto hidden justify-center items-center overflow-hidden">

        <div class="bg-white h-[450px] w-[700px] rounded-sm relative flex justify-center items-center">
            <img src="{{ asset('images/samson.png') }}" class="w-96 h-96a absolute top-0 left-0 bottom-0 right-0 m-auto opacity-5">
                {{-- time form --}}
            <div class="w-[600px] h-[400px] flex flex-col items-center justify-center z-10 p-10 py-24 relative">
                {{-- form time in  --}}
                <form id="send_form" action="{{ route('user.store.attendance') }}" method="POST" class="bg-[#00B0F0]/10 w-full h-full flex items-center justify-center flex-col gap-3 rounded-sm flex-shrink-0">
                    @csrf
                    <div>
                        <input type="text" name="time" class="text-center outline-none caret-sky-400 h-12" value="{{ Carbon\Carbon::parse($todayTime)->format('h:i A') }}">
                        <select name="day" class="outline-none h-12 w-24 p-2">
                            <option selected disabled>Day</option>
                            @foreach (App\Enums\Days::cases() as $day)
                            <option value="{{ $day->value }}">{{ $day->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-[18.8rem]">
                        <select name="time_status" class="outline-none h-12 w-full">
                            <option selected disabled>Status</option>
                            <option value="Time In">Time In</option>
                            <option value="Time Out">Time Out</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit" class="focus:ring-2 rounded-md btn btn-success w-[280px] bg-[#00B0F0] hover:bg-[#00B0F0]/90">save</button>
                    </div>
                </form>
                {{-- validation error time in form --}}
                <div class="flex items-center justify-center w-full mt-10">
                    <span class="text-gray-400 text-sm font-semibold" id="message"></span>
                </div>
                <div class="bg-[#00B0F0] w-[400px] h-[80px] absolute -top-16 rounded-md  flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-white text-5xl">
                        timer
                    </span>
                    <span class="capitalize text-white text-3xl font-bold">time form</span>

                </div>
            </div>

            </div>
        </div>

        <a id="timeInCancelBtn" href="#" class="material-symbols-outlined absolute right-5 top-5 text-gray-500 hover:text-gray-400 hidden">
            close
        </a>
    </div>

@endsection

@section('scripts')
<script src="{{ asset('js/store_time.js') }}"></script>
{{-- <script src="{{ asset('js/end_time.js') }}"></script> --}}
@endsection

