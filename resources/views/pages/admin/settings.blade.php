@extends('layouts.main')

@section('content')
    <div class="w-full h-full flex">
        {{-- left sidebar section --}}
        {{-- <x-sidebar/> --}}

        {{-- settings section --}}
        <div class="bg-white w-full h-full p-10">
            <h1 class="text-3xl text-slate-700 font-semibold">SETTINGS</h1>
            <div class="bg-white w-full h-full">

                <div class="w-full h-full bg-white">

                    <div class="settings-table-container">

                        <div class="w-full h-[450px] flex items-center justify-center">

                            <img src="{{ asset('images/404.jpg') }}" class="object-cover h-[420px] w-[420px]">

                        </div>
                        </div>

                            <div class="w-full h-full flex flex-col items-center">

                                <div class="w-[450px] h-[100px] flex flex-col">

                                    <span class="tracking-wider whitespace-nowrap">Sorry! Settings is currently not available at this moment</span>
                                    <span class="tracking-wider whitespace-nowrap">Sorry for the inconvenience, we'll be back soon.</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
