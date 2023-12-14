<!-- <form id="upload_form" method="POST" enctype="multipart/form-data" class="absolute left-0 right-0 bottom-0 top-0 m-auto bg-white w-[500px] h-[500px] rounded-md flex flex-col">
    @csrf
    <div class="p-2 flex border-b-[1px] items-center justify-between px-5">
        <span class="text-gray-400 font-bold text-2xl">Update profile picture</span>
        <div class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center group hover:bg-gray-100">
            <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-400 text-2xl font-bold" id="close">
                close
            </span>
        </div>
    </div>
    <div class="flex-1 flex items-center justify-center flex-col gap-1 px-10">

        {{-- success image --}}
        <div class="w-full flex items-center justify-center text-gray-400 font-bold mb-5">
            <span id="message" class="text-xs"></span>
        </div>

        @if (Auth::user()->image != '')
            <div class="bg-slate-700 w-40 h-40 rounded-md relative shadow">
                <img src="{{ asset('images/'.Auth::user()->image) }}" class="object-cover w-full h-full rounded-md">
                <div class=" w-40 h-40 rounded-md absolute top-0" id="uploaded_image"></div>
            </div>

        @else
            <div class="bg-slate-700 w-40 h-40 rounded-md relative shadow flex items-center justify-center">
                <span class="text-white font-bold text-9xl">{{ Auth::user()->first_name[0] }}</span>
                <div class="w-40 h-40 rounded-md absolute top-0" id="uploaded_image"></div>
            </div>
        @endif

        <div class="bg-[#00B0F0] h-10  w-40 rounded-md flex items-center justify-center relative hover:bg-[#00B0F0]/80">
            <label for="select_file" class="text-white font-bold text-sm w-full h-full flex items-center justify-center">Choose photo</label>
            <input type="file" name="select_file" id="select_file" class="absolute left-0 right-0 m-auto opacity-0">
        </div>
        <span ></span>
    </div>
    <div class="p-5 flex justify-between items-center gap-3 border-t-[1px]">
        <span class="text-[#00B0F0] font-bold text-sm">Show your beautiful face.</span>
        <div>
            <a id="cancel" class="focus:ring-1 text-gray-400 font-bold text-sm py-2 px-5 border rounded-md hover:bg-red-400 hover:text-white focus:bg-red-500 focus:text-white">Cancel</a>
            <input type="submit" name="upload" id="upload" value="Save" class="focus:ring-1 bg-[#00B0F0] hover:bg-[#00B0F0]/80 text-white font-bold text-sm py-2 px-5 rounded-md focus:bg-[#00B0F0]">
        </div>
    </div>

</form>
<script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('js/admin-change-photo.js') }}"></script>
<script src="{{ asset('js/change_photo.js') }}"></script> -->

