<div class="w-full h-full flex flex-col flex-shrink-0">
    <div class="bg-[#00B0F0] h-[170px] relative flex-shrink-0 flex flex-col items-center justify-center">
        <div class="w-24 h-24 rounded-md">
            <img src="{{ asset('images/samson.png') }}" alt="samson photo" class="w-full h-full object-cover">
        </div>
        <span class="uppercase text-white tracking-[.3rem] font-bold">spcd</span>
        <span class="text-white font-semibold text-sm">Employee Registration Form</span>
    </div>
    <div class="w-full text-center pt-2">
        <span id="message" class="text-green-400 font-semibold"></span>
    </div>
    <div class="flex-1 flex items-center justify-center flex-shrink-0 py-10">
        <form id="registrationForm" action="{{ route('admin.store.employee') }}" method="POST" class="flex flex-col gap-2 w-[400px]">
            @csrf
            <div class="flex flex-col">
                <label for="school_id" class="text-sm">ID</label>
                <input type="text" name="school_id" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('school_id') }}">
                <span class="text-xs text-red-500" id="error-school_id"><span>
            </div>
            <div class="flex flex-col">
                <input type="hidden" name="new_user" class="bg-gray-50 py-1 pl-2 outline-none w-full"  value="{{ $todayDate }}">
            </div>
            <div class="flex flex-col">
                <label for="first_name" class="text-sm">First name</label>
                <input type="text" name="first_name" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full"  value="{{ old('first_name') }}">
                <span class="text-xs text-red-500" id="error-first_name"></span>
            </div>
            <div class="flex flex-col">
                <label for="last_name" class="text-sm">Last name</label>
                <input type="text" name="last_name" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('last_name') }}">
                <span class="text-xs text-red-500" id="error-last_name"></span>
            </div>
            <div class="flex flex-col">
                <label for="middle_name" class="text-sm">M.I</label>
                <input type="text" name="middle_name" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('middle_name') }}">
                <span class="text-xs text-red-500" id="error-middle_name"></span>
            </div>
            <div class="flex gap-1">
                <div class="flex-1 flex flex-col">
                    <label for="deparment" class="text-sm">Department</label>
                    <input type="text" name="department" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('department') }}">
                    <span class="text-xs text-red-500" id="error-department"></span>
                </div>
                <div class="flex-1 flex items-baseline flex-col">
                    <label for="position" class="text-sm">Position</label>
                    <input type="text" name="position" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('position') }}">
                    <span class="text-xs text-red-500" id="error-position"></span>
                </div>
            </div>
            <div class="flex gap-2">
                <div class="flex-1 flex flex-col">
                    <label for="email" class="text-sm">Email</label>
                    <input type="email" name="email" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full" value="{{ old('email') }}">
                    <span class="text-xs text-red-500" id="error-email"></span>
                </div>
                <div class="flex flex-col items-center">
                    <label for="gender" class="opacity-0 text-sm">Gender</label>
                    <select name="gender" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 px-5  outline-none w-full text-md">
                        <option selected disabled>Gender</option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                    <span class="text-xs text-red-500" id="error-gender"></span>
                </div>
            </div>
            <div class="flex gap-1">
                <div class="flex-1 flex flex-col">
                    <label for="password" class="text-sm">Password</label>
                    <input type="password" name="password" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full">
                    <span class="text-xs text-red-500" id="error-password"></span>
                </div>
                <div class="flex-1 flex items-baseline flex-col">
                    <label for="password_confirmation" class="text-sm">Confirm password</label>
                    <input type="password" name="password_confirmation" class="focus:ring-1 focus:bg-white bg-gray-50 py-1 pl-2 outline-none w-full">
                    <span class="text-xs text-red-500" id="error-password_confirmation"></span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <a href="#" class="text-gray-400 font-bold text-sm py-2 border px-4 rounded-md focus:ring-1 hover:bg-red-400 hover:text-white" id="cancel-form">Cancel</a>
                <button type="submit" class="bg-[#00B0F0] text-white font-bold text-sm py-2 px-4 rounded-md focus:ring-1 hover:bg-[#00B0F0]/80">Register</button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('js/user-registration.js') }}"></script>
