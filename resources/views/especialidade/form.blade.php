<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Nombre') }}</label>
    <div>
        {{ Form::text('Nombre', $especialidade->Nombre, ['class' => 'form-control' . ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo <b>Nombre</b> de la especialidad.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Tipo') }}</label>
    <div>
        {{ Form::text('Tipo', $especialidade->Tipo, ['class' => 'form-control' . ($errors->has('Tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
        {!! $errors->first('Tipo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Por favor, ingresa el nuevo <b>Tipo</b> de la especialidad.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="{{ route('especialidades.index') }}" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>
