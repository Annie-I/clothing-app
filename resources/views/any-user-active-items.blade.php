<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="fs-3 m-2">{{$user->first_name}} {{$user->last_name}} aktīvo sludinājumu saraksts</p>
                    <x-item-list :userItems="$userItems"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>