{{-- User public profile info --}}
<div class="card">
    <div class="card-body fs-5">
        <p class="mb-2">Vārds: <span class="fw-bold">{{ $user->first_name }}</span></p>
        <p class="mb-2">Uzvārds:  <span class="fw-bold">{{ $user->last_name }}</span></p>
        <p class="mb-2">Dzimšanas datums: <span class="fw-bold">{{ $user->birth_date}}</span></p>
        @if ( $user->location )
            <p class="mb-2">Atrodašanās vieta: <span class="fw-bold">{{ $user->location }}</span></p>
        @else 
            <p class="mb-2">Atrašanās vieta: <span class="fw-bold">nav norādīta</span></p>
        @endif
        <p class="mb-4">E-pasts: <span class="fw-bold">{{ $user->email }}</span></p>
        <div class="container class="mb-2">
            <div class="row">
                <p class="col-2">Mainīt paroli</p>
                <form action="/logout" method="post" class="col-2">
                    @csrf
                    <button type="submit" class="btn del_btn mb-2">Dzēst kontu</a>
                </form>
            </div>
        </div>
        {{-- TODO: Add edit buttons --}}
    </div>
</div>