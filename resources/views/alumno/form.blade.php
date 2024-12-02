
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Matricula') }}</label>
    <div>
        {{ Form::text('Matricula', $alumno->Matricula, ['class' => 'form-control' .
        ($errors->has('Matricula') ? ' is-invalid' : ''), 'placeholder' => 'Matricula']) }}
        {!! $errors->first('Matricula', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>Matricula</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('CURP') }}</label>
    <div>
        {{ Form::text('CURP', $alumno->CURP, ['class' => 'form-control' .
        ($errors->has('CURP') ? ' is-invalid' : ''), 'placeholder' => 'Curp']) }}
        {!! $errors->first('CURP', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>CURP</b> Agregar.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Carrera') }}</label>
    <div>
        {{ Form::text('Carrera', $alumno->Carrera, ['class' => 'form-control' .
        ($errors->has('Carrera') ? ' is-invalid' : ''), 'placeholder' => 'Carrera']) }}
        {!! $errors->first('Carrera', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>Carrera</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Grupo') }}</label>
    <div>
        {{ Form::text('Grupo', $alumno->Grupo, ['class' => 'form-control' .
        ($errors->has('Grupo') ? ' is-invalid' : ''), 'placeholder' => 'Grupo']) }}
        {!! $errors->first('Grupo', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>Grupo</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Nombre') }}</label>
    <div>
        {{ Form::text('Nombre', $alumno->Nombre, ['class' => 'form-control' .
        ($errors->has('Nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
        {!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>Nombre</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('email') }}</label>
    <div>
        {{ Form::text('email', $alumno->email, ['class' => 'form-control' .
        ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>email</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('estatus') }}</label>
    <div>
        {{ Form::text('estatus', $alumno->estatus, ['class' => 'form-control' .
        ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Estatus']) }}
        {!! $errors->first('estatus', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">alumno <b>estatus</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="{{ route('alumnos.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
