
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Profesor') }}</label>
    <div>
        {{ Form::text('Profesor', $materia->Profesor, ['class' => 'form-control' .
        ($errors->has('Profesor') ? ' is-invalid' : ''), 'placeholder' => 'Profesor']) }}
        {!! $errors->first('Profesor', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">materia <b>Profesor</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Nombre') }}</label>
    <div>
        {{ Form::text('Nombre', $materia->Nombre, ['class' => 'form-control' .
        ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">materia <b>Nombre</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Tipo') }}</label>
    <div>
        {{ Form::text('Tipo', $materia->Tipo, ['class' => 'form-control' .
        ($errors->has('Tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
        {!! $errors->first('Tipo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">materia <b>Tipo</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('materia.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
