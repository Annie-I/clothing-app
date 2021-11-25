{{-- User public profile info --}}
<div class="card">
    <div class="card-body">
        <p class="fs-2">{{ $user->first_name }} {{ $user->last_name }}</p>
        @if ( $user->location )
            <p class="fs-6">Atrodašanās vieta: {{ $user->location }}</p>
        @endif
        <p class="fs-5 mt-5">Atsauksmes</p>
        {{-- TODO: Show user reviews --}}
    </div>
</div>