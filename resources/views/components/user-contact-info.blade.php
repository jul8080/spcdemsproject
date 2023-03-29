<div class="w-full h-full p-3 relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-5xl text-gray-400">
                contact_phone
            </span>
            <h1 class="font-bold text-3xl text-gray-400">Emergency Contact</h1>
        </div>
    </div>
    <div>
        <ul class="mt-10 flex flex-col gap-5">
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Full name:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">
                    {{ $user->emergencytContactInformation->last_name ?? "" }}
                    {{ $user->emergencytContactInformation->first_name ?? "" }}
                    {{ $user->emergencytContactInformation->middle_name ?? "" }}
                </span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Address:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400">
                        {{ $user->emergencytContactInformation->address ?? "" }}
                    </span>
                </div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Phone No:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400">
                        {{ $user->emergencytContactInformation->phone_no ?? "" }}
                    </span>
                </div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Relationship:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400">
                        {{ $user->emergencytContactInformation->relationship ?? "" }}
                    </span>
                </div>
            </li>
        </ul>
    </div>
</div>
