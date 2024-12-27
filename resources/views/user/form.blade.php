<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('nombre') }}</label>
    <div>
        {{ Form::text('nombre', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucción del <b>nombre</b> del usuario.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('correo electrónico') }}</label>
    <div>
        {{ Form::text('correo electrónico', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo Electrónico']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucción del <b>correo electrónico</b> del usuario.</small>
    </div>
</div>

<div class="form-footer">
    <div class="text-end">
        <div class="d-flex">
            <a href="#" class="btn btn-danger">Cancelar</a>
            <button type="submit" class="btn btn-primary ms-auto ajax-submit">Enviar</button>
        </div>
    </div>
</div>

