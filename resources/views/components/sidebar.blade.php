<div class="w-[300px] h-full overflow-y-auto flex flex-col flex-shrink-0">

    {{-- sidebar logo  --}}

    <div class="bg-white w-full h-[200px] flex items-center justify-center border-b-[1px] border-gray-50">
        <div class="w-full h-full">
            <img src="{{ asset('images/logo-trans-3.png') }}" class="w-full h-full object-cover">
        </div>
    </div>

    {{-- sidebar nav links --}}

    <div class="flex-1">
        <nav class="h-full -mt-[30px]">
            <h2 class="uppercase font-bold text-gray-400 pl-5 pt-10">general</h2>
            @if (Auth::user()->role_as == 'admin')
            <ul class="">
                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">dashboard</span>
                    </a>
                </li>
                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('admin.employee') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            group
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">employees</span>
                    </a>
                </li>
                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('admin.attendance') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            calendar_apps_script
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">attendance</span>
                    </a>
                </li>
            </ul>
            @else
            {{-- user sidebar --}}
            <ul class="">
                @if (Auth::user()->role_as == 'admin')
                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">dashboard</span>
                    </a>
                </li>
                @else
                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">dashboard</span>
                    </a>
                </li>
                @endif


                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('user.attendance') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            calendar_apps_script
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">my attendance</span>
                    </a>
                </li>

                <li class="h-14 flex items-center ml-5">
                    <a href="{{ route('user.profile') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400">
                            account_box
                        </span>
                        <span class="capitalize text-gray-400 font-semibold">my profile</span>
                    </a>
                </li>

            </ul>
            @endif

        </nav>
    </div>

    {{-- sidebar user  --}}

    <div class="h-[100px] flex items-center pl-5 whitespace-nowrap border-t-[1px] border-gray-50">
        <!-- user and admin image starts here -->
        @if (Auth::user()->role_as == 'admin')
            <adminimage-component></adminimage-component>
        @else
            <userimage-component></userimage-component>
        @endif
        <!-- user and admin image ends here -->
        <div class="flex-1 ml-2 -space-y-1">
            @if (Auth::user()->role_as == 'admin')
                <a href="{{ url('admin/profile') }}" class="font-semibold hover:underline capitalize">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                <a href="{{ route('admin.profile.settings') }}" class="flex items-center group hover:underline w-14">
                    <span class="text-xs">{{ Auth::user()->role_as }}</span>
                    <img src="{{ asset('images/settings.png') }}" class="w-[.60rem] h-[.60rem] ml-2">
                </a>
            @else
                <a class="font-semibold capitalize">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
                <a href="{{ route('user.profile.settings') }}" class="flex items-center group hover:underline w-14">
                    <span class="text-xs">{{ Auth::user()->role_as }}</span>
                    <img src="{{ asset('images/settings.png') }}" class="w-[.60rem] h-[.60rem] ml-2">
                </a>
            @endif
        </div>
        <div class="flex justify-end pr-3 group">

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full">
                    <span class="material-symbols-outlined self-end hover:text-slate-900 text-slate-500">logout</span></a>
                </button>
            </form>

        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>