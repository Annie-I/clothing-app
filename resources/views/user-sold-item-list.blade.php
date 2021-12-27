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
                            <h2 class="card-title fs-3 m-2">Manu sludinājumu saraksts</h2>
                            <ul class="nav nav-tabs mb-2">
                                <li class="nav-item">
                                    <a class="nav-link text-secondary" href="/my-active-items">Aktīvie sludinājumi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="/my-sold-items">Pārdotās mantas</a>
                                </li>
                            </ul>
                    <x-item-list :userItems="$userItems"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>