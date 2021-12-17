<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5> Visi sludinājumi </h5>
                    <div class="row mt-10">
                        @if (empty($items))
                            <p>Pagaidām nav pievienots neviens sludinājums.</p>
                        @else
                        {{-- make a card for each item --}}
                            @foreach ($items as $item)
                                <div class="col-3">
                                    <div class="card mb-4">
                                        <img src="{{Storage::url($item->image_path)}}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->name}}</h5>
                                            {{-- cast back price to eur from eur cents --}}
                                            <p class="card-text"> {{(number_format((float)($item->price), 2, '.', ''))/100}}€ {{$item->state->name}}</p>
                                            <p class="card-tex text-truncate">{{$item->user->location ? $item->user->location : 'Atrašanās vieta nav norādīta'}}</p>
                                            <a href="/item/{{$item->id}}" class="btn btn-primary mt-2">Apskatīt</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>