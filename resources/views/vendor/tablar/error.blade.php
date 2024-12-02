@hasSection('code')
    <div class="container-tight py-4">
        <div class="empty">
            <div class="empty-header">@yield('code')</div>
            <p class="empty-title">Vaya... Acabas de encontrar una página de error.</p>
            <p class="empty-subtitle text-secondary">
                @yield('message')
            </p>
            <div class="empty-action">
                <a href="./." class="btn btn-primary">
                    <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l14 0"></path>
                        <path d="M5 12l6 6"></path>
                        <path d="M5 12l6 -6"></path>
                    </svg>
                    Inicio
                </a>
            </div>
        </div>
    </div>
@endif
