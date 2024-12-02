@extends('tablar::auth.layout')
@section('title', 'inicio de sesion')
@section('content')
    <div class="container container-tight py-4">
        <div class="text-center mb-1 mt-5">
            <a href="" class="navbar-brand navbar-brand-autodark">
                <img src="{{asset(config('tablar.auth_logo.img.path','assets/logo.svg'))}}" height="36"
                     alt=""></a>
        </div>
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Bienvenido</h2>
                <form action="{{route('login')}}" method="post" autocomplete="off" novalidate>
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                               placeholder="Usuario@hotmail.com"
                               autocomplete="off">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Contraseña
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}">Olvide la contraseña</a>
                            </span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" autocomplete="off">
                            <span class="input-group-text">
                                <a href="#" class="link-secondary" title="Mostrar contraseña" data-bs-toggle="tooltip" id="toggle-password">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <circle cx="12" cy="12" r="2"/>
                                        <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"/>
                                    </svg>
                                </a>
                            </span>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <script>
                        document.getElementById('toggle-password').addEventListener('click', function (e) {
                            e.preventDefault();
                            const passwordField = document.getElementById('password');
                            const passwordFieldType = passwordField.getAttribute('type');
                            const togglePassword = document.getElementById('toggle-password');
                            if (passwordFieldType === 'password') {
                                passwordField.setAttribute('type', 'text');
                                togglePassword.setAttribute('title', 'Ocultar contraseña');
                            } else {
                                passwordField.setAttribute('type', 'password');
                                togglePassword.setAttribute('title', 'Mostrar contraseña');
                            }
                        });
                    </script>
                    
                    
                    
                    
                    <div class="mb-2">
                        <label class="form-check">
                            <input type="checkbox" class="form-check-input"/>
                            <span class="form-check-label">Recuerdame</span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Inicio</button>
                    </div>
                </form>
            </div>
            <div class="hr-text">Ayuda</div>
           <div class="card-body">
    <div class="row">
        <div class="col">
            <a href="https://wa.me/4471103795?text=Buen%20dia%20apreciable%20alumno.%20%C2%BFEn%20que%20podemos%20ayudarte%3F%2C%20te%20recordamos%20que%20el%20horario%20de%20atencion%20es%20de%208%20de%20la%20ma%C3%B1ana%20a%203%20de%20la%20tarde%2C%20agradecemos%20tu%20entendimiento."
               class="btn btn-white w-100">
                <!-- Download SVG icon from http://tabler-icons.io/i/brand-whatsapp -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-whatsapp" width="24" height="24"
                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path
                        d="M3 21l1.65 -4.65a8 8 0 1 1 3.6 3.6l-4.65 1.65m4.65 -1.65a8 8 0 1 0 -3.6 -3.6"/>
                    <path
                        d="M9 10a1 1 0 0 1 1 -1h1a1 1 0 0 1 1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 1 -1 -1v-1a1 1 0 0 0 -1 -1h-1a1 1 0 0 1 -1 -1v-1"/>
                </svg>
                Contactar por WhatsApp
            </a>
        </div>
    </div>
</div>

        @if(Route::has('register'))
            
        @endif
    </div>
@endsection
