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
                <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column sidebar-menu" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('home.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt elevation-3"></i>
                            <span class="brand-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Question Game
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('quiz-game.choices') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quiz Choice</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quiz-game.matches') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quiz Matches</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('quiz-game.completes') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Quiz Completes</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-list-alt elevation-3"></i>
                            <span class="brand-text">Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-question-circle"></i>
                            <p>
                                Assessment
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('question.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Assessment Question</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('assessment.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="brand-text">Assessment History</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('leaderboard.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-trophy elevation-3"></i>
                            <span class="brand-text">LeaderBoard</span>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user elevation-3"></i>
                            <p>
                                User Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('department.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="brand-text">Department</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('team.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="brand-text">Team</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <span class="brand-text">Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('settings.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-cogs elevation-3"></i>
                            <span class="brand-text">Setting</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('activity-log.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-th elevation-3"></i>
                            <span class="brand-text">Activity Logs</span>
                        </a>
                    </li>
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

@livewireScripts
<script src="{{ asset('js/app.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap4 js-->
<script src="{{URL::asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- INTERNAL Clipboard js -->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>

<!-- INTERNAL Prism js -->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

<!--INTERNAL Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>

<!-- INTERNAL Popover js -->
    <script src="{{URL::asset('assets/js/popover.js')}}"></script>

<!-- INTERNAL Sweet alert js -->
<script src="{{URL::asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
<script src="{{URL::asset('assets/js/sweet-alert.js')}}"></script>

<script type="text/javascript">
    var url = window.location;
    // for sidebar menu but not for treeview submenu
    $('ul.sidebar-menu a.nav-link').filter(function() {
        return this.href == url;
    }).siblings().removeClass('active').end().addClass('active');
    // for treeview which is like a submenu
    $('ul.nav-treeview a.nav-link').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .nav-treeview").siblings().removeClass('active menu-open').end().addClass('active menu-open');
</script>
@yield('scripts')

@stack('scripts')

</body>

</html>
