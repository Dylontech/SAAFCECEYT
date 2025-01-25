<form id="miFormulario" method="POST">
    @csrf
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('numero_control', 'Numero de Control') }}</label>
        <div>
            {{ Form::text('numero_control', $alumno->numero_control, ['class' => 'form-control' . ($errors->has('numero_control') ? ' is-invalid' : ''), 'placeholder' => 'Numero de Control']) }}
            {!! $errors->first('numero_control', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo número de control del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('CURP') }}</label>
        <div>
            {{ Form::text('CURP', $alumno->CURP, ['class' => 'form-control' . ($errors->has('CURP') ? 'is-invalid' : ''), 'placeholder' => 'CURP']) }}
            {!! $errors->first('CURP', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo CURP del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('especialidad', 'Especialidad') }}</label>
        <div>
            {{ Form::select('especialidad', [
                'diseño grafico digital' => 'Diseño Gráfico Digital',
                'ventas' => 'Ventas',
                'produccion industrial de alimentos' => 'Producción Industrial de Alimentos',
                'NA' => 'NA'
            ], $alumno->especialidad, ['class' => 'form-control' . ($errors->has('especialidad') ? 'is-invalid' : ''), 'placeholder' => 'Selecciona una especialidad']) }}
            {!! $errors->first('especialidad', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa la nueva especialidad del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('semestre', 'Semestre') }}</label>
        <div>
            <select id="semestre-select" name="semestre" class="form-control mb-3">
                <option value="" selected disabled>Selecciona un semestre</option>
                <option value="1" {{ $alumno->semestre == '1' ? 'selected' : '' }}>Semestre 1</option>
                <option value="2" {{ $alumno->semestre == '2' ? 'selected' : '' }}>Semestre 2</option>
                <option value="3" {{ $alumno->semestre == '3' ? 'selected' : '' }}>Semestre 3</option>
                <option value="4" {{ $alumno->semestre == '4' ? 'selected' : '' }}>Semestre 4</option>
                <option value="5" {{ $alumno->semestre == '5' ? 'selected' : '' }}>Semestre 5</option>
                <option value="6" {{ $alumno->semestre == '6' ? 'selected' : '' }}>Semestre 6</option>
            </select>
            {!! $errors->first('semestre', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo semestre del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('Grupo') }}</label>
        <div>
            <select id="grupo-select" name="Grupo" class="form-control">
                <option value="" selected disabled>Selecciona un grupo</option>
                <!-- Los grupos se agregarán dinámicamente aquí -->
            </select>
            {!! $errors->first('Grupo', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo grupo del alumno.</small>
        </div>
    </div>
    
    <script>
    document.getElementById('semestre-select').addEventListener('change', function() {
        const semestre = this.value;
        const grupoSelect = document.getElementById('grupo-select');
        grupoSelect.innerHTML = '<option value="" selected disabled>Selecciona un grupo</option>';

        const grupos = {
            1: ['124', '128', '129a', '129b', '129c'],
            2: ['224', '228', '229a', '229b', '229c'],
            3: ['324', '328', '329a', '329b', '329c'],
            4: ['424', '428', '429a', '429b', '429c'],
            5: ['524', '528', '529a', '529b', '529c'],
            6: ['624', '628', '629a', '629b']
        };

        if (grupos[semestre]) {
            grupos[semestre].forEach(function(grupo) {
                const option = document.createElement('option');
                option.value = grupo;
                option.textContent = grupo;
                grupoSelect.appendChild(option);
            });
        }
    });

    // Sincronizar el valor seleccionado del select con el campo hidden
    document.getElementById('estatus-select').addEventListener('change', function() {
        const estatusInput = document.getElementById('estatus-input');
        estatusInput.value = this.value;
    });
    </script>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('Nombre') }}</label>
        <div>
            {{ Form::text('Nombre', $alumno->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? 'is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo nombre del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('email') }}</label>
        <div>
            {{ Form::text('email', $alumno->email, ['class' => 'form-control' . ($errors->has('email') ? 'is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, ingresa el nuevo email del alumno.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">{{ Form::label('estatus') }}</label>
        <div>
            <select id="estatus-select" name="estatus" class="form-control">
                <option value="" selected disabled>Selecciona un estatus</option>
                <option value="Activo" {{ $alumno->estatus == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $alumno->estatus == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Por favor, selecciona el estatus del alumno.</small>
        </div>
    </div>
    <div id="mensajeExito" class="alert alert-success" style="display:none;">
        Registro guardado con éxito.
    </div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('alumnos.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto">Enviar</button>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('miFormulario').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevenir la recarga de la página
    console.log('Formulario enviado'); // Verificar si se está interceptando el envío

    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/guardarRegistro', true); // Cambia esta URL a la de tu API
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response.success);
            document.getElementById('mensajeExito').style.display = 'block';
            setTimeout(function() {
                document.getElementById('mensajeExito').style.display = 'none';
            }, 3000); // Ocultar el mensaje después de 3 segundos
            document.getElementById('miFormulario').reset();
        } else if (xhr.readyState == 4) {
            alert('Error al guardar el registro');
        }
    };

    xhr.send(formData);
});
</script>
