<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('layouts._head')

<body
        class="sidebar-mini layout-fixed"
        x-data="window.nav.make()"
        :class="{ 'sidebar-open' : collapsed }"
        x-ref="body"
>

<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                        x-on:click="click()"
                        @click.away="clickAway()"
                        class="nav-link clickAwayData"
                        href="#"
                >
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu" x-data="{ open: false }">
                <a href="#" class="nav-link" x-on:click="open= true">
                    <img src="{{ auth()->user()->imageFile }}" class="user-image img-circle elevation-2"
                         alt="User Image">
                    <span class="d-none d-md-inline">{{ auth()->user()->email }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" x-bind:class="{ 'show': open }"
                    x-on:click.away="open= false" x-cloak>
                    <li class="user-header bg-primary">
                        <img src="{{ auth()->user()->imageFile }}" class="img-circle elevation-2">
                        <p>
                            {{ auth()->user()->email }}
                        </p>
                    </li>

                    <li class="user-footer">
                        <a href="{{ route('profile.users.index') }}" class="btn btn-default btn-flat">Profile</a>

                        <a
                                href="#"
                                class="btn btn-default btn-flat float-right"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                        >
                            {{ __('Sign Out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4 x-cloak">
        <a href="{{ url('/') }}" class="brand-link logo-switch">
            <img src="{{asset('images/logo.png')}}" alt="Adins" class="brand-image-xl logo-xs">
            <img src="{{asset('images/logo.png')}}" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl"
                 style="left: 12px">
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('home.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt elevation-3"></i>
                            <span class="brand-text">Dashboard</span>
                        </a>
                    </li>

                    @can('for-route', ['users.index'])
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-user elevation-3"></i>
                                <span class="brand-text">Users</span>
                            </a>
                        </li>
                    @endcan

                    {{--  @can('for-route', ['roles.index'])
                          <a href="{{ route('roles.index') }}" class="brand-link">
                              <i class="nav-icon fas fa-users elevation-3"></i>
                              <span class="brand-text">Roles</span>
                          </a>
                      @endcan--}}
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">

        <section class="content-header">
            @yield('content-header')
        </section>

        <section class="content">
            @include('layouts._flash')

            @yield('content')
        </section>
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; {{ date('Y') }}.</strong>
    </footer>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@livewireScripts

<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')

@stack('scripts')

<script>

    $('.clickAwayData').trigger("click")

</script>
</body>

</html>
