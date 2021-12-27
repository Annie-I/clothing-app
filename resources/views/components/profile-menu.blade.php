<!-- User dashborad side menu -->
<div class="card">
    <nav class="list-group list-group-flush">
        <a href="/dashboard" class="list-group-item list-group-item-action {{request()->is('dashboard') ? 'active' : ''}}">Mans profils</a>
        <a href="/received-messages" class="list-group-item list-group-item-action {{request()->is('received-messages') ? 'active' : ''}}">Ziņas</a>
        <a href="/user-information" class="list-group-item list-group-item-action {{request()->is('user-information') ? 'active' : ''}}">Lietotāja informācija</a>
        <a href="/favorites" class="list-group-item list-group-item-action {{request()->is('favorites') ? 'active' : ''}}">Favorītu saraksts</a>
        <a href="/add-item" class="list-group-item list-group-item-action {{request()->is('add-item') ? 'active' : ''}}">Pievienot mantu pārdošanai</a>
        <a href="/my-active-items" class="list-group-item list-group-item-action {{request()->is('my-active-items') ? 'active' : ''}}">Mani sludinājumi</a>
    </nav>
</div>