<!doctype html>
<html lang="{{ Config::get('app.locale') }}" {!! config('tablar.layout') == 'rtl' ? 'dir="rtl"' : '' !!}>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')
    {{-- Title --}}
    <title>
        @yield('title_prefix', config('tablar.title_prefix', ''))
        @yield('title', config('tablar.title', 'Tablar'))
        @yield('title_postfix', config('tablar.title_postfix', ''))
    </title>

    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @if(config('tablar','vite'))
        @vite('resources/js/app.js')
    @endif

    {{-- Livewire Styles --}}
    @if(config('tablar.livewire'))
        @livewireStyles
    @endif

    {{-- Custom Stylesheets (post Tablar) --}}
    @yield('tablar_css')
</head>
<body>
    @yield('body')
    @include('tablar::extra.modal')

    {{-- Livewire Script --}}
    @if(config('tablar.livewire'))
        @livewireScripts
    @endif

    {{-- Custom Scripts (post Tablar) --}}
    @yield('tablar_js')

    <!-- Configuración global de AJAX y CSRF -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function sendAjaxRequest(url, method, data, successCallback, errorCallback) {
            $.ajax({
                url: url,
                type: method,
                data: data,
                success: successCallback,
                error: errorCallback
            });
        }

        $(document).ready(function() {
            $('body').on('submit', 'form[data-ajax="true"]', function(event) {
                event.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                var method = form.attr('method');
                var data = form.serialize();
                sendAjaxRequest(url, method, data, function(response) {
                    // Muestra una notificación de éxito o realiza cualquier acción deseada
                    alert('Formulario enviado con éxito');
                }, function(error) {
                    // Maneja errores
                    alert('Hubo un error al enviar el formulario');
                });
            });
        });
    </script>
</body>
</html>

