{{-- User info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body fs-5">
        <p class="col-auto"><a href="/" class="text-decoration-none text-secondary">< Visu sludinājumu saraksts</a></p>
        <h3></h3>
        <h2 class="card-title fs-3 m-2">{{$item->name}}</h2>
        <div class="row mb-2">
            <div class="col-6">
                <p class="mb-2">{{$user->first_name}} {{$user->last_name}}</p>
                {{-- cast back price to eur from eur cents --}}
                <p class="mb-2">Cena: <span class="fw-bold">{{(number_format((float)($item->price), 2, '.', ''))/100}}€</span></p>
                <p class="mb-2">Stāvoklis:  <span class="fw-bold">{{$state->name}}</span></p>
                <p class="mb-2">Atrašanās vieta:  <span class="fw-bold">{{$user->location}}</span></p>
                <p class="mb-2">Apraksts: <span class="fw-bold">{{$item->description}}</span></p>
                {{-- <p class="mb-4">Pievienoja: <span class="fw-bold">{{$user->email}}</span></p> --}}
            </div>
            <div class="col-6">
            {{-- move image to the right and info - to the left --}}
                <img src="{{Storage::url($item->image_path)}}">
            </div>
        </div>
        </div class="row">
            @if (Auth::user()->id === $item->user_id)
                <p class="col-auto"><a href="$" class="btn btn-primary">Labot sludinājumu</a></p>
                <form 
                {{-- action="/logout" method="post" class="col-auto" --}}
                >
                    @csrf
                    <div class="col-auto">
                        <button type="submit" class="btn btn-danger mb-2">Dzēst sludinājumu</p>
                    </div>
                </form>

                <form 
                    {{-- action="" --}}
                    >
                    @csrf
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary mb-2">Atzīmēt mantu kā pārdotu</p>
                    </div>
                </form>
            @else
                <p class="col-auto"><a href="#" class="btn btn-primary">Sūtīt ziņu pārdevējam</a></p>
                <p class="col-auto"><a href="/user/{{$user->id}}" class="btn btn-secondary">Apskatīt pārdevēja profilu</a></p>
            @endif
        </div>
    </div>
</div>