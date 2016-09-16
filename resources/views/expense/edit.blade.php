@extends('layouts.app')

@section('header')
    {{ trans('expense.titles.edit') }}
@endsection

@section('content')
    <section id="expenseEdit">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('common.flashs')

                    {!! Form::model($expense, ['method' => 'PUT', 'route' => ['expense.update', $expense->id], 'class' => 'form-horizontal']) !!}
                        @include('expense.form')
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-12">
                    {{ link_to('expense', trans('expense.actions.back'), ['class' => 'btn btn-default btn-block']) }}
                </div>
            </div>
        </div>
    </section>
@endsection