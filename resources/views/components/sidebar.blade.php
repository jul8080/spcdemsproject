<div class="desktop:w-[300px] laptop:w-full h-full overflow-y-auto flex flex-col flex-shrink-0">

    {{-- sidebar logo  --}}

    <div class="bg-white w-full h-[200px] flex items-center justify-center border-gray-50">
        <div class="w-full h-full">
            <img loading="lazy" src="{{ asset('images/logo-2.png') }}" class="w-full h-full object-contain">
        </div>
    </div>

    {{-- sidebar nav links --}}

    <div class="h-full w-full">
        <nav class="h-full w-full -mt-[30px]">
            <h2 class="uppercase font-bold text-gray-400 pl-5 pt-10 laptop:text-sm desktop:text-base">general</h2>
            @if (Auth::user()->role_as == 'admin')
            <ul class="w-full">
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-100 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">dashboard</span>
                    </a>
                </li>
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.employee') }}" class="flex items-center gap-[.3rem] hover:bg-gray-100 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            group
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">employees</span>
                    </a>
                </li>
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.attendance') }}" class="flex items-center gap-[.3rem] hover:bg-gray-100 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            calendar_apps_script
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">attendance</span>
                    </a>
                </li>
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.reset_password') }}" class="flex items-center gap-[.3rem] hover:bg-gray-100 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            sync_lock
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">Reset Password</span>
                    </a>
                </li>
            </ul>
            @else
            {{-- user sidebar --}}
            <ul class="">
                @if (Auth::user()->role_as == 'admin')
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">dashboard</span>
                    </a>
                </li>
                @else
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            dashboard
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">dashboard</span>
                    </a>
                </li>
                @endif
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('user.attendance') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            calendar_apps_script
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">my attendance</span>
                    </a>
                </li>

                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('user.profile') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            account_box
                        </span>
                        <span class="capitalize text-gray-400 font-semibold laptop:text-sm desktop:text-base">my profile</span>
                    </a>
                </li>

            </ul>
            @endif

        </nav>
    </div>

    {{-- sidebar user  --}}

    <div class="h-[100px] flex items-center desktop:pl-5 laptop:pl-2 whitespace-nowrap  border-gray-100">
        <!-- user and admin image starts here -->
        @if (Auth::user()->role_as == 'admin')
        <adminimage-component></adminimage-component>
        @else
        <userimage-component></userimage-component>
        @endif
        <!-- user and admin image ends here -->
        <div class="flex-1 ml-2 -space-y-1 w-[100px]">
            @if (Auth::user()->role_as == 'admin')
            <a href="{{ url('admin/profile') }}" class="font-semibold hover:underline capitalize laptop:text-xs desktop:text-sm">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
            <a href="{{ route('admin.profile.settings') }}" class="flex items-center group hover:underline w-14">
                <span class="text-xs">{{ Auth::user()->role_as }}</span>
                <img src="{{ asset('images/settings.png') }}" class="w-[.60rem] h-[.60rem] ml-2">
            </a>
            @else
            <a class="font-semibold capitalize laptop:text-xs desktop:text-sm">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a>
            <a href="{{ route('user.profile.settings') }}" class="flex items-center group hover:underline w-14">
                <span class="text-xs">{{ Auth::user()->role_as }}</span>
                <img src="{{ asset('images/settings.png') }}" class="w-[.60rem] h-[.60rem] ml-2">
            </a>
            @endif
        </div>
        <div class="flex justify-end desktop:pr-3 laptop:pr-0 group">

            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full">
                    <span class="material-symbols-outlined self-end hover:text-slate-900 text-slate-500 text-base">logout</span></a>
                </button>
            </form>

        </div>
    </div>
</div>
<component :is="'script'">
    const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a').forEach(link => {
        if(link.href.includes(`${activePage}`)) {
            link.classList.add('active')
        }
    })
</component>