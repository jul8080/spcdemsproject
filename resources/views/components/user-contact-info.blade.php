<div class="w-full h-full p-3 relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-3xl text-gray-400">
                contact_phone
            </span>
            <h1 class="font-semibold text-2xl text-gray-400">Emergency Contact</h1>
        </div>
    </div>
    <div class="flex h-[500px]">
        <ul class="mt-10 flex flex-col gap-5 flex-1">
            <li class="flex items-center laptop:gap-5">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Full name:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400 laptop:text-sm">
                        {{ $user->emergencytContactInformation->last_name ?? "" }}
                        {{ $user->emergencytContactInformation->first_name ?? "" }}
                        {{ $user->emergencytContactInformation->middle_name ?? "" }}
                    </span></div>
            </li>
            <li class="flex items-center laptop:gap-5">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Address:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400 laptop:text-sm">
                        {{ $user->emergencytContactInformation->address ?? "" }}
                    </span>
                </div>
            </li>
            <li class="flex items-center laptop:gap-5">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Phone No:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400 laptop:text-sm">
                        {{ $user->emergencytContactInformation->phone_no ?? "" }}
                    </span>
                </div>
            </li>
            <li class="flex items-center laptop:gap-5">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Relationship:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400 laptop:text-sm">
                        {{ $user->emergencytContactInformation->relationship ?? "" }}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>