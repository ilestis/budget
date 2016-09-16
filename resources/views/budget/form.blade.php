{{ csrf_field() }}

<div class="form-group">
    {!! Form::label('name', trans('budget.fields.name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {{ Form::label('target', trans('budget.fields.target'), ['class' => 'control-label']) }}
    {{ Form::text('target', null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {{ Form::label('periodicity', trans('budget.fields.periodicity'), ['class' => 'control-label']) }}
    {{ Form::select('periodicity', trans('budget.values.periodicity'), null, ['class' => 'form-control']) }}
</div>


<div class="form-group">
    {!! Form::submit(trans('budget.actions.save'), ['class' => 'btn btn-primary btn-block btn-lg sr-button']) !!}
</div>