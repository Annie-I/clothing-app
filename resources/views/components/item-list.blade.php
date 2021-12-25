{{-- Show user item cards --}}
<div class="row">
    @if (count($userItems) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($userItems as $item)
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p>{{(number_format((float)($item->price), 2, '.', ''))/100}}€</p>
                    @if ($item->sold_at)
                        <a href="/item/{{$item->id}}" class="btn btn-secondary mt-2">Apskatīt</a>
                    @else
                        <a href="/item/{{$item->id}}" class="btn btn-primary mt-2">Apskatīt</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>