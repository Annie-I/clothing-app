<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @if (isset($category)) 
                        <h5 class="text-capitalize">{{ $category->name }}</h5>
                    @else
                        <h5> Visi sludinājumi </h5>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="row mt-10">
                        @if (count($items) === 0)
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
                                            <p class="card-text">{{$item->state->name}} <span class="text-secondary">|</span> {{(number_format((float)($item->price), 2, '.', ''))/100}}€ </p>
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