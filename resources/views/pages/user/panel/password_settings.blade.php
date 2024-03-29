@extends('layouts.setting')

@section('content')
    <div class="w-full h-ful desktop:p-2 laptop:p-5 flex desktop:items-center desktop:justify-center laptop:justify-center flex-col gap-1 relative">
        <div class="bg-white desktop:w-[1000px] h-[100px] flex items-center">
            <span class="material-symbols-outlined font-semibold desktop:text-6xl laptop:text-5xl text-gray-400">
                admin_panel_settings
            </span>
            <span class="text-3xl font-semibold text-gray-400">User Panel Settings</span>
        </div>
        <div class="desktop:w-[1000px] h-[500px] rounded-md flex flex-col gap-2">
            <div  class="flex gap-1">
                <div class="bg-slate-700 w-[100px] h-[90px] flex items-center justify-center">
                    <span class="material-symbols-outlined -rotate-45 desktop:text-6xl laptop:text-5xl text-white">
                        key
                    </span>
                </div>
                <div class="flex-1 border flex flex-col justify-center pl-2">
                    <span class="font-bold text-gray-500">Change Password</span>
                    <span class="text-xs text-gray-400">It's a good idea to use a strong password.</span>
                </div>
            </div>

            {{-- change password form --}}
            <div class="flex-1 flex items-center justify-center border-t-[1px] z-10">
                <div class="w-[600px] flex flex-col">
                    <div class="self-center mt-10">
                        @if (Session::get('success'))
                            <span class="font-semibold text-green-300" id="message">{{ Session::get('success') }}</span>
                        @else
                            <span class="font-semibold text-red-400" id="message">{{ Session::get('fail') }}</span>
                        @endif
                    </div>
                    <form action="{{ route('user.password.change') }}" method="POST" class="flex items-center justify-center flex-col flex-1 gap-5 p-10">
                        @csrf
                        <div class="flex flex-col gap-2 w-[400px]">
                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="current_password" class="text-gray-500 font-semibold laptop:text-xs desktop:text-sm">Current password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="current_password" class="laptop:text-xs desktop:text-sm flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-100">
                                @error('current_password')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="password" class="text-gray-500 font-semibold laptop:text-xs desktop:text-sm">New password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="password" class="laptop:text-xs desktop:text-sm flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-100">
                                @error('password')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="password_confirmation" class="text-gray-500 font-semibold laptop:text-xs desktop:text-sm">Confirmed password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="password_confirmation" class="laptop:text-xs desktop:text-sm flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-100">
                                @error('password_confirmation')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <div class="w-full flex items-center justify-between h-[50px] border-t-[1px]">
                            <span class="text-[#00B0F0] desktop:text-sm laptop:text-xs">Strenghten your password</span>
                            <button type="submit" class="btn text-white font-bold text-xs bg-[#00B0F0] py-2 rounded-md hover:bg-[#00B0F0]/80">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
