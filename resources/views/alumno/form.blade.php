<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Matricula') }}</label>
    <div>
        {{ Form::text('Matricula', $alumno->Matricula, ['class' => 'form-control' . ($errors->has('Matricula') ? ' is-invalid' : ''), 'placeholder' => 'Matricula']) }}
        {!! $errors->first('Matricula', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa la nueva matrícula del alumno.</small>
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
    <label class="form-label">{{ Form::label('Carrera') }}</label>
    <div>
        {{ Form::text('Carrera', $alumno->Carrera, ['class' => 'form-control' . ($errors->has('Carrera') ? 'is-invalid' : ''), 'placeholder' => 'Carrera']) }}
        {!! $errors->first('Carrera', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa la nueva carrera del alumno.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Grupo') }}</label>
    <div>
        {{ Form::text('Grupo', $alumno->Grupo, ['id' => 'grupo-input', 'class' => 'form-control' . ($errors->has('Grupo') ? ' is-invalid' : ''), 'placeholder' => 'Grupo', 'readonly']) }}
        {!! $errors->first('Grupo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo grupo del alumno.</small>
    </div>
</div>
<div id="selectors-container" style="display: none;">
    <div class="form-group mb-3">
        <label class="form-label">Selecciona un semestre</label>
        <select id="semestre-select" class="form-control mb-3">
            <option value="" selected disabled>Selecciona un semestre</option>
            <option value="1">Semestre 1</option>
            <option value="2">Semestre 2</option>
            <option value="3">Semestre 3</option>
            <option value="4">Semestre 4</option>
            <option value="5">Semestre 5</option>
            <option value="6">Semestre 6</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">Selecciona un grupo</label>
        <select id="grupo-select" class="form-control">
            <option value="" selected disabled>Selecciona un grupo</option>
        </select>
    </div>
</div>

<script>
document.getElementById('grupo-input').addEventListener('click', function() {
    document.getElementById('selectors-container').style.display = 'block';
});

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

document.getElementById('grupo-select').addEventListener('change', function() {
    const grupo = this.value;
    document.getElementById('grupo-input').value = grupo;

    // Ocultar los selectores después de seleccionar el grupo
    document.getElementById('selectors-container').style.display = 'none';
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
        <select id="estatus-select" class="form-control">
            <option value="activo" {{ $alumno->estatus == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $alumno->estatus == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        {{ Form::hidden('estatus', $alumno->estatus, ['id' => 'estatus-input', 'class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
        {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo estatus del alumno.</small>
    </div>
</div>

<script>
    document.getElementById('estatus-select').addEventListener('change', function() {
        document.getElementById('estatus-input').value = this.value;
    });
</script>


<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('alumnos.index') }}" class="btn btn-danger">Cancelar</a>

            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>



