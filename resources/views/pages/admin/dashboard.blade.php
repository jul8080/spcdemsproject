@extends('layouts.main')

@section('content')

<div class="h-full w-full p-3 flex flex-col">
    <div class="h-full flex flex-col">
        <div class="flex items-center justify-between h-[100px] relative ">
            <div class="flex items-center">
                <span class="material-symbols-outlined text-gray-400 text-5xl">
                    dashboard
                </span>
                <h1 class="text-3xl font-bold text-gray-400">Dashboard </h1>
            </div>
        </div>

        <div class="w-full flex-1 flex gap-2 ">

            <div class=" flex-1">
                <div class="h-60 flex gap-2">
                    <div class="bg-[#00B0F0] flex-nowrap flex-1 flex items-center justify-center gap-2">

                        <div class="w-24 h-24 flex items-center justify-center border-4 border-white">
                            <span class="material-symbols-outlined text-white text-7xl">
                                groups
                            </span>
                        </div>
                        <div>
                            <h2 class="text-5xl font-bold text-white">{{ $users->count() }}</h2>
                            <span class="text-xs font-semibold text-white">Total Employees</span>
                        </div>

                    </div>

                    <div class="bg-[#92D050] flex-nowrap flex-1 flex items-center justify-center gap-2">

                        <div class="w-24 h-24 flex items-center justify-center border-4 border-white">
                            <span class="material-symbols-outlined text-white text-7xl">
                                group_add
                            </span>
                        </div>
                        <div>
                            <h2 class="text-5xl font-bold text-white">{{ $newUserCount }}</h2>
                            <span class="text-xs font-semibold text-white">New Employees</span>
                        </div>

                    </div>

                    <div class="bg-[#FD9913] flex-nowrap flex-1 flex items-center justify-center gap-2">
                        <div class="w-24 h-24 flex items-center justify-center border-4 border-white flex-shrink-0">
                            <span class="material-symbols-outlined text-white text-7xl">
                                safety_divider
                            </span>
                        </div>
                        <div class="flex flex-col">
                            {{-- <h2 class="text-5xl font-bold text-white">{{ $activeCount }}</h2> --}}
                            {{-- <span class="font-semibold text-white text-2xl mb-2">Gender</span> --}}
                            <span class="text-white text-md font-bold">Male: {{ $male }}</span>
                            <span class="text-white text-md font-bold">Female: {{ $female }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex mt-5">
                    {{-- data table --}}
                    <div class="flex flex-col flex-1 p-10">
                        <h2 class="mb-4 mt-5 text-xl font-bold text-gray-400">New Employees</h2>
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-[#00B0F0] text-justify h-14">
                                <tr class="">
                                    <th class="text-white capitalize pl-5">ID</th>
                                    <th class="text-white capitalize">emplyee name</th>
                                    <th class="text-white capitalize">Gender</th>
                                    <th class="text-white capitalize">Department</th>
                                    <th class="text-white capitalize">Position</th>
                                    <th class="text-white capitalize">email</th>
                                    <th class="text-white capitalize"></th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($usersTable as $user)
                                <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify">
                                    <td class="text-sm font-semibold text-slate-500 capitalize pl-5">{{ $user->school_id }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize ">{{ $user->last_name }}, {{ $user->first_name }} {{ substr($user->middle_name, 0, 1) }}.</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ $user->gender }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ $user->department }}</td>
                                    <td class="text-sm font-semibold text-slate-500 capitalize">{{ $user->position }}</td>
                                    <td class="text-sm font-semibold text-slate-500">{{ $user->email }}</td>
                                    @if ($user->new_user == $today)
                                    <td><span class="bg-green-400 text-xs font-semibold text-white px-2 py-1">New</span></td>
                                    @else
                                    <td></td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-end items-end flex-col mt-2">
                            <a href="{{ route('admin.employee') }}" class="text-[#00B0F0] hover:underline font-semibold">view all</a>
                        </div>
                    </div>
                

                {{-- employee search  --}}
                <div class="h-[600px] w-72 overflow-y-auto self-end flex flex-col gap-2 border-[1px]" id="search-scrollbar">
                    <div class="w-full h-20 flex items-center px-2 flex-shrink-0 border-b-[1px]">
                        <div class="h-10 flex w-full items-center">
                            @csrf
                            <button disabled type="submit" class="w-12 flex items-center justify-center bg-[#00B0F0] h-full border border-[#00B0F0]">
                                <span class="material-symbols-outlined rotate-90 text-white">
                                    search
                                </span>
                            </button>

                            <input type="search" name="search" id="search" value="{{ request()->query('search') }}" class="py-2 pl-2 w-full outline-none border focus:border-[#00B0F0]" placeholder="search">
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 px-2 scrollbar" id="user">
                        @foreach ($users as $user)
                        <div class="h-[4.5rem] flex items-center gap-2 px-2">
                            @if ($user->image != '')
                            <div class="bg-slate-700 w-10 h-10 rounded-md border">
                                <img src="{{ asset('images/'.$user->image) }}" class="object-cover w-full h-full rounded-sm">
                            </div>
                            @else
                            <div class="bg-slate-700 w-10 h-10 rounded-md flex items-center justify-center">
                                <span class="text-white font-sans font-bold uppercase text-2xl">{{ substr($user->first_name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div class="flex-1 flex flex-col -space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-semibold capitalize">{{ $user->first_name }} {{ $user->last_name }}</span>
                                </div>
                                <a href="/admin/employee/{{ $user->id }}" class="text-xs text-sky-500 font-semibold">view</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $('body').on('keyup', '#search', function() {
        var searchEmployee = $(this).val();

        $.ajax({
            method: "POST",
            url: "/admin/search/user",
            dataType: "json",
            data: {
                '_token': '{{ csrf_token() }}',
                searchEmployee: searchEmployee
            },
            success: function(res) {
                // console.log(res);
                var tableRow = '';
                $('#user').html('');

                $.each(res, function(index, value) {
                    if (value.image != null) {
                        if (value.role_as == 'admin') {
                            tableRow = '<div class="h-[4.5rem] hidden items-center gap-2 px-2"><div class="bg-slate-700 w-10 h-10 rounded-md border"><img src="/images/' + value.image + '" class="object-cover w-full h-full"></div><div class="flex-1 flex flex-col -space-y-1 rounded-sm"><div class="flex items-center justify-between"><span class="font-semibold capitalize">' + value.first_name + ' ' + value.last_name + '</span></div><a class="text-xs text-sky-500 font-semibold">You</a></div></div>';
                            $('#user').append(tableRow);
                        } else {
                            tableRow = '<div class="h-[4.5rem] flex items-center gap-2 px-2"><div class="bg-slate-700 w-10 h-10 rounded-md border"><img src="/images/' + value.image + '" class="object-cover w-full h-full"></div><div class="flex-1 flex flex-col -space-y-1 rounded-sm"><div class="flex items-center justify-between"><span class="font-semibold capitalize">' + value.first_name + ' ' + value.last_name + '</span></div><a href="/admin/employee/' + value.id + '" class="text-xs text-sky-500 font-semibold">view</a></div></div>';
                            $('#user').append(tableRow);
                        }

                    } else {
                        if (value.role_as == 'admin') {
                            tableRow = '<div class="h-[4.5rem] hidden items-center gap-2 px-2"><div class="bg-slate-700 w-10 h-10 rounded-md flex items-center justify-center"><span class="text-white font-sans font-bold uppercase text-2xl">' + value.first_name[0] + '</span></div><div class="flex-1 flex flex-col -space-y-1"><div class="flex items-center justify-between"><span class="font-semibold capitalize">' + value.first_name + ' ' + value.last_name + '</span></div><a class="text-xs text-sky-500 font-semibold">You</a></div></div>';
                            $('#user').append(tableRow);
                        } else {
                            tableRow = '<div class="h-[4.5rem] flex items-center gap-2 px-2"><div class="bg-slate-700 w-10 h-10 rounded-md flex items-center justify-center"><span class="text-white font-sans font-bold uppercase text-2xl">' + value.first_name[0] + '</span></div><div class="flex-1 flex flex-col -space-y-1"><div class="flex items-center justify-between"><span class="font-semibold capitalize">' + value.first_name + ' ' + value.last_name + '</span></div><a href="/admin/employee/' + value.id + '" class="text-xs text-sky-500 font-semibold">view</a></div></div>';
                            $('#user').append(tableRow);
                        }


                    }
                });
            }
        });
    });
</script>
@endsection