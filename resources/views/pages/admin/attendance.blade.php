@extends('layouts.main')

@section('content')

    <div class="h-full w-full p-14 px-32">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-400 text-5xl">
                        calendar_apps_script
                    </span>
                    <h1 class="text-3xl font-bold text-gray-400">Employee Attendance Summary</h1>
                </div>
            </div>
            {{-- table --}}
            <!-- <div class="flex-1 flex flex-col">
                <div class="h-[80px] w-full flex items-center justify-end">
                    {{-- <form action="{{ url('/admin/attendance') }}" method="GET" class="w-full flex justify-between items-center">
                        @csrf
                        <div class="flex items-center bg-red-500 h-9">
                            <button type="submit" class="bg-[#00B0F0] h-full w-10 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined rotate-90">
                                    search
                                </span>
                            </button>
                            <input type="search" name="search" value="{{ request()->query('search') }}" placeholder="search" class="outline-none w-72 h-full bg-gray-100 caret-[#00B0F0] px-2">
                        </div>
                    </form> --}}
                    <form action="" method="GET" class="flex items-center gap-1">
                        @csrf
                        <div class="bg-re-500 h-9">
                            <input type="date" name="date" id="date" value="{{ Request::get('date') }}" class="px-2 outline-none h-full bg-gray-50">
                        </div>
                        <div class="flex items-center h-9">
                            <select name="time_status" id="time_status" class="outline-none bg-gray-50 h-full">
                                <option disabled selected>Status</option>
                                <option value="all status" {{ Request::get('time_status') == 'all status' ? 'selected' : '' }}>All</option>
                                <option value="Time In" {{ Request::get('time_status') == 'Time In' ? 'selected' : '' }}>Time In</option>
                                <option value="Time Out" {{ Request::get('time_status') == 'Time Out' ? 'selected' : '' }}>TIme Out</option>
                            </select>
                            <button type="submit" class="focus:ring-1 bg-[#00B0F0] text-white text-xs h-full w-10 flex items-center justify-center font-semibold">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="flex-1">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-[#00B0F0] text-justify h-14">
                            <tr>
                                <th class="text-white capitalize pl-5"></th>
                                <th class="text-white capitalize">employee name</th>
                                <th class="text-white capitalize">Date</th>
                                <th class="text-white capitalize">Day</th>
                                <th class="text-white capitalize">time</th>
                                <th class="text-white capitalize">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($attendances) > 0)
                            @forelse ($attendances as $attendance)
                            <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                @if ($attendance->new_time == $todayDate)
                                <td class="pl-5">
                                <span class="bg-green-400 text-[.60rem] font-semibold text-white p-1">New</span>
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td class="text-sm font-semibold text-slate-500 capitalize">
                                    {{ $attendance->last_name }}
                                    {{ $attendance->first_name }}
                                    {{ $attendance->middle_name[0] }}.
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">{{ $attendance->created_at->toDateString() }}</td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">{{ $attendance->day }}</td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">{{ Carbon\Carbon::parse($attendance->time)->format('h:i A') }}</td>
                                @if ($attendance->time_status == 'Time In')
                                <td><span class="bg-green-300 py-2 px-[17.3px] text-xs text-white font-semibold">{{ $attendance->time_status }}</span></td>
                                @else
                                <td><span class="bg-red-300 py-2 px-3 text-xs text-white font-semibold">{{ $attendance->time_status }}</span></td>
                                @endif
                            </tr>
                            @empty
                            <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                <td>No data available.</td>
                            </tr>
                            @endforelse
                            @else
                            <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                <td class="text-gray-400 font-bold pl-5">Search not found.</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $attendances->appends(['date'=>request()->query('date'), 'time_status'=>request()->query('time_status')])->links('pagination::tailwind') }}
                    </div>
                </div>
            </div> -->
            <attendance-component></attendance-component>
        </div>

    </div>

@endsection
