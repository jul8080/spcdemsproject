@extends('layouts.setting')
@section('content')
<div class="w-full h-ful desktop:p-2 laptop:p-5 flex desktop:items-center desktop:justify-center laptop:justify-center flex-col gap-1">
    <div class="bg-white desktop:w-[1000px] h-[100px] flex items-center">
        <span class="material-symbols-outlined font-semibold desktop:text-6xl laptop:text-5xl text-gray-400">
            admin_panel_settings
        </span>
        <span class="desktop:text-3xl laptop:text-2xl font-semibold text-gray-400">Admin Panel Settings</span>
    </div>
    <div class="desktop:w-[1000px] h-[500px] rounded-md flex flex-col gap-2">
        <div  class="flex gap-1">
            <div class="bg-slate-700 w-[100px] h-[90px] flex items-center justify-center">
                <span class="material-symbols-outlined desktop:text-6xl laptop:text-4xl text-white">
                    contact_phone
                </span>
            </div>
            <div class="flex-1 border flex flex-col justify-center pl-2">
                <span class="font-bold text-gray-500">Manage your emergency contact information</span>
                <span class="text-xs text-gray-400">Update your emergency contact information.</span>
            </div>
        </div>

        {{-- change password form --}}
        <div class="flex-1 flex items-center justify-center border-t-[1px] z-10 relative">
            <a class="text-[#00B0F0] font-bold text-sm absolute top-0 right-0 cursor-pointer hover:underline" id="edit-contact">Edit</a>
            <a class="text-[#00B0F0] font-bold text-sm absolute top-0 right-0 cursor-pointer hover:underline hidden" id="cancel-edit">Cancel</a>
            <div class="w-full h-full flex flex-col">
                <div class="self-center mt-10">
                    <span class="font-semibold text-green-300" id="message"></span>
                </div>
                <form action="{{ route('admin.emergency.contact.store') }}" method="POST" id="form_submit" class="flex justify-center flex-col flex-1 gap-5 p-10">
                    @csrf
                    <div class="flex">
                        <div class="flex-1 flex flex-col gap-5">
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >First Name</label></div>
                                <div class="flex-1">
                                    <input disabled type="text" name="first_name" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm" value="{{ $user->emergencytContactInformation->first_name ?? '' }}" placeholder="Optional">
                                    <span class="text-xs font-semibold text-red-400 error_text first_name_error"></span>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >Last Name</label></div>
                                <div class="flex-1 laptop:text-xs desktop:text-sm"><input disabled type="text" name="last_name" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm" value="{{ $user->emergencytContactInformation->last_name ?? "" }}" placeholder="Optional"></div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >Middle Name</label></div>
                                <div class="flex-1 laptop:text-xs desktop:text-sm"><input disabled type="text" name="middle_name" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm"
                                    value="{{$user->emergencytContactInformation->middle_name ?? '' }}" placeholder="Optional"></div>
                            </div>
                        </div>

                        <div class="flex-1 flex flex-col gap-5 mr-32">
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >Address</label></div>
                                <div class="flex-1"><input disabled type="text" name="address" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm" value="{{ $user->emergencytContactInformation->address ?? '' }}" placeholder="Optional"></div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >Phone No</label></div>
                                <div class="flex-1"><input disabled type="text" name="phone_no" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm" value="{{ $user->emergencytContactInformation->phone_no ?? '' }}" placeholder="Optional"></div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <div class="flex-1 text-end laptop:text-xs desktop:text-sm"><label >Relationship</label></div>
                                <div class="flex-1"><input disabled type="text" name="relationship" value="{{ $user->emergencytContactInformation->relationship ?? '' }}" class="laptop:text-xs desktop:text-sm w-full outline-none caret-[#00B0F0] pl-2 py-[.3rem] focus:ring-1 bg-gray-100 text-sm" placeholder="Optional"></div>
                            </div>
                        </div>
                    </div>


                    <div class="w-full flex items-center justify-between h-[50px] border-t-[1px]">
                        <span class="text-[#00B0F0]"></span>
                        <button type="submit" class="focus:ring-1 btn text-white font-bold text-xs bg-[#00B0F0] py-2 rounded-md hover:bg-[#00B0F0]/80 hidden" id="showContactSaveBtn">Save changes</button>
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
            $('#message').html(data.message);
            $('#message').html(data.message);
                setTimeout(() => {
                    $('#message').html('');
                }, 5000);
        }
    });


 })
 $('#edit-contact').click(function (e) {
    e.preventDefault();
    $('#edit-contact').click(function (e) {
            e.preventDefault();
            $('#showContactSaveBtn').show();
            $('#cancel-edit').show();
            $('#edit-contact').hide();
            $(' form input, select').removeAttr('disabled');
        });
        $('#cancel-edit').click(function (e) {
            e.preventDefault();
            $('#showContactSaveBtn').hide();
            $('#cancel-edit').hide();
            $('#edit-contact').show();
            $('form input, select').attr('disabled', 'disabled');
        });
 });
</script>
@endsection
