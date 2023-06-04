<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/order">Ringen Bestellen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/profile">Profiel</a>
            </li>
            @if (Auth::check())
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
                    <a class="nav-link" href="/admin">Admin</a>
                </li>
                
            @endif
        </ul>
    </nav>
</header>
