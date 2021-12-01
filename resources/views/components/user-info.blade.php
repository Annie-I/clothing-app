{{-- User info --}}
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 m-2">Mani dati</h2>
        <div class="m-2">
            <p class="mb-2">Vārds: <span class="fw-bold">{{ $user->first_name }}</span></p>
            <p class="mb-2">Uzvārds:  <span class="fw-bold">{{ $user->last_name }}</span></p>
            <p class="mb-2">Dzimšanas datums: <span class="fw-bold">{{ $user->birth_date}}</span></p>
            @if ( $user->location )
                <p class="mb-2">Atrodašanās vieta: <span class="fw-bold">{{ $user->location }}</span></p>
            @else
                <p class="mb-2">Atrašanās vieta: <span class="fw-bold">nav norādīta</span></p>
            @endif
            <p class="mb-4">E-pasts: <span class="fw-bold">{{ $user->email }}</span></p>
            <div class="container mb-2">
                <div class="row">
                    <p class="col-2"><a href="/edit-user-data" class="btn btn-primary">Labot datus</a></p>
                    <p class="col-2"><a href="#" class="btn btn-primary">Mainīt paroli</a></p>
                    <form action="/logout" method="post" class="col-2">
                        @csrf
                        <button type="submit" class="btn btn-danger mb-2">Dzēst kontu</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>