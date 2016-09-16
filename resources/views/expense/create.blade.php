@extends('layouts.app')

@section('header')
    {{ trans('expense.titles.create') }}
@endsection

@section('content')
    <section id="planning">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('common.flashs')

                    {!! Form::open(['route' => 'expense.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}
                        @include('expense.form')
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-12">
                    {{ link_to(URL::previous(), trans('expense.actions.back'), ['class' => 'btn btn-default btn-block']) }}
                </div>
            </div>
        </div>
    </section>
@endsection