{{-- Single item information view --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="card">
    <div class="card-body fs-5">
        {{-- Item name --}}
        <h2 class="card-title fs-3">{{$item->name}}</h2>
        {{-- Item category --}}
        <p class="text-capitalize">
            <a href="/?category={{$item->category->id}}">{{$item->category->name}}</a>
        </p>
        <hr>
        <div class="row mb-4">
            {{-- Item picture --}}
            <div class="col-12 col-md-6 order-md-2 mb-4">
                <img class="item-img" src="{{Storage::url($item->image_path)}}">
            </div>
            <div class="col-12 col-md-6 order-md-1">
                {{-- User who added this item with option to go to his profile --}}
                <p class="mb-2 fw-bold">
                    Pievienoja:
                    <a href="/user/{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</a>
                </p>
                {{-- Item price with casting it back to eur from eur cents --}}
                <p class="mb-2"><span class="fw-bold">Cena:</span> {{(number_format((float)($item->price), 2, '.', ''))/100}}€</p>
                {{-- Item state --}}
                <p class="mb-2"><span class="fw-bold">Stāvoklis:</span> {{$state->name}}</p>
                {{-- User location if he has added it to his profile --}}
                @if ($user->location)
                    <p class="mb-2"><span class="fw-bold"> Lietotāja atrašanās vieta:</span> {{$user->location}}</p>
                @endif
                {{-- Item description --}}
                <p class="mb-2"><span class="fw-bold">Mantas apraksts:</span> {{$item->description}}</p>
            </div>
        </div>
        {{-- Buttons --}}
        @if (Auth::user())
            {{-- If item owner is viewing this: --}}
            @if (Auth::user()->id === $item->user_id)

                <a href="{{route('item.edit', $item->id)}}" class="btn btn-primary full-width mr-3 mb-2">Labot sludinājumu</a>
            
                <form  method="post" action="{{route('item.delete', $item->id)}}" class="d-inline align-top">
                    @csrf
                    <button type="submit" class="btn btn-danger full-width mr-3 mb-2">Dzēst sludinājumu</button>
                </form>
                <form method="POST" action="{{route('item.sale.status', $item->id)}}" class="d-inline align-top">
                    @csrf
                    @if ($item->sold_at)
                        <button type="submit" class="btn btn-secondary full-width">Ievietot pārdošanā</button>
                    @else
                        <button type="submit" class="btn btn-secondary full-width">Atzīmēt kā pārdotu</button>
                    @endif
                </form>

            {{-- If any other user who does not own this item is viewing this: --}}
            @else
                <a href="/user/{{$user->id}}/compose-message" class="btn btn-primary full-width mr-3 mb-2">Sūtīt ziņu pārdevējam</a>
            @endif
            {{-- If other user who is an admin is viewing this: --}}
            @if (Auth::user()->is_admin && Auth::user()->id !== $item->user_id)
                <form method="post" action="{{route('item.delete', $item->id)}}" class="d-inline align-top">
                    @csrf
                    <button type="submit" class="btn btn-danger full-width mr-3">Dzēst sludinājumu</button>
                </form>
            @endif
            {{-- If other user who is not an admin is viewing this: --}}
            @if (!Auth::user()->is_admin && Auth::user()->id !== $item->user_id)
                <a href="/compose-complaint" class="btn btn-danger full-width align-top">Ziņot par pārkāpumu</a>
            @endif
        @else
            <p>Lai nosūtītu ziņu mantas īpašniekam, nepieciešams <a href="/login" class="text-body fw-bold">pieteikties sistēmā</a>.</p>
        @endif
    </div>
</div>