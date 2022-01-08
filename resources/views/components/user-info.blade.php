{{-- User info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 mb-3">Mani dati</h2>
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
        <a href="edit-user-information" class="btn btn-primary full-width mr-3 mb-2">Labot datus</a>
        <a href="/change-password" class="btn btn-secondary full-width mr-3 mb-2">Mainīt paroli</a>
        <form action="{{route('user.delete', $user->id)}}" method="post" class="d-inline align-top">
            @csrf
            <button type="submit" class="btn btn-danger full-width">Dzēst kontu</button>
        </form>
    </div>
</div>