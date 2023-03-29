@extends('layouts.setting')
@section('content')
<div class="w-full h-ful p-2 flex items-center justify-center flex-col gap-1">
    <div class="bg-white w-[1000px] h-[100px] flex items-center">
        <span class="material-symbols-outlined font-semibold text-6xl text-gray-400">
            admin_panel_settings
        </span>
        <span class="text-3xl font-semibold text-gray-400">User Panel Settings</span>
    </div>
    <div class="w-[1000px] h-[500px] rounded-md flex flex-col gap-2">
        <div  class="flex gap-1">
            <div class="bg-slate-700 w-[100px] h-[90px] flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-white">
                    manage_accounts
                </span>
            </div>
            <div class="flex-1 border flex flex-col justify-center pl-2">
                <span class="font-bold text-gray-500">Manage your profile information</span>
                <span class="text-xs text-gray-400">Update your profile.</span>
            </div>
        </div>

        {{-- profile update form --}}
        <div class="flex-1 flex items-center justify-center border-t-[1px] z-10 relative">
            <a class="text-[#00B0F0] font-bold text-sm absolute top-0 right-0 cursor-pointer hover:underline" id="edit-profile">Edit</a>
            <a class="text-[#00B0F0] font-bold text-sm absolute top-0 right-0 cursor-pointer hover:underline hidden" id="cancel-edit">Cancel</a>
            <div class="w-full h-full flex flex-col">
                <div class="self-center mt-10">
                    <span class="font-semibold text-green-300" id="message"></span>
                </div>
                <form id="form_submit" action="/user/profile/edit/{{ $user->id }}" method="POST" class="flex justify-center flex-col flex-1 gap-5 p-10">
                    @csrf
                    @method('PUT')
                    <div class="flex">
                        <div class="flex-1 flex flex-col gap-5">
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end"><label for="first_name">First Name</label></div>
                                <div class="flex-1">
                                    <input disabled type="text" name="first_name" id="first_name" class="w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-50 text-sm" value="{{ $user->first_name }}" placeholder="Optional">
                                    @error('first_name')
                                    <span class="text-red-400 text-xs font-semibold">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end"><label for="last_name">Last Name</label></div>
                                <div class="flex-1"><input type="text" disabled name="last_name" class="w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-50 text-sm" value="{{ $user->last_name }}" placeholder="Optional"></div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end"><label for="middle_name">Middle Name</label></div>
                                <div class="flex-1"><input type="text" disabled name="middle_name" class="w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-50 text-sm" value="{{ $user->middle_name }}" placeholder="Optional"></div>
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col gap-5 mr-32">
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end"><label for="gender">Gender</label></div>
                                <div class="flex-1" >
                                    <select disabled name="gender" class="w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-50 text-sm">
                                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <div class="flex-1 text-end"><label for="email">Email</label></div>
                                <div class="flex-1"><input type="text" disabled name="email" class="w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-50 text-sm " value="{{ $user->email }}"></div>
                            </div>
                        </div>
                    </div>


                    <div class="w-full flex items-center justify-between h-[50px] border-t-[1px]">
                        <span class="text-[#00B0F0]"></span>
                        <button type="submit" class="hidden btn text-white font-bold text-xs bg-[#00B0F0] py-2 rounded-md hover:bg-[#00B0F0]/80" id="showSaveBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#form_submit').on('submit', function (e) {
        e.preventDefault()

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            cache: false,
            dataType: "json",
            contentType: false,

            success: function (data) {
                    if(data.status === 1)
                    {
                        $('#message').html(data.success);
                        setTimeout(() => {
                            $('#message').html('');
                        }, 5000);
                    } else {
                        $('#message').html(data.fail);
                        setTimeout(() => {
                            $('#message').html('');
                        }, 5000);
                    }
                }
            });
        })
    </script>
    <script>
       $('#edit-profile').click(function (e) {
            e.preventDefault();
            $('#showSaveBtn').show();
            $('#cancel-edit').show();
            $('#edit-profile').hide();
            $(' form input, select').removeAttr('disabled');

        });
        $('#cancel-edit').click(function (e) {
            e.preventDefault();
            $('#showSaveBtn').hide();
            $('#cancel-edit').hide();
            $('#edit-profile').show();
            $('form input, select').attr('disabled', 'disabled');
        });
    </script>
@endsection
