<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fs-3 m-2">Par lietotāju x y atstātās atsauksmes</p>
                        <div class="row">
                            @if (!$reviews)
                                <p>Sarakstam šobrīd nav pievienots neviens favorīts.</p>
                            @endif
                            @foreach ($reviews as $review)
                                <div class="col-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$review->rating}} / 5</h5>
                                            <p>{{$review->review}}</p>
                                            <p>No: {{$review->user->first_name}} {{$review->user->last_name}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
