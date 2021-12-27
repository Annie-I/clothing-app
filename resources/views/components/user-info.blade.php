{{-- User info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 m-2">Mani dati</h2>
        <div class="m-2">
            <p class="mb-2">Vārds: <span class="fw-bold">{{ $user->first_name }}</span></p>
            <p class="mb-2">Uzvārds:  <span class="fw-bold">{{ $user->last_name }}</span></p>
            <p class="mb-2">Dzimšanas datums: <span class="fw-bold">{{ $user->birth_date}}</span></p>
            <p class="mb-2">Atrašanās vieta:
                <span class="fw-bold">
                    @if ( $user->location )
                        {{ $user->location }}
                    @else
                        nav norādīta
                    @endif
                </span>
            </p>
            <p class="mb-4">E-pasts: <span class="fw-bold">{{ $user->email }}</span></p>
            <div class="container mb-2">
                <div class="row">
                    <p class="col-auto"><a href="edit-user-information" class="btn btn-primary">Labot datus</a></p>
                    <p class="col-auto"><a href="#" class="btn btn-secondary">Mainīt paroli</a></p>
                    <form action="{{route('user.delete', $user->id)}}" method="post" class="col-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger mb-2">Dzēst kontu</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>