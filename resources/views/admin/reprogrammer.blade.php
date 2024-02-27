@extends('admin.base')
@section('content')
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
                <div id="content_layout">




                    <!-- BEGIN: Breadcrumb -->
                    <div class="mb-5">
                        <ul class="m-0 p-0 list-none">
                            <li class="inline-block relative top-[3px] text-base text-primary-500 font-Inter ">
                                <a href="index.html">
                                    <iconify-icon icon="heroicons-outline:home"></iconify-icon>
                                    <iconify-icon icon="heroicons-outline:chevron-right"
                                        class="relative text-slate-500 text-sm rtl:rotate-180"></iconify-icon>
                                </a>
                            </li>
                            <li class="inline-block relative text-sm text-primary-500 font-Inter ">
                                Forms
                                <iconify-icon icon="heroicons-outline:chevron-right"
                                    class="relative top-[3px] text-slate-500 rtl:rotate-180"></iconify-icon>
                            </li>
                            <li class="inline-block relative text-sm text-slate-500 font-Inter dark:text-white">
                                Form Vaidation</li>
                        </ul>
                    </div>
                    <!-- END: BreadCrumb -->
                    <div class="grid xl:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5">
                        @if (session('reject'))
                        <div class="alert alert-danger">
                            {{ session('reject') }}
                        </div>
                    @endif
            
                    @if (session('userNotFound'))
                        <div class="alert alert-danger">
                            {{ session('userNotFound') }}
                        </div>
                    @endif
                        <div class="card dark active">
                            <div class="card-body rounded-md bg-white dark:bg-slate-800 shadow-base menu-open">
                                <div class="items-center p-5">
                                    <h3 class="card-title text-slate-900 dark:text-white">Rendez-vous</h3>
                                        <ul>
                                            <li class="card-text my-5">{{ $item->user['last_name']}} {{ $item->user['first_name']}}</li>
                                            <li class="card-text my-5">{{ $item->date}}</li>
                                            <li class="card-text my-5">{{ $item->hour}}</li>
                                        </ul>
                                    <a href="{{route('admin.rdv')}}" class="underline btn-link active">Retour</a>
                                </div>
                            </div>
                        </div>
                        <div class="grid xl:grid-cols-2 grid-cols-1 gap-6">
                            <div class="card xl:col-span-2">
                                <div class="card-body flex flex-col p-6">
                                    <header
                                        class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                                        <div class="flex-1">
                                            <div class="card-title text-slate-900 dark:text-white">Reprogrammer</div>
                                        </div>
                                    </header>
                                    <div class="card-text h-full">
                                        <form class="space-y-4" id="multipleValidation" method="POST" action="{{route('admin.save', $item)}}">
                                            @csrf
                                            <div class="grid md:grid-cols-2 gap-6">
                                                <div>
                                                    <label for="default-picker" class=" form-label">Jour</label>
                                                    <input class="form-control py-2 flatpickr flatpickr-input" id="default-picker" name="date" value="{{ $item->date}}" type="text" >
                                                  </div>
                                                  <div>
                                                    <label for="time-picker" class="form-label">Heur</label>
                                                    <input class="form-control py-2 flatpickr time flatpickr-input" id="time-picker" name="hour" value="{{ $item->hour}}" type="text" min="08:00" max="17:00" readonly="">
                                                  </div>
                                            </div>
                                            <button type="submit" class="btn flex justify-center btn-dark ml-auto">Reprogrammer</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
