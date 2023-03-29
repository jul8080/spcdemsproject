@extends('layouts.main')

@section('content')

    <div class="w-full h-full flex bg-white overflow-scroll" id="scroll-custom">
        {{-- left sidebar section --}}

        <div class="w-full bg-white">

            {{-- create form for employee's  --}}

            <form action="{{ route('admin.store.employee') }}" method="POST" class="bg-white h-full flex flex-col px-20">
                @csrf
                    {{-- ID input  --}}

                <div class="w-full flex h-[200px] flex-shrink-0">
                    <div class="flex-1 flex flex-col items-center justify-center">
                        {{-- @foreach ($errors->all() as $error)
                            <ul class="w-full">
                                <li class="text-xs text-red-500 whitespace-nowrap">{{ $error }}</li>
                            </ul>
                        @endforeach --}}
                    </div>
                    <div class="flex-1 flex justify-end">
                        <div class="h-full w-[300px] bg-white flex  flex-col items-center justify-center">
                            <div class="bg-gray-100 h-28 w-28 rounded-full flex items-center justify-center flex-shrink-0 mt-5">
                                <img src="{{ asset('images/user.png') }}" class="w-20 h-20">
                            </div>
                            <div class="bg-white w-full h-full flex items-center justify-center flex-col pl-6">
                                <input type="text" class="h-10 w-full outline-none rounded-sm rounded-bl-sm bg-gray-100 pl-2 caret-sky-500 text-center" name="school_id" placeholder="ID" value="{{ old('school_id') }}">
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('school_id') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="h-full w-[300px] bg-white flex  flex-col items-center justify-center">
                        <div class="bg-gray-100 h-28 w-28 rounded-full flex items-center justify-center flex-shrink-0 mt-5">
                            <img src="{{ asset('images/user.png') }}" class="w-20 h-20">
                        </div>
                        <div class="bg-white w-full h-full flex items-center justify-center flex-col pl-6">
                            <input type="text" class="h-10 w-full outline-none rounded-sm rounded-bl-sm bg-gray-100 pl-2 caret-sky-500 text-center" name="school_id" placeholder="ID" value="{{ old('school_id') }}">
                            <span class="text-xs text-red-500 whitespace-nowrap">@error('school_id') {{ $message }} @enderror</span>
                        </div>
                    </div> --}}
                </div>
                    {{-- Full Name input --}}
                <div class="flex flex-col gap-7 bg-white">
                    <div class="bg-white flex items-start justify-center">
                        <div class="bg-white w-[10rem] flex items-center text-slate-700 mt-2 font-bold">
                            <label class="whitespace-nowrap">Full name:</label>
                        </div>
                        <div class="flex-1 flex gap-1 bg-white">
                            <div class="flex flex-col flex-1">
                                <input type="text" class="h-10 w-full outline-none rounded-sm rounded-bl-sm bg-gray-100 pl-2 caret-sky-500" name="last_name" value="{{ old('last_name') }}">
                                <label for="last_name" class="text-xs font-semibold text-slate-700 whitespace-nowrap">Last name</label>
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('last_name') {{ $message }} @enderror</span>
                            </div>
                            <div class="flex flex-col flex-1">
                                <input type="text" class="h-10 w-full outline-none rounded-sm bg-gray-100 pl-2 caret-sky-500" name="first_name" value="{{ old('first_name') }}">
                                <label for="first_name" class="text-xs font-semibold text-slate-700 whitespace-nowrap">First name</label>
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('first_name') {{ $message }} @enderror</span>
                            </div>
                            <div class="flex flex-col flex-1">
                                <input type="text" class="h-10 w-full outline-none rounded-sm rounded-br-sm bg-gray-100 pl-2 caret-sky-500" name="middle_name" value="{{ old('middle_name') }}">
                                <label for="middle_name" class="text-xs font-semibold text-slate-700 whitespace-nowrap">M.I</label>
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('middle_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                        {{-- department & position input --}}

                    <div class="flex bg-white items-center">
                        <div class="bg-white w-[10rem] flex items-center text-slate-700 font-bold">
                            <label class="whitespace-nowrap">Position:</label>
                        </div>
                        <div class="flex-1 flex items-start gap-1">
                            <div class="bg-white w-full">
                                <input type="text" class="w-full outline-none h-10 bg-gray-100 pl-2 caret-sky-500" name="position" value="{{ old('position') }}">
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('position') {{ $message }} @enderror</span>

                            </div>

                            <div class="w-[490px] text-center">
                                <select name="department" class="w-full h-10 bg-gray-100 rounded-sm outline-none text-center text-slate-700 font-bold">
                                    <option selected disabled>Department</option>
                                    <option value="hr" {{old( 'department') == 'hr' ? 'selected' : '' }}>Hr</option>
                                    <option value="employee" {{ old('department') == 'employee' ? 'selected' : '' }}>Employee</option>
                                </select>
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('department') {{ $message }} @enderror</span>
                            </div>


                        </div>
                    </div>

                        {{-- Email & Gender employee input --}}

                    <div class="flex bg-white items-center">
                        <div class="bg-white w-[10rem] flex items-center text-slate-700 font-bold">
                            <label class="whitespace-nowrap">Email:</label>
                        </div>
                        <div class="flex-1 flex items-start gap-1">
                            <div class="w-full">
                                <input type="email" class="w-full outline-none h-10 bg-gray-100 pl-2 caret-sky-500" name="email" value="{{ old('email') }}">
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="w-[490px] text-center">
                                <select name="gender" class="w-full h-10 bg-gray-100 rounded-sm outline-none text-center text-slate-700 font-bold">
                                    <option selected disabled>Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <span class="text-xs text-red-500 whitespace-nowrap">@error('gender') {{ $message }} @enderror</span>
                            </div>

                        </div>
                    </div>

                    {{-- Password employee input --}}

                    <div class="flex bg-white items-center">
                        <div class="bg-white w-[10rem] flex items-center text-slate-700 font-bold">
                            <label class="whitespace-nowrap">Password:</label>
                        </div>
                        <div class="bg-white flex-1">
                            <input type="password" class="w-full outline-none h-[3rem] rounded-sm bg-gray-100 pl-2 caret-sky-500" name="password">
                            <span class="text-xs text-red-500 whitespace-nowrap">@error('password') {{ $message }} @enderror</span>
                           </span>
                        </div>
                    </div>

                    {{-- Confirm password input --}}
                    <div class="flex bg-white items-center">
                        <div class="bg-white w-[10rem] text-slate-700 font-bold">
                            <label class="whitespace-nowrap">Confirm password:</label>
                        </div>
                        <div class="flex-1">
                            <input type="password" class="w-full outline-none h-10 rounded-sm bg-gray-100 pl-2 caret-sky-500" name="password_confirmation">
                            <span class="text-xs text-red-500 whitespace-nowrap">@error('password_confirmation') {{ $message }} @enderror</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white flex justify-end mt-3">
                    <button type="submit" class="bg-green-500 text-white font-bold py-3 px-10 rounded-md hover:bg-green-400">Add Employee</button>
                </div>
            </form>

        </div>

        @if (Session::get('message'))

            <div class="bg-green-400 w-[400px] h-[100px] fixed -left-80 bottom-2 rounded-md flex" id="succes-message">
                <div class="h-full w-[100px] flex items-center justify-center">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined font-semibold text-6xl text-slate-700">
                            done
                        </span>
                    </div>
                </div>
                <div class="flex-1 flex flex-col">
                    <div class="w-full text-right pr-2">
                        <span class="material-symbols-outlined text-xs font-bold text-slate-700" id="close-success">
                            close
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="text-white font-bold ml-2 tracking-wider mt-4">{{ Session::get('message') }}</p>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection

@section('scripts')
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script>

        $('#succes-message').animate({
            'left': '.5rem'
        }, 'fast');
        setTimeout(() => {
            $('#succes-message').animate({
                'left': '-1000'
            });
        }, 10000);

        $('#succes-message').click(function () {
            $('#succes-message').animate({
                'left': '-1000'
            });
         });
    </script>
@endsection
