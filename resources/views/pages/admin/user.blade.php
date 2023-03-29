@extends('layouts.main')

@section('content')

    <div class="h-full w-full p-14 px-32 relative overflow-hidden">

        <div class="h-full flex flex-col ">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-400 text-5xl">
                        person
                    </span>
                    <h1 class="text-3xl font-bold text-gray-400">User Management</h1>
                </div>
            </div>
            {{-- table --}}
            <div class="flex-1 flex flex-col">
                <div class="h-[80px] w-full flex items-center">
                    <form action="#" method="GET" class="w-full flex justify-between items-center">
                        <div class="flex items-center">
                            <button class="bg-[#00B0F0] py-2 px-3 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined rotate-90">
                                    search
                                </span>
                            </button>
                            <input type="text" placeholder="search" class="outline-none w-72 py-2 px-3 bg-gray-100 caret-[#00B0F0]">
                        </div>
                        <div>
                            {{-- <a href="{{ route('admin.create.employee') }}" class="btn btn-border rounded-md focus:ring-2">+ Add Employee</a><a href="#"></a> --}}
                            <a href="#" class="btn btn-border rounded-md focus:ring-2" id="add-employee">+ Add Employee</a>
                        </div>
                    </form>
                </div>
                <div class="flex-1">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-[#00B0F0] text-justify h-14">
                            <tr>
                                <th class="text-white capitalize pl-5">ID</th>
                                <th class="text-white capitalize">Name</th>
                                <th class="text-white capitalize">Email</th>
                                <th class="text-white capitalize">Gender</th>
                                <th class="text-white capitalize">Entry level</th>
                                <th class="text-white capitalize">role</th>
                                {{-- <th class="text-white capitalize"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" id="sid{{ $user->id }}">
                                <td class="text-sm font-semibold text-slate-500 capitalize pl-5">
                                    {{ $user->school_id }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">
                                    {{ $user->last_name }}
                                    {{ $user->first_name }}
                                    {{ $user->middle_name[0] }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500">
                                    {{ $user->email }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize ">
                                    {{ $user->gender }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize ">
                                    {{ $user->entry_level }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500">
                                    @if ($user->role_as == 'admin')
                                    <div class="bg-green-300 w-16 h-9 flex items-center justify-center">
                                        <span class="text-white lowercase">{{ $user->role_as }}</span>
                                    </div>
                                    @else
                                    <div class="bg-red-400 w-16 h-9 flex items-center justify-center">
                                        <span class="text-white lowercase">{{ $user->role_as }}</span>
                                    </div>
                                    @endif

                                </td>
                                {{-- <td>
                                    <a href="javascript:void(0)" onclick="editEmployee({{ $user->id }})" class="material-symbols-outlined text-[#00B0F0]" id="show-wrapper">
                                        edit_square
                                    </a>
                                </td> --}}
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

            {{-- user permission form --}}
            <div class="bg-gray-500/50 h-full w-full absolute left-0 top-0 hidden items-center justify-center" id="wrapper">
                {{-- <x-user-permission data="wrapper" /> --}}
                <div class="w-[500px] bg-white flex flex-col rounded-md">
                    <div class="border-b-[1px] h-14 flex items-center justify-between px-5">
                        <span class="self-center text-gray-400 text-2xl font-semibold">User assign permission</span>
                        <div class="bg-gray-50 w-8 h-8 rounded-full flex items-center justify-center group hover:bg-gray-100">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-400" id="close-wrapper">
                                close
                            </span>
                        </div>
                    </div>
                    <form id="employeeForm" action="/admin/user/store" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id">
                        <div class="w-full flex items-center justify-center">
                            <span id="success" class="text-xs mt-2 text-green-500"></span>
                            <span id="fail" class="text-xs mt-2 text-red-500"></span>
                        </div>
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="role_as" id="role_as" class="text-gray-400 font-semibold">User role</label>
                            <div>
                                <a class="text-[#00B0F0]" class="cursor-pointer hover:underline" id="role-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="role-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center justify-center flex-col overflow-hidden" id="change-role">
                            {{-- <select name="role" id="role_as" class="w-96 h-14 px-5 outline-none bg-gray-50">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select> --}}
                            <input type="text" id="role" name="role_as" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">

                        </div>

                        {{-- entry level edit --}}
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="entry_level" id="entry_level" class="text-gray-400 font-semibold">Entry leve</label>
                            <div>
                                <a type="submit" class="text-[#00B0F0]" id="entry-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="entry-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center flex-col justify-center overflow-hidden" id="change-entry">
                            {{-- <select name="entry_level" id="entry_level" class="w-96 h-14 px-5 outline-none bg-gray-50">
                                <option value="regular" value="">regular</option>
                                <option value="trainee">trainee</option>
                            </select> --}}
                            <input type="text" id="entry" name="entry_level" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>
                        <div class="w-full text-end h-10 hidden overflow-hidden px-[3.7rem]" id="close-container">
                            <a class="text-red-400 font-semibold" id="close-form">cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white shadow w-[500px] h-full absolute top-0 -right-[50rem] overflow-x-hidden" id="registration-wrapper">
            <x-user-registration wrapper="wrapper" />
        </div>
    </div>

@endsection
@section('scripts')
<script src="{{ asset('js/permission-form.js') }}"></script>
<script src="{{ asset('js/user-registration.js') }}"></script>

<script>
    function editEmployee(id) {
        $.get('/admin/user/edit/'+id, function(employee){

           $('#id').val(employee.id);
           $('#role').val(employee.role_as);
           $('#entry').val(employee.entry_level);
           $('#wrapper').css({'display':'flex'});
        });
    }

    $('#employeeForm').on('submit', function (e) {
        e.preventDefault()
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            cache: false,
            dataType: "json",
            contentType: false,

            success: function (data) {
                console.log(data.status);
                if(data.status === 1)
                {
                    console.log(data.success)

                    $('#success').html(data.success);
                    $('#fail').html('');
                    setTimeout(() => {
                        $('#success').html('');
                    }, 5000);
                } else {
                    console.log(data.fail)
                    $('#fail').html(data.fail);
                    $('#success').html('');
                    setTimeout(() => {
                        $('#fail').html('');
                    }, 5000);
                }
            }
        });
    })


</script>

@endsection
