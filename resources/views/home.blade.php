@extends('layouts.app')

@section('header')
    {{ trans('dashboard.pages.index') }}
@endsection

@section('content')
    <section id="expenses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        {{ trans('dashboard.header') }}
                    </p>

                    @include('common.flashs')

                    <div class="row dashboard-date-switcher">
                        <div class="col-md-2 col-lg-offset-4">&lt;&lt; {{ link_to_route('home', $previousDate->format('F Y'), ['month' => $previousDate->format('m'), 'year' => $previousDate->format('Y')]) }}</div>
                        <div class="col-md-2">{{ $date->format('F Y') }}</div>
                        <div class="col-md-2">{{ link_to_route('home', $nextDate->format('F Y'), ['month' => $nextDate->format('m'), 'year' => $nextDate->format('Y')]) }} &gt;&gt;</div>
                    </div>

                    @foreach($budgets as $budget)
                        {{ $budget->setScope($date->format('m'), $date->format('Y')) }}
                    <div class="row">
                        <div class="col-md-2">
                            {{ link_to_route('budget.show', $budget->name, ['id' => $budget->id]) }}
                        </div>
                        <div class="col-md-8">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-{{ $budget->progressColour }}" role="progressbar" aria-valuenow="{{ $budget->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $budget->progress }}%;">
                                    {{ $budget->progress }} %
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            {{ $budget->spent }} / {{ $budget->target }}

                            <button type="button" class="btn btn-primary" name="dashboard-add-expense" data-budget-id="{{ $budget->id }}" data-budget-name="{{ $budget->name }}">
                                <i class="fa fa-btn fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="dashboard-expense-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="dashboard-expense-modal-title"></h4>
                </div>
                <div class="modal-body" id="dashboard-expense-modal-body">
                    {!! Form::open(['route' => 'expense.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

                    {{ csrf_field() }}

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
                        {{ Form::text('details', null, ['class' => 'form-control', 'placeholder' => trans('expense.placeholders.details')]) }}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('expense.actions.save'), ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::hidden('budget_id', null) !!}
                    {!! Form::hidden('_back', "/home/?month=" . $date->format('m') . "&year=" . $date->format('Y')) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
