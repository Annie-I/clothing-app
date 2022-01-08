<!-- User favorite list -->
<div class="card">
    <div class="card-body">
        <p class="fs-3 m-2">Manu favorītu saraksts</p>
        <div class="row">
            @if (count($userFavorites) === 0)
                <p>Sarakstam šobrīd nav pievienots neviens favorīts.</p>
            @endif
            @foreach ($userFavorites as $favorite)
                <div class="col-12 col-md-6 col-lg-4 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{$favorite->first_name}} {{$favorite->last_name}}</h5>
                            <p>{{$favorite->location}}</p>
                            <a href="/user/{{$favorite->id}}" class="btn btn-primary mt-2">Atvērt profilu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>