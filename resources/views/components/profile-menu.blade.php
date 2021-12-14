<!-- Dashborad sidebar -->
<div class="card">
    <nav class="list-group list-group-flush">
        <a href="/dashboard" class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">Publiskais profils</a>
        <a href="/messages" class="list-group-item list-group-item-action {{ request()->is('messages') ? 'active' : '' }}">Ziņas</a>
        <a href="/user-information" class="list-group-item list-group-item-action {{ request()->is('user-information') ? 'active' : '' }}">Mani dati</a>
        <a href="/favorites" class="list-group-item list-group-item-action {{ request()->is('favorites') ? 'active' : '' }}">Favorītu saraksts</a>
        <a href="/add-item" class="list-group-item list-group-item-action {{ request()->is('add-item') ? 'active' : '' }}">Pievienot mantu pārdošanai</a>
        <a href="#" class="list-group-item list-group-item-action">Visi mani sludinājumi</a>
    </nav>
</div>