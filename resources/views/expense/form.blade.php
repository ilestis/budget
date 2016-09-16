{{ csrf_field() }}

<div class="form-group">
    {{ Form::label('budget_id', trans('expense.fields.budget'), ['class' => 'control-label']) }}
    {{ Form::select('budget_id', $budgets, null, ['class' => 'form-control']) }}
</div>

<div class="form-group">
    {!! Form::label('day', trans('expense.fields.day'), ['class' => 'control-label']) !!}
    {!! Form::date('day', date('Y-m-d'), ['class' => 'form-control', 'data-type' => 'datepicker']) !!}
</div>

<div class="form-group">
    {{ Form::label('amount', trans('expense.fields.amount'), ['class' => 'control-label']) }}
    {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => trans('expense.placeholders.amount')]) }}
</div>


<div class="form-group">
    {{ Form::label('details', trans('expense.fields.details'), ['class' => 'control-label']) }}
    {{ Form::textarea('details', null, ['class' => 'form-control', 'placeholder' => trans('expense.placeholders.details')]) }}
</div>


<div class="form-group">
    {!! Form::submit(trans('expense.actions.save'), ['class' => 'btn btn-primary btn-block btn-lg sr-button']) !!}
</div>