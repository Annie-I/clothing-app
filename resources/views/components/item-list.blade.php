{{-- Show user item cards --}}
<div class="row">
    @if (count($userItems) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($userItems as $item)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text text-capitalize mb-2">Kategorija: {{' '}}
                        <a href="/?category={{$item->category->id}}">{{$item->category->name}}</a>
                    </p>
                    <p class="mb-2">{{(number_format((float)($item->price), 2, '.', ''))/100}}€</p>
                    @if ($item->sold_at)
                        <a href="/item/{{$item->id}}" class="btn btn-secondary">Apskatīt</a>
                    @else
                        <a href="/item/{{$item->id}}" class="btn btn-primary">Apskatīt</a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>