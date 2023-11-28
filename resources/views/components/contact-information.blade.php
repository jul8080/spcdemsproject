<div class="w-full h-full p-3 relative">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-1">
            <span class="material-symbols-outlined text-5xl text-gray-400">
                contact_phone
            </span>
            <h1 class="font-bold text-3xl text-gray-400">Emergency Contact</h1>
        </div>
    </div>
    <div class="flex h-[500px]">
        <ul class="mt-10 flex flex-col gap-5 flex-1">
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Full name:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">
                        {{ $contactInfo->last_name ?? "" }}
                        {{ $contactInfo->first_name ?? "" }}
                        {{ $contactInfo->middle_name ?? "" }}
                    </span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Address:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $contactInfo->address ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Phone No:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $contactInfo->phone_no ?? "" }}</span></div>
            </li>
            <li class="flex">
                <div class="flex-1 flex-shrink-0"><span class="text-gray-400">Relationship:</span></div>
                <div class="flex-1 flex"><span class="capitalize text-gray-400">{{ $contactInfo->relationship ?? "" }}</span></div>
            </li>
        </ul>
        @if($user->role_as == 'user')

        @else
        <div class="flex-1 h-full flex items-center justify-center">
            <!-- <qrcode-component qrcode="{{$user->qrcode}}" name="{{$user->last_name}}"></qrcode-component> -->
        </div>
        @endif
    </div>
</div>