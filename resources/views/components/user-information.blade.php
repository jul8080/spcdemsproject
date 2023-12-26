<div class="w-full h-full p-3 relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <span class="material-symbols-outlined desktop:text-3xl text-gray-400">
                demography
            </span>
            <h1 class="font-semibold desktop:text-2xl laptop:text-base text-gray-400">Personal Information</h1>
        </div>
    </div>
    <div class="flex gap-2">
        <ul class="flex-1 flex flex-col gap-5 mt-10">
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Full name:</span></div>
                <div class="flex-1 flex ">
                    <span class="capitalize text-gray-400 laptop:text-sm">
                        {{ $user->last_name }},
                        {{ $user->first_name }}
                        {{ $user->middle_name }}
                    </span>
                </div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Position:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400 laptop:text-sm">{{ $user->position ?? "" }}</span></div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Phone No:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400 laptop:text-sm">{{ $user->personalInformation->phone_no ?? "" }}</span></div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Address:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400 laptop:text-sm">{{ $user->personalInformation->address ?? "" }}</span></div>
            </li>
        </ul>
        <ul class="flex-1 flex flex-col gap-5 mt-10">

            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Date of Birth:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400 laptop:text-sm">{{ $user->personalInformation->dob ?? "" }}</span></div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm">Birth Place:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400 laptop:text-sm">{{ $user->personalInformation->birth_place ?? "" }}</span></div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm" >Age:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400 laptop:text-sm">{{ $user->personalInformation->age ?? "" }}</span></div>
            </li>
            <li class="flex items-center laptop:gap-2">
                <div class="desktop:flex-1 flex-shrink-0"><span class="text-gray-400 laptop:text-sm" >Status:</span></div>
                <div class="flex-1 flex"><span class="text-gray-400 laptop:text-sm">{{ $user->personalInformation->status ?? "" }}</span></div>
            </li>
        </ul>
    </div>
</div>
