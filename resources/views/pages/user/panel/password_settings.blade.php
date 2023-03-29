@extends('layouts.setting')

@section('content')
    <div class="w-full h-ful p-2 flex items-center justify-center flex-col gap-1 relative">
        <div class="bg-white w-[1000px] h-[100px] flex items-center">
            <span class="material-symbols-outlined font-semibold text-6xl text-gray-400">
                admin_panel_settings
            </span>
            <span class="text-3xl font-semibold text-gray-400">User Panel Settings</span>
        </div>
        <div class="w-[1000px] h-[500px] rounded-md flex flex-col gap-2">
            <div  class="flex gap-1">
                <div class="bg-slate-700 w-[100px] h-[90px] flex items-center justify-center">
                    <span class="material-symbols-outlined -rotate-45 text-6xl text-white">
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

                    <form action="{{ route('user.password.change') }}" method="POST" class="flex items-center justify-center flex-col flex-1 gap-5 p-10">
                        @csrf
                        <div class="flex flex-col gap-2 w-[400px]">
                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="current_password" class="text-gray-500 font-semibold">Current password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="current_password" class="flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-50">
                                @error('current_password')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="password" class="text-gray-500 font-semibold">New password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="password" class="flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-50">
                                @error('password')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex w-full gap-1">
                            <div class="flex-1 flex items-center justify-end">
                                <label for="password_confirmation" class="text-gray-500 font-semibold">Confirmed password</label>
                            </div>
                            <div class="flex-1 flex items-center gap-2">
                                <input type="password" name="password_confirmation" class="flex-shrink-0 w-full outline-none caret-[#00B0F0] py-1 pl-2 focus:ring-1 bg-gray-50">
                                @error('password_confirmation')
                                <span class="text-xs text-red-400 flex-shrink-0">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        </div>
                        <div class="w-full flex items-center justify-between h-[50px] border-t-[1px]">
                            <span class="text-[#00B0F0]">Strenghten your password</span>
                            <button type="submit" class="btn text-white font-bold text-xs bg-[#00B0F0] py-2 rounded-md hover:bg-[#00B0F0]/80">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
             {{-- successfull message --}}
                @if (Session::get('success'))
                    <div class="bg-white w-[400px] h-[100px] absolute bottom-2 -right-96 flex flex-col px-3 py-2 border-l-8 rounded-md border-lime-500 justify-center shadow" id="showSuccess">
                        <div class="flex-shrink-0 px-2 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bg-lime-400 w-10 h-10 rounded-full flex place-items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-white font-bold">
                                        done
                                    </span>
                                </div>
                                <span class="font-bold text-slate-700">Successfull</span>
                            </div>
                            <span class="material-symbols-outlined text-lime-300 font-bold" id="close">
                                close
                            </span>
                        </div>
                        <div class="flex-shrink-0 flex px-2 gap-3 items-start">
                            <div class="w-10 h-10 rounded-full opacity-0"></div>
                            <span class="text-sm font-semibold text-slate-500">{{ Session::get('success') }}</span>
                        </div>
                    </div>
                @endif

                 {{-- fail message --}}
                 @if (Session::get('fail'))
                 <div class="bg-white w-[400px] h-[100px] absolute bottom-2 -right-96 flex flex-col px-3 py-2 border-l-8 rounded-md border-red-500 justify-center shadow" id="showSuccess">
                     <div class="flex-shrink-0 px-2 flex items-center justify-between">
                         <div class="flex items-center gap-3">
                             <div class="bg-red-400 w-10 h-10 rounded-full flex place-items-center justify-center flex-shrink-0">
                                 <span class="material-symbols-outlined text-white font-bold">
                                     priority_high
                                 </span>
                             </div>
                             <span class="font-bold text-slate-700">Error</span>
                         </div>
                         <span class="material-symbols-outlined text-red-300 font-bold" id="close">
                             close
                         </span>
                     </div>
                     <div class="flex-shrink-0 flex px-2 gap-3 items-start">
                         <div class="w-10 h-10 rounded-full opacity-0"></div>
                         <span class="text-sm font-semibold text-slate-500">{{ Session::get('fail') }}</span>
                     </div>
                 </div>
             @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#showSuccess').animate({
            'right':'0.5rem',
        },300);

        setTimeout(() => {
            $('#showSuccess').animate({
                'right':'-30rem',
            },300);
        }, 10000);

        $('#close').click(function (e) {
            $('#showSuccess').animate({
                'right':'-30rem',
            },300);

        });
    </script>

    <script>

    </script>
@endsection
