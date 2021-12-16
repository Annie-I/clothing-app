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
                            @foreach ($items as $item)
                                <div class="col-3">
                                    <div class="card">
                                        <img src="{{Storage::url($item->image_path)}}" class="card-img-top">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$item->name}}</h5>
                                            {{-- TODO: cast back price to eur from eur cents --}}
                                            <p class="card-text">{{$item->price}} € {{$item->state_id}}</p>
                                            {{-- dispaly state name --}}
                                            <p class="card-tex filler_text text-truncate">Lietotāja atrašanās vieta</p>
                                            {{-- get user location --}}
                                            <a href="#" class="btn btn-primary mt-2">Apskatīt</a>
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