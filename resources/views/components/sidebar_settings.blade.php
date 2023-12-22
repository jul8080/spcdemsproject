<div class="bg-white desktop:w-[300px] laptop:w-[230px] h-full overflow-y-auto flex flex-col drop-shadow-md flex-shrink-0">

    @if (Auth::user()->role_as == 'admin')
    <div class="flex-1">
        <nav class="h-full">
            <h2 class="capitalize font-semibold text-gray-400 pl-5 pt-10 desktop:text-3xl laptop:text-lg">settings</h2>
            <ul class="mt-5">
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.profile.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            manage_accounts
                        </span>
                        <span class="capitalize text-gray-400 desktop:font-semibold laptop:text-sm desktop:text-base">Profile Management</span>
                    </a>
                </li>
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.personal.info.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            demography
                        </span>
                        <span class="capitalize text-gray-400 desktop:font-semibold laptop:text-sm desktop:text-base">personal information</span>
                    </a>
                </li>
                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.emergency.contact.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            contact_phone
                        </span>
                        <span class="capitalize text-gray-400 desktop:font-semibold laptop:text-sm desktop:text-base">Emergency contact</span>
                    </a>
                </li>

                <li class="h-14 flex items-center desktop:ml-5">
                    <a href="{{ route('admin.password.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                        <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                            lock_person
                        </span>
                        <span class="capitalize text-gray-400 desktop:font-semibold laptop:text-sm desktop:text-base">change password</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
       {{-- admin return button  --}}

        <div class="h-[100px] flex items-center pl-5 whitespace-nowrap border-t-[1px] border-gray-50">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 text-[#00B0F0] hover:text-[#00B0F0]/80">
                <span class="material-symbols-outlined ">
                    reply
                </span>
                <span class="">return</span>
            </a>
        </div>
    </div>
    @else
    {{-- user sidebar settings  --}}
    <div class="flex-1">
            <nav class="h-full">
                <h2 class="capitalize font-bold text-gray-400 pl-5 pt-10 desktop:text-3xl laptop:text-lg">settings</h2>
                <ul class="mt-5">
                    <li class="h-14 flex items-center desktop:ml-5">
                        <a href="{{ route('user.profile.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                            <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                                manage_accounts
                            </span>
                            <span class="capitalize text-gray-400 font-semibold desktop:font-semibold laptop:text-sm desktop:text-base">Profile Management</span>
                        </a>
                    </li>
                    <li class="h-14 flex items-center desktop:ml-5">
                        <a href="{{ route('user.personal.info.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                            <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                                demography
                            </span>
                            <span class="capitalize text-gray-400 font-semibold desktop:font-semibold laptop:text-sm desktop:text-base">personal information</span>
                        </a>
                    </li>
                    <li class="h-14 flex items-center desktop:ml-5">
                        <a href="{{ route('user.emergency.contact.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                            <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                                contact_phone
                            </span>
                            <span class="capitalize text-gray-400 font-semibold desktop:font-semibold laptop:text-sm desktop:text-base">Emergency contact</span>
                        </a>
                    </li>

                    <li class="h-14 flex items-center desktop:ml-5">
                        <a href="{{ route('user.password.settings') }}" class="flex items-center gap-[.3rem] hover:bg-gray-50 w-full h-full pl-5 rounded-tl-md rounded-bl-md">
                            <span class="material-symbols-outlined text-gray-400 laptop:text-lg desktop:text-xl">
                                lock_person
                            </span>
                            <span class="capitalize text-gray-400 font-semibold desktop:font-semibold laptop:text-sm desktop:text-base">change password</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        {{-- return button  --}}

        <div class="h-[100px] flex items-center pl-5 whitespace-nowrap border-t-[1px] border-gray-50">
            <a href="{{ route('user.dashboard') }}" class="flex items-center gap-1 text-[#00B0F0] hover:text-[#00B0F0]/80">
                <span class="material-symbols-outlined ">
                    reply
                </span>
                <span class="">return</span>
            </a>
        </div>
    </div>
    @endif



<script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
<script>
    $('nav ul li').click(function(e){
        $(this).addClass('active').siblings().removeClass('active');
    });

</script>
