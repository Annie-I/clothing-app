<!-- User favorite list -->
<div class="card">
    <div class="card-body">
        <p class="fs-3 m-2">Manu favorītu saraksts</p>
        <div class="row">
            @foreach ($userFavorites as $favorite)
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title filler_text">{{$favorite->first_name}} {{$favorite->last_name}}</h5>
                            <p class="card-text filler_text">Kurās kategorijās pārdod mantas.</p>
                            <a href="/user/{{$favorite->id}}" class="btn btn-primary mt-2">Atvērt profilu</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>