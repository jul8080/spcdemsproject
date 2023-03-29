@extends('layouts.main')
@section('content')
<div class="h-full w-full flex flex-col gap-10 p-10 px-32">
    <div class="flex items-end h-[87px]">
        <span class="material-symbols-outlined text-gray-400 text-5xl" id="btn">
            calendar_apps_script
        </span>
        <h1 class="text-3xl font-bold text-gray-400">My Attendance Summary</h1>
    </div>
    <div class="flex-1 flex flex-col gap-3">

        {{-- filter by dates --}}
        <div class="h-14 flex  items-center justify-end">

           <form action="" method="GET" class="flex items-center gap-1">
                @csrf
                <div class="bg-re-500 h-9">
                    <input type="date" name="date" id="date" value="{{ Request::get('date') }}" class="px-2 outline-none h-full bg-gray-50">
                </div>
                <div class="flex items-center h-9">
                    <select name="time_status" id="status" class="outline-none bg-gray-50 h-full">
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
                        <th class="text-white capitalize pl-10">date</th>
                        <th class="text-white capitalize">day</th>
                        <th class="text-white capitalize">time</th>
                        <th class="text-white capitalize">status</th>
                    </tr>
                </thead>
                <tbody class="">
                    @if (count($attendances) > 0)
                    @forelse ($attendances as $attendance)
                    <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                        <td class="text-sm font-semibold text-slate-500 capitalize pl-10">{{ $attendance->created_at->toDateString()}}</td>
                        <td class="text-sm font-semibold text-slate-500 capitalize">{{ $attendance->day }}</td>
                        <td class="text-sm font-semibold text-slate-500 capitalize">{{ Carbon\Carbon::parse($attendance->time)->format('h:i A') }}</td>
                        @if ($attendance->time_status == 'Time In')
                        <td class="text-sm font-semibold text-slate-500 capitalize">
                            <span class="bg-green-300 py-2 px-[17.3px] text-xs text-white font-semibold">{{ $attendance->time_status}}</span>
                        </td>
                        @else
                        <td class="text-sm font-semibold text-slate-500 capitalize">
                            <span class="bg-red-300 py-2 px-3 text-xs text-white font-semibold">{{ $attendance->time_status}}</span>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr class="h-14 text-justify">
                        <td class="text-gray-400 font-semibold">No available data.</td>
                   </tr>
                    @endforelse
                    @else
                    <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                        <td class="text-gray-400 font-bold pl-5">Search not found.</td>
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
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('btn').click(function () {
        console.log(1)
    });
</script>
@endsection
