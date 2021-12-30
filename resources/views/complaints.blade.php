<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    @if (Auth::user()->is_admin)
                        <x-admin-profile-menu/>
                    @else
                        <x-profile-menu/>
                    @endif
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title fs-3 m-2">Saņemtās sūdzības</h2>
                            {{-- block to show success messages --}}
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <ul class="nav nav-tabs mb-2">
                                <li class="nav-item">
                                    <a class="nav-link {{request()->is('new-complaint-list') ? 'active' : 'text-secondary'}}" 
                                        href="/new-complaint-list">Jaunās
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->is('in-progress-complaint-list') ? 'active' : 'text-secondary'}}" 
                                        href="/in-progress-complaint-list">Tiek izskatītas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{request()->is('closed-complaint-list') ? 'active' : 'text-secondary'}}" 
                                        href="closed-complaint-list">Aizvērtās
                                    </a>
                                </li>
                            </ul>
                    <x-complaint-list :complaints="$complaints"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>