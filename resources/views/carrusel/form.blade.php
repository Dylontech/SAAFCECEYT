
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Descripcion') }}</label>
    <div>
        {{ Form::text('Description', $carrusel->Descripcion, ['class' => 'form-control' .
        ($errors->has('Description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('Description', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>Descripcion</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Urlfoto') }}</label>
    <div>
        {{ Form::text('Urlfoto', $carrusel->Urlfoto, ['class' => 'form-control' .
        ($errors->has('Urlfoto') ? ' is-invalid' : ''), 'placeholder' => 'Urlfoto']) }}
        {!! $errors->first('Urlfoto', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>Urlfoto</b> instruction.</small>
    </div>
</div>


    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Subir</button>
            </div>
        </div>
    </div>
