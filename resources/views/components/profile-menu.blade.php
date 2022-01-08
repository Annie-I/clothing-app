<!-- User dashborad side menu -->
<div class="card">
    <nav class="list-group list-group-flush">
        <a href="/dashboard" class="list-group-item list-group-item-action {{request()->is('dashboard') ? 'active' : ''}}">Mans profils</a>
        <a href="/received-messages" class="list-group-item list-group-item-action {{request()->is('received-messages', 'sent-messages') ? 'active' : ''}}">Ziņas</a>
        <a href="/user-information" class="list-group-item list-group-item-action {{request()->is('user-information') ? 'active' : ''}}">Lietotāja informācija</a>
        <a href="/favorites" class="list-group-item list-group-item-action {{request()->is('favorites') ? 'active' : ''}}">Favorītu saraksts</a>
        <a href="/add-item" class="list-group-item list-group-item-action {{request()->is('add-item') ? 'active' : ''}}">Pievienot mantu pārdošanai</a>
        <a href="/my-active-items" class="list-group-item list-group-item-action {{request()->is('my-active-items', 'my-sold-items') ? 'active' : ''}}">Mani sludinājumi</a>
    </nav>
</div>

{{-- display admin options only if user is marked as admin --}}
@if (Auth::user()->is_admin)
    <div class="card mt-3">
        <nav class="list-group list-group-flush">
            <a href="/new-complaint-list" class="list-group-item list-group-item-action 
                {{request()->is('new-complaint-list', 'in-progress-complaint-list', 'closed-complaint-list') ? 'active' : ''}}">
                Saņemtās sūdzības
            </a>
            <a href="/blocked-users" class="list-group-item list-group-item-action">Bloķētie lietotāji</a>
        </nav>
    </div>
@endif