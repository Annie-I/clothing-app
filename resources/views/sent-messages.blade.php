<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title fs-3 m-2">Ziņas</h2>
                            {{-- block to show messages --}}
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <ul class="nav nav-tabs mb-2">
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="/received-messages">Saņemtās ziņas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/sent-messages">Nosūtītās ziņas</a>
                                </li>
                            </ul>
                    <x-mailbox :userMessages="$userMessages"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>