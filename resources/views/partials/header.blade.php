<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navigation">
            <div class="first-items">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/order">Ringen Bestellen</a>
                </li>
            </div>
            
            <div class="second-items">
            <li class="nav-item">
                <a class="nav-link" href="/profile">Profiel</a>
            </li>
            @if (Auth::check())
                <li>
                    <a class="nav-link" href="/profile/orders">Bestellingen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Uitloggen</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">Inloggen</a>
                </li>
            @endif
            @if (Auth::check() && Auth::user()->isAdmin())
                <li class="nav-item">
                    <button class="btn btn-secondary"><a class="nav-link" href="/admin">Admin</a></button>
                </li>
                
            @endif

            </div>
        </ul>
    </nav>
</header>
