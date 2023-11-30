@extends('layouts.main')

@section('content')

    <div class="h-full w-full p-14 px-32 relative overflow-hidden">

        <div class="h-full flex flex-col">
            <div class="flex items-center justify-between h-28">
                <div class="flex items-center">
                    <span class="material-symbols-outlined text-gray-400 text-5xl">
                        group
                    </span>
                    <h1 class="text-3xl font-bold text-gray-400">Employees</h1>
                </div>
            </div>
            {{-- table --}}
            <!-- <div class="flex-1 flex flex-col">
                <div class="h-[80px] w-full flex items-center justify-between">
                    <form action="{{ url('/admin/employee') }}" method="GET">
                        <div class="flex items-center">
                            <button type="submit" class="bg-[#00B0F0] py-2 px-3 text-white flex items-center justify-center">
                                <span class="material-symbols-outlined rotate-90">
                                    search
                                </span>
                            </button>
                            <input type="search" name="search" value="{{ request()->query('search') }}" placeholder="search" class="outline-none w-72 py-2 px-3 bg-gray-100 caret-[#00B0F0]">
                        </div>
                    </form>
                    <div>
                        {{-- <a href="{{ route('admin.create.employee') }}" class="btn btn-border rounded-md focus:ring-2">+ Add Employee</a><a href="#"></a> --}}
                        <a href="#" class="btn btn-border rounded-md focus:ring-2" id="add-employee">+ Add Employee</a>
                    </div>
                </div>
                <div class="flex-1">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-[#00B0F0] text-justify h-14">
                            <tr>
                                {{-- <th class="text-white capitalize"></th> --}}
                                <th class="text-white capitalize pl-5"></th>
                                <th class="text-white capitalize">ID</th>
                                <th class="text-white capitalize">Employee Name</th>
                                <th class="text-white capitalize">Gender</th>
                                <th class="text-white capitalize">Department</th>
                                <th class="text-white capitalize">Position</th>
                                <th class="text-white capitalize">Email</th>
                                <th class="text-white capitalize">Status</th>
                                <th class="text-white capitalize"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                            @forelse ($users as $user)

                            <tr class="odd:bg-gray-100 even:bg-gray-50 h-14 text-justify" id="sid{{ $user->id }}">
                                @if ($user->new_user == $todayDate)
                                <td class="pl-5">
                                <span class="bg-green-400 text-[.60rem] font-semibold text-white p-1">New</span>
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td class="text-sm font-semibold text-slate-500 capitalize">{{ $user->school_id ?? "not updated" }}</td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">
                                        {{ $user->last_name ?? "not updated" }}
                                        {{ $user->first_name ?? "not updated" }}
                                        {{ $user->middle_name[0] ?? "not updated" }}.
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">
                                    {{ $user->gender ?? "not updated" }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize">
                                    {{ $user->department ?? "not updated" }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize ">
                                    {{ $user->position ?? "not updated" }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500 capitalize ">
                                    {{ $user->email ?? "not updated" }}
                                </td>
                                <td class="text-sm font-semibold text-slate-500">
                                    @if ($user->employee_status == 'active')
                                    <span class="bg-green-300 py-2 px-[17.3px] text-xs text-white font-semibold capitalize">
                                        {{ $user->employee_status }}
                                    </span>
                                    @else
                                    <span class="bg-red-300 py-2 px-3 text-xs text-white font-semibold capitalize">
                                        {{ $user->employee_status }}
                                    </span>
                                    @endif

                                </td>
                                 <td>
                                    <a href="javascript:void(0)" onclick="editEmployee( '{{ $user->id }}' )" class="material-symbols-outlined text-[#00B0F0]" id="show-wrapper">
                                        edit_square
                                    </a>
                                </td>

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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->appends(['search'=>request()->query('search')])->links('pagination::tailwind') }}
                    </div>
                </div>
            </div> -->
            <employee-component date="{{ $todayDate }}"></employee-component>
            {{-- edit department & position --}}
            <!-- <div class="bg-gray-500/50 h-full w-full absolute left-0 top-0 hidden items-center justify-center" id="wrapper">
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
                        {{-- Status edit --}}
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="status" class="text-gray-400 font-semibold">Status</label>
                            <div>
                                <a class="text-[#00B0F0]" class="cursor-pointer hover:underline" id="status-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="status-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center justify-center flex-col overflow-hidden" id="change-status">
                            <input type="text" id="status" name="employee_status" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>
                        {{-- Department edit --}}
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="department" class="text-gray-400 font-semibold">Department</label>
                            <div>
                                <a class="text-[#00B0F0]" class="cursor-pointer hover:underline" id="role-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="role-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center justify-center flex-col overflow-hidden" id="change-role">
                            <input type="text" id="department" name="department" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>

                        {{-- Position edit --}}
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="position" class="text-gray-400 font-semibold">Position</label>
                            <div>
                                <a type="submit" class="text-[#00B0F0]" id="entry-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="entry-update">ok</button>
                            </div>
                        </div>

                        <div class="h-0 flex items-center flex-col justify-center overflow-hidden" id="change-entry">
                            <input type="text" id="position" name="position" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>
                        <div class="w-full text-end h-10 hidden overflow-hidden px-[3.7rem]" id="close-container">
                            <a class="text-red-400 font-semibold" id="close-form">cancel</a>
                        </div>
                    </form>
                </div>
            </div> -->
            {{-- edit department & position ends here--}}
        </div>

        {{-- registration from for employees --}}
        <!-- <div class="bg-white shadow w-[500px] h-full absolute top-0 -right-[50rem] overflow-x-hidden" id="registration-wrapper">
            <x-user-registration wrapper="wrapper" :todayDate="$todayDate" />
        </div> -->
        {{-- registration from for employees ends here--}}

    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/permission-form.js') }}"></script>
<script src="{{ asset('js/user-registration.js') }}"></script>
<script>
    function editEmployee(id) {
        $.get('/admin/user/edit/'+id, function(employee){
            // alert(employee.id)
           $('#id').val(employee.id);
           $('#status').val(employee.employee_status);
           $('#department').val(employee.department);
           $('#position').val(employee.position);
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
