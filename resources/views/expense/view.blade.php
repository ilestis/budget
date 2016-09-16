@extends('layouts.app')

@section('header')
    {{ trans('expense.titles.view') }}
@endsection

@section('content')

<section id="planning">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @include('common.flashs')

                <dl class="dl-horizontal">
                    <dt>{{ trans('expense.fields.budget') }}</dt>
                    <dd>
                        {{ link_to_route('budget.show', $expense->budget->name, ['id' => $expense->budget_id]) }}
                    </dd>

                    <dt>{{ trans('expense.fields.day') }}</dt>
                    <dd>{{ $expense->day }}</dd>

                    <dt>{{ trans('expense.fields.amount') }}</dt>
                    <dd>{{ $expense->amount }}</dd>

                    <dt>{{ trans('expense.fields.details') }}</dt>
                    <dd>{!! nl2br(e($expense->details)) !!}</dd>
                </dl>

            </div>

            <div class="col-lg-4">
                {{ link_to('expense', trans('expense.actions.back'), ['class' => 'btn btn-default btn-lg btn-block']) }}
            </div>

            <div class="col-lg-4">
                <a href="{{ route('expense.edit', ['id' => $expense->id]) }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-btn fa-pencil"></i>{{ trans('expense.actions.edit') }}
                </a>
            </div>

            <div class="col-lg-4">
                <form action="{{ url('expense/' . $expense->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" id="delete-expense-{{ $expense->id }}" class="btn btn-danger btn-lg btn-block">
                        <i class="fa fa-btn fa-trash"></i>{{ trans('expense.actions.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
