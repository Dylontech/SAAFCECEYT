<!-- filepath: /c:/Users/dilan/Desktop/profa/SAAFCECEYT/resources/views/carrusel/form.blade.php -->
<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('Descripcion') }}</label>
    <div>
        {{ Form::text('Description', $carrusel->Description, ['class' => 'form-control' . ($errors->has('Description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
        {!! $errors->first('Description', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>Descripcion</b> instruction.</small>
    </div>
</div>

<div class="form-group mb-3">
    <label class="form-label">{{ Form::label('image', 'Image') }}</label>
    <div>
        {{ Form::file('image', ['class' => 'form-control' . ($errors->has('image') ? ' is-invalid' : '')]) }}
        {!! $errors->first('image', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">carrusel <b>Image</b> instruction.</small>
    </div>