@extends('layouts.app')

@section('header')
    {{ trans('budget.titles.edit') }}
@endsection

@section('content')
    <section id="budgetEdit">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('common.flashs')

                    {!! Form::model($budget, ['method' => 'PUT', 'route' => ['budget.update', $budget->id], 'class' => 'form-horizontal']) !!}
                        @include('budget.form')
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-12">
                    {{ link_to('budget', trans('budget.actions.back'), ['class' => 'btn btn-default btn-block']) }}
                </div>
            </div>
        </div>
    </section>
@endsection