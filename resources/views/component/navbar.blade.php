<nav class="navbar">
    <div class="container">
        <div class="navbar-brand large">
            <a class="navbar-item" href="{{ route('home') }}">
                <img src="{{ url('images/logo.jpg') }}" alt="Logo"> &nbsp;&nbsp;
                <h1 class="title">التنسيق</h1>
            </a>
            <span class="navbar-burger burger" data-target="navbarMenu">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        {{ auth()->user()->name }}
                    </a>
                    <div class="navbar-dropdown">
                        <a href="{{ route('logout') }}" class="navbar-item"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            تسجيل الخروج
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>