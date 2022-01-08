<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success m-3">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger m-3">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="card-body">
                    @if (isset($category)) 
                        <h1 class="text-capitalize fs-3 mb-3">{{ $category->name }}</h1>
                    @else
                        <h1 class="fs-3 mb-3">Visi sludinājumi</h1>
                    @endif
                    <div class="row mt-10">
                        @if (count($items) === 0)
                            <p>Pagaidām nav pievienots neviens sludinājums.</p>
                        @else
                        {{-- make a card for each item --}}
                            @foreach ($items as $item)
                                <div class="col-12 col-md-4 col-lg-3">
                                    <div class="card mb-2">
                                        <a href="/item/{{$item->id}}"><img src="{{Storage::url($item->image_path)}}" class="card-img-top"></a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->name}}</h5>
                                            <p class="card-text text-capitalize">Kategorija: {{' '}}
                                                <a href="/?category={{$item->category->id}}">{{$item->category->name}}</a>
                                            </p>
                                            {{-- cast back price to eur from eur cents --}}
                                            <p class="card-text text-capitalize">{{$item->state->name}} <span class="text-secondary">|</span> {{(number_format((float)($item->price), 2, '.', ''))/100}}€ </p>
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