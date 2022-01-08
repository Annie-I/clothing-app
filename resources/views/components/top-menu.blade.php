<nav class="p-3">
    <div class="row">
        <div class="col-6 col-md-3 d-none d-md-block">
            <p class="fs-3 mb-0">
                <a href="/" class="text-body text-decoration-none">Mantu Tirgus</a>
            </p>
        </div>
        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center">
                <ul class="nav">
                    <li>
                        <a class="nav-link link-dark" href="/" role="button">
                            Visi sludinājumi
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Sievietēm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/?category=1">Aksesuāri</a></li>
                            <li><a class="dropdown-item" href="/?category=2">Apavi</a></li>
                            <li><a class="dropdown-item" href="/?category=3">Apģērbs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Vīriešiem
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/?category=4">Aksesuāri</a></li>
                            <li><a class="dropdown-item" href="/?category=5">Apavi</a></li>
                            <li><a class="dropdown-item" href="/?category=6">Apģērbs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Bērniem
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/?category=7">Aksesuāri</a></li>
                            <li><a class="dropdown-item" href="/?category=8">Apavi</a></li>
                            <li><a class="dropdown-item" href="/?category=9">Apģērbs</a></li>
                            <li><a class="dropdown-item" href="/?category=10">Rotaļlietas</a></li>
                            <li><a class="dropdown-item" href="/?category=11">Skolai</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link link-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Mājai un dārzam
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/?category=12">Dekori</a></li>
                            <li><a class="dropdown-item" href="/?category=13">Grāmatas</a></li>
                            <li><a class="dropdown-item" href="/?category=14">Interjera priekšmeti</a></li>
                            <li><a class="dropdown-item" href="/?category=15">Mēbeles</a></li>
                            <li><a class="dropdown-item" href="/?category=16">Remontam</a></li>
                            <li><a class="dropdown-item" href="/?category=17">Tehnika</a></li>
                            <li><a class="dropdown-item" href="/?category=18">Instrumenti</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-12 col-md-3">
            <div class="d-flex justify-content-end">
                @if (Auth::guest())
                    <a href="/register" class="btn btn-link link-dark text-decoration-none mr-3">Reģistrēties</a>
                    <a href="/login" class="btn login_btn">Ieiet</a>
                @else 
                    <a href="/dashboard" class="btn btn-link link-dark text-decoration-none">Profils</a>
                    <form action="/logout" method="post" class="d-inline align-top">
                        @csrf
                        <button type="submit" class="btn login_btn">Iziet</a>
                    </form>
                @endif
            </div>
        </div>
    </div>
</nav>
