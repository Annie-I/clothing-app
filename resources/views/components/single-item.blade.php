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
        <h2 class="card-title fs-3 m-2">{{$item->name}}</h2>
        {{-- Item category --}}
        <p class="text-capitalize m-2">{{$category->name}}</p>
        <hr>
        <div class="row mb-2">
            <div class="col-6">
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
            {{-- Item picture --}}
            <div class="col-6">
                <img src="{{Storage::url($item->image_path)}}">
            </div>
        </div>
        {{-- Buttons --}}
        <div class="row">
            @if (Auth::user())
                {{-- If item owner is viewing this: --}}
                @if (Auth::user()->id === $item->user_id)
                <div class="col-auto">
                    <p><a href="{{route('item.edit', $item->id)}}" class="btn btn-primary">Labot sludinājumu</a></p>
                </div>
                <div class="col-auto">
                    <form  method="post" action="{{route('item.delete', $item->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Dzēst sludinājumu</p>
                    </form>
                </div>
                <div class="col-auto">
                    <form method="POST" action="{{route('item.sale.status', $item->id)}}"
                        >
                        @csrf
                        @if ($item->sold_at)
                            <button type="submit" class="btn btn-secondary">Ievietot pārdošanā</p>
                        @else
                            <button type="submit" class="btn btn-secondary">Atzīmēt kā pārdotu</p>
                        @endif
                    </form>
                </div>
                {{-- If any other user who does not own this item is viewing this: --}}
                @else
                    <p class="col-auto"><a href="/user/{{$user->id}}/compose-message" class="btn btn-primary">Sūtīt ziņu pārdevējam</a></p>
                @endif
                {{-- If other user who is an admin is viewing this: --}}
                <div class="col-auto">
                    @if (Auth::user()->is_admin && Auth::user()->id !== $item->user_id)
                        <form method="post" action="{{route('item.delete', $item->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-danger">Dzēst sludinājumu</p>
                        </form>
                    @endif
                </div>
                {{-- If other user who is not an admin is viewing this: --}}
                <div class="col-auto">
                    @if (!Auth::user()->is_admin && Auth::user()->id !== $item->user_id)
                    <p class="col-auto"><a href="/compose-complaint" class="btn btn-danger">Ziņot par pārkāpumu</a></p>
                    @endif
                </div>
            @else
                <p>Lai nosūtītu ziņu mantas īpašniekam, nepieciešams <a href="/login" class="text-body fw-bold">pieteikties sistēmā</a>.</p>
            @endif
        </div>
    </div>
</div>