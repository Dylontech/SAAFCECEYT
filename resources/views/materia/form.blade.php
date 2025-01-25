<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('materia') }}</label>
    <div>
        {{ Form::text('materia', $materia->materia, ['class' => 'form-control' .
        ($errors->has('materia') ? ' is-invalid' : ''), 'placeholder' => 'Materia']) }}
        {!! $errors->first('materia', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucción de <b>materia</b>.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('semestre') }}</label>
    <div>
        {{ Form::select('semestre', [
            '1' => 'Semestre 1',
            '2' => 'Semestre 2',
            '3' => 'Semestre 3',
            '4' => 'Semestre 4',
            '5' => 'Semestre 5',
            '6' => 'Semestre 6'
        ], $materia->semestre, ['class' => 'form-control' . ($errors->has('semestre') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un semestre']) }}
        {!! $errors->first('semestre', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucción de <b>semestre</b>.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('especialidad') }}</label>
    <div>
        {{ Form::select('especialidad', [
            'diseño grafico digital' => 'Diseño Gráfico Digital',
            'produccion industrial de alimentos' => 'Producción Industrial de Alimentos',
            'ventas' => 'Ventas',
            'tronco comun' => 'Tronco Común'
        ], $materia->especialidad, ['class' => 'form-control' . ($errors->has('especialidad') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una especialidad']) }}
        {!! $errors->first('especialidad', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">Instrucción de <b>especialidad</b>.</small>
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
