@extends('admin.base')
@section('content')
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
                <div id="content_layout">
                    <div class=" space-y-5">
                        <div class="card">
                            <header class=" card-header noborder">
                                <h4 class="card-title">Rendez-vous</h4>
                            </header>
                            <div class="card-body px-6 pb-6">
                                <div class="overflow-x-auto -mx-6 dashcode-data-table">
                                    <span class=" col-span-8  hidden"></span>
                                    <span class="  col-span-4 hidden"></span>
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden ">
                                            <table
                                                class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700"
                                                id="data-table">
                                                <thead class=" border-t border-slate-100 dark:border-slate-800">
                                                    <tr>

                                                        <th scope="col" class=" table-th ">
                                                            Client
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Date
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Heure
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Status
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Action
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                    @forelse ($rdv as $item)
                                                    <tr>
                                                        <td class="table-td">{{ $item->User['last_name'] }}  {{ $item->User['first_name'] }}</td>
                                                        <td class="table-td ">{{ $item->date }}</td>
                                                        <td class="table-td">
                                                          {{ $item->hour }}
                                                        </td>
                                                        <td class="table-td ">
                                                          @if ($item->etat_id == 1)
                                                            <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-primary-500 bg-primary-500">
                                                              {{ $item->Etat['name'] }}
                                                            </div>
                                                          @endif

                                                          @if ($item->etat_id == 2)
                                                            <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500 bg-success-500">
                                                              {{ $item->Etat['name'] }}
                                                            </div>
                                                          @endif

                                                          @if ($item->etat_id == 3)
                                                            <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-secondary-500 bg-secondary-500">
                                                              {{ $item->Etat['name'] }}
                                                            </div>
                                                          @endif

                                                          @if ($item->etat_id == 4)
                                                            <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500">
                                                              {{ $item->Etat['name'] }}
                                                            </div>
                                                          @endif

                                                          @if ($item->etat_id == 5)
                                                            <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500 bg-danger-500">
                                                              {{ $item->Etat['name'] }}
                                                            </div>
                                                          @endif
                                                          
                                                        </td>
                                                        <td class="table-td ">
                                                            <div>
                                                                <div class="relative">
                                                                    <div class="dropdown relative">
                                                                        <button class="text-xl text-center block w-full "
                                                                            type="button" id="tableDropdownMenuButton1"
                                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <iconify-icon
                                                                                icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                                        </button>
                                                                        <ul
                                                                            class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                                            <li>
                                                                                <a href="{{ route('admin.calendrier')}}"
                                                                                    class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                    Calendrier</a>
                                                                            </li>
                                                                            @if ($item->etat_id != 5)
                                                                            <li>
                                                                                <a href="{{{route('admin.annuler', $item)}}}" class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                    Annuler
                                                                                </a>
                                                                            </li>
                                                                            @endif
                                                                            <li>
                                                                                <a href="{{route('admin.reprogrammer', $item)}}"
                                                                                    class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                    Reprogrammer</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                        
                                                    @endforelse

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
