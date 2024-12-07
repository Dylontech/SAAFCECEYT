
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Profesor') }}</label>
    <div>
        {{ Form::text('Profesor', $materia->Profesor, ['class' => 'form-control' . ($errors->has('Profesor') ? ' is-invalid' : ''), 'placeholder' => 'Profesor']) }}
        {!! $errors->first('Profesor', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo <b>Profesor</b> de la materia.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Nombre') }}</label>
    <div>
        {{ Form::text('Nombre', $materia->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo <b>Nombre</b> de la materia.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Tipo') }}</label>
    <div>
        {{ Form::text('Tipo', $materia->Tipo, ['class' => 'form-control' . ($errors->has('Tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
        {!! $errors->first('Tipo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo <b>Tipo</b> de la materia.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('materias.index') }}" class="btn btn-danger">Cancelar</a>

            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>

