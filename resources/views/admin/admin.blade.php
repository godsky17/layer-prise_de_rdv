@extends('admin.base')
@section('content')
    <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
        <div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
                <div id="content_layout">
                    <div class=" space-y-5">
                        <div class="card">
                            <header class=" card-header noborder">
                                <h4 class="card-title">Liste des administrateur</h4>
                                <a href="{{route('admin.create')}}" class="btn flex justify-center btn-primary ml-auto">Ajouter</a>
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
                                                            Nom
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Prenoms
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Role
                                                        </th>

                                                        <th scope="col" class=" table-th ">
                                                            Action
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                    @forelse ($admins as $item)
                                                        <tr>
                                                            <td class="table-td">{{ $item->last_name }} </td>
                                                            <td class="table-td ">{{ $item->first_name }}</td>
                                                            <td class="table-td">
                                                                {{ $item->Role['name'] }}
                                                            </td>
                                                            <td class="table-td ">
                                                                <div>
                                                                    <div class="relative">
                                                                        <div class="dropdown relative">
                                                                            <button
                                                                                class="text-xl text-center block w-full "
                                                                                type="button" id="tableDropdownMenuButton1"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <iconify-icon
                                                                                    icon="heroicons-outline:dots-vertical"></iconify-icon>
                                                                            </button>
                                                                            <ul
                                                                                class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] float-left overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                                                                <li>

                                                                                    @if ($item->role_id == 1)
                                                                                        <form action="{{route('admin.update.admin', ['id'=>$item])}}" method="post">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                                Passer admin</button>
                                                                                        </form>
                                                                                    @else
                                                                                        <form action="{{route('admin.update.sadmin',['id'=>$item])}}" method="post">
                                                                                            @csrf
                                                                                            <button type="submit"
                                                                                                class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                                Passer super-admin</button>
                                                                                        </form>
                                                                                    @endif

                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('admin.retirer', ["id"=>$item]) }}"
                                                                                        class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                                                        Retirer</a>
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
