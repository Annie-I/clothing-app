<nav class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="d-flex align-items-center col-md-3">
    </div>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li>
            <a class="nav-link link-dark" href="/" role="button">
                Visi sludinājumi
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                Sievietēm
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?category=1">Aksesuāri</a></li>
                <li><a class="dropdown-item" href="?category=2">Apavi</a></li>
                <li><a class="dropdown-item" href="?category=3">Apģērbs</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                Vīriešiem
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?category=4">Aksesuāri</a></li>
                <li><a class="dropdown-item" href="?category=5">Apavi</a></li>
                <li><a class="dropdown-item" href="?category=6">Apģērbs</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                Bērniem
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?category=7">Aksesuāri</a></li>
                <li><a class="dropdown-item" href="?category=8">Apavi</a></li>
                <li><a class="dropdown-item" href="?category=9">Apģērbs</a></li>
                <li><a class="dropdown-item" href="?category=10">Rotaļlietas</a></li>
                <li><a class="dropdown-item" href="?category=11">Skolai</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link link-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                Mājai un dārzam
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?category=12">Dekori</a></li>
                <li><a class="dropdown-item" href="?category=13">Grāmatas</a></li>
                <li><a class="dropdown-item" href="?category=14">Interjera priekšmeti</a></li>
                <li><a class="dropdown-item" href="?category=15">Mēbeles</a></li>
                <li><a class="dropdown-item" href="?category=16">Remontam</a></li>
                <li><a class="dropdown-item" href="?category=17">Tehnika</a></li>
                <li><a class="dropdown-item" href="?category=18">Instrumenti</a></li>
            </ul>
        </li>
    </ul>
    <div class="col-md-3 d-flex justify-content-end">
        @if (Auth::guest())
            <a href="/register" class="btn btn-link link-dark text-decoration-none me-2">Reģistrēties</a>
            <a href="/login" class="btn login_btn me-4">Ieiet</a>
        @else 
            <div class="row">
                <a href="/dashboard" class="btn btn-link link-dark text-decoration-none me-2 col-auto">Profils</a>
                <div class="col-auto">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn login_btn mr-3">Iziet</a>
                    </form>
                </div>
            </div>
        @endif
    </div>
</nav>
