@auth
    <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Abrir menú de usuario">
            <span class="avatar">{{ Auth()->user()->name[0] }}</span>
            <div class="d-none d-xl-block ps-2">
                <div>{{ Auth()->user()->name }}</div>
                <div class="mt-1 small text-muted">{{ Auth()->user()->roles->pluck('name')->implode(', ') }}</div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            @php( $logout_url = View::getSection('logout_url') ?? config('tablar.logout_url', 'logout') )
            @php( $profile_url = View::getSection('profile_url') ?? config('tablar.profile_url', 'profile') )
            @php( $setting_url = View::getSection('setting_url') ?? config('tablar.setting_url', 'roles.index') )
            @php( $users_index_url = route('users.index') ) <!-- Cambiamos a la URL del CRUD de usuarios -->

            @if (config('tablar.use_route_url', true))
                @php( $profile_url = $profile_url ? route($profile_url) : '' )
                @php( $logout_url = $logout_url ? route($logout_url) : '' )
                @php( $setting_url = $setting_url ? route($setting_url) : route('roles.index') )
            @else
                @php( $profile_url = $profile_url ? url($profile_url) : '' )
                @php( $logout_url = $logout_url ? url($logout_url) : '' )
                @php( $setting_url = $setting_url ? url($setting_url) : url('configuracion') )
            @endif

            @role('admin') <!-- Verificar si el usuario tiene el rol de admin -->
                <a href="{{ $users_index_url }}" class="dropdown-item">Registro</a> <!-- Botón ajustado para redirigir al CRUD de usuarios -->
                <a href="{{ $setting_url }}" class="dropdown-item">Configuraciones</a>
            @endrole

            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off text-red"></i> Salir
            </a>

            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('tablar.logout_method'))
                    {{ method_field(config('tablar.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endauth
