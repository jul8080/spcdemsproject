    <div class="header-section">
        <div class="header-nav">
            <div class="menu-wrapper">
                <span class="material-symbols-outlined text-3xl" id="menu">
                    sort
                </span>
                <span>Menu</span>
            </div>
            <div class="header-user-info-container">
                <div class="header-user-box">
                    <span class="header-username capitalize">Jul Punding</span>
                </div>

                {{-- dropdown box --}}

                <div class="flex items-center justify-center relative">
                    <a href="#" class="material-symbols-outlined text-[30px] font-bold text-slate-700" id="showDropdownBox">account_circle</a>


                    <div class="dropdown-box-container" id="dropdownBox">
                        <div class="dropdown-box-container-div">
                            <div class="dropdown-box-container-profile-container">
                                <span href="#" class="material-symbols-outlined text-[24px] font-bold text-slate-700">account_circle</span>
                                <span class="dropdown-box-container-profile-username">Jul Punding</span>
                            </div>
                            <nav class="dropdown-box-container-nav">
                                <ul class="dropdown-box-container-list">
                                    <li class="dropdown-box-list"><a href="/users/page" class="dropdown-box-link">Profile<span class="material-symbols-outlined text-xs">arrow_forward_ios</span>
                                    </a></li>
                                    <li class="dropdown-box-list"><a href="#" class="dropdown-box-link">Profile <span class="material-symbols-outlined text-xs">arrow_forward_ios</span></span></a></li>

                                    {{-- logout form  --}}

                                    <li class="dropdown-box-list"><a class="dropdown-box-link">
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full">
                                                Logout
                                                <span class="material-symbols-outlined text-xs self-end">arrow_forward_ios</span></a>
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

{{-- <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
<script>
    // toggle dropdown box
    $('#showDropdownBox').click(function () {
            $('#dropdownBox').toggleClass('toggle');
        });

    $(document).click(function () {
        $('#dropdownBox').removeClass('toggle');
    });
    $('#showDropdownBox').click(function (e) {
        e.stopPropagation()
    });

</script> --}}

@section('scripts')
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>

    <script>
        // toggle dropdown box
        $('#showDropdownBox').click(function () {
                $('#dropdownBox').toggleClass('toggle');
            });

        $(document).click(function () {
            $('#dropdownBox').removeClass('toggle');
        });
        $('#showDropdownBox').click(function (e) {
            e.stopPropagation()
        });

    </script>
@endsection

{{-- toggle sidebar --}}
{{-- $('#menu').click(function () {
    $('#showSidebar').css({
        'display':'block'
    })
    // $('#menu').hide();
});
$('#close').click(function() {
    $('#showSidebar').css({
        'display':'none'
    })
    // $('#menu').show();
 }); --}}

