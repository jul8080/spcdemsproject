<div class="w-[500px] bg-white flex flex-col rounded-md">
                    <div class="border-b-[1px] h-14 flex items-center justify-between px-5">
                        <span class="self-center text-gray-400 text-2xl font-semibold">User assign permission</span>
                        <div class="bg-gray-50 w-8 h-8 rounded-full flex items-center justify-center group hover:bg-gray-100">
                            <span class="material-symbols-outlined text-gray-300 group-hover:text-gray-400" id="close-wrapper">
                                close
                            </span>
                        </div>
                    </div>
                    <form id="employeeForm" action="/admin/user/store" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="id" name="id">
                        <div class="w-full flex items-center justify-center">
                            <span id="success" class="text-xs mt-2 text-green-500"></span>
                            <span id="fail" class="text-xs mt-2 text-red-500"></span>
                        </div>
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="department" id="department" class="text-gray-400 font-semibold">Department</label>
                            <div>
                                <a class="text-[#00B0F0]" class="cursor-pointer hover:underline" id="role-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="role-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center justify-center flex-col overflow-hidden" id="change-role">
                            <input type="text" id="department" name="department" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>

                        {{-- entry level edit --}}
                        <div class="flex items-center justify-between px-[3.7rem] h-10">
                            <label for="position" id="position" class="text-gray-400 font-semibold">Position</label>
                            <div>
                                <a type="submit" class="text-[#00B0F0]" id="entry-edit">edit</a>
                                <button type="submit" class="text-[#00B0F0] hidden" id="entry-update">ok</button>
                            </div>
                        </div>
                        <div class="h-0 flex items-center flex-col justify-center overflow-hidden" id="change-entry">
                            <input type="text" id="position" name="position" value="" class="w-96 h-14 px-5 outline-none bg-gray-50">
                        </div>
                        <div class="w-full text-end h-10 hidden overflow-hidden px-[3.7rem]" id="close-container">
                            <a class="text-red-400 font-semibold" id="close-form">cancel</a>
                        </div>
                    </form>
                </div>
<script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('js/permission-form.js') }}"></script>
