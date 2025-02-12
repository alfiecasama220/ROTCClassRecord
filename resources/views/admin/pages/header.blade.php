
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4 bg-dark">
        <a class="navbar-brand" href="#">MDC ROTC E-CLASS RECORD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.index') }}">Dashboard</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">Grading</a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#">Reports</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}">Logout</a>
                </li>
            </ul>
        </div>
    </nav>