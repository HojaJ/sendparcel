
<header class="header header-sticky mb-2">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <a class="header-brand d-sm-none" href="#">
            <img class="sidebar-brand-full" src="{{asset('logo_colo.png')}}" height="46" alt="{{ app_name() }}">
        </a>
        <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="{{ route('frontend.index') }}" target="_blank">&nbsp;<i class="fa-solid fa-arrow-up-right-from-square"></i></a></li>
        </ul>

        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-language"></i>&nbsp; {{strtoupper(App::getLocale())}}
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">{{ __('Change language') }}</div>
                    </div>
                    @foreach(config('app.available_locales') as $locale_code => $locale_name)
                    <a class="dropdown-item" href="{{route('language.switch', $locale_code)}}">
                        {{ $locale_name }}
                    </a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="mt-2">
                        {{ auth()->user()->first_name }}{{ auth()->user()->last_name }}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">{{ __('Account') }}</div>
                    </div>
                    <a class="dropdown-item" href="{{route('backend.users.profileEdit', Auth::user()->id)}}">
                        <i class="fa-regular fa-user me-2"></i>&nbsp;{{ __('Edit') }}
                    </a>

                    <div class="dropdown-divider"></div>

                    <div class="dropdown-header bg-light py-2"><strong>@lang('Settings')</strong></div>

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>&nbsp;
                        @lang('Logout')
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
                </div>
            </li>
        </ul>
    </div>

    <div class="header-divider"></div>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                @yield('breadcrumbs')
            </ol>
        </nav>

    </div>
</header>