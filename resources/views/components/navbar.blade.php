<div class="navbar-container">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Big City</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}" data-no="1">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item {{ Request::routeIs('contacts') ? 'active' : '' }}">
                                <a class="dropdown-item" href="{{ route('child1') }}">Child1</a>
                            </li>
                            <li class="nav-item {{ Request::routeIs('contacts') ? 'active' : '' }}">
                                <a class="dropdown-item" href="{{ route('child1') }}">Child2</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ Request::routeIs('gallery') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('about') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('contacts') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('contacts') }}">Contacts</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>