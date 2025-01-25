
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('Description') }}</label>
    <div>
        {{ Form::text('Description', $carrusel->Description, ['class' => 'form-control' .
        ($errors->has('Description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('Description', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>Description</b> instruction.</small>
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
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('link') }}</label>
    <div>
        {{ Form::text('link', $carrusel->link, ['class' => 'form-control' .
        ($errors->has('link') ? ' is-invalid' : ''), 'placeholder' => 'Link']) }}
        {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>link</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('orden') }}</label>
    <div>
        {{ Form::text('orden', $carrusel->orden, ['class' => 'form-control' .
        ($errors->has('orden') ? ' is-invalid' : ''), 'placeholder' => 'Orden']) }}
        {!! $errors->first('orden', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>orden</b> instruction.</small>
    </div>
</div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
