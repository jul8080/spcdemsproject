<div class="w-full h-full p-3 relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <span class="material-symbols-outlined text-5xl text-gray-400">
                demography
            </span>
            <h1 class="font-bold text-3xl text-gray-400">Personal Information</h1>
        </div>
    </div>
    <div class="flex gap-2">
        <ul class="flex-1 flex flex-col gap-5 mt-10">
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Full name:</span></div>
                <div class="flex-1 flex">
                    <span class="capitalize text-gray-400">
                        {{ $user->last_name }},
                        {{ $user->first_name }}
                        {{ $user->middle_name }}
                    </span>
                </div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Department:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $user->department ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Position:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $user->position ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Phone No:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $user->personalInformation->phone_no ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Address:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400">{{ $user->personalInformation->address ?? "" }}</span></div>
            </li>
        </ul>
        <ul class="flex-1 flex flex-col gap-5 mt-10">

            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Date of Birth:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400">{{ $user->personalInformation->dob ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Birth Place:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400">{{ $user->personalInformation->birth_place ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400" >Age:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400">{{ $user->personalInformation->age ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400" >Status:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400">{{ $user->personalInformation->status ?? "" }}</span></div>
            </li>
        </ul>
    </div>
</div>
