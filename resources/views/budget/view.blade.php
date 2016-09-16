@extends('layouts.app')

@section('header')
    {{ trans('budget.titles.view') }}
@endsection

@section('content')
<section id="planning">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                @include('common.flashs')

                <dl class="dl-horizontal">
                    <dt>{{ trans('budget.fields.name') }}</dt>
                    <dd>{{ $budget->name }}</dd>

                    <dt>{{ trans('budget.fields.target') }}</dt>
                    <dd>{{ $budget->target }}</dd>

                    <dt>{{ trans('budget.fields.periodicity') }}</dt>
                    <dd>{{ trans('budget.values.periodicity.' . $budget->periodicity) }}</dd>
                </dl>

            </div>

            <div class="col-lg-4">
                {{ link_to('budget', trans('budget.actions.back'), ['class' => 'btn btn-default btn-lg btn-block']) }}
            </div>

            <div class="col-lg-4">
                <a href="{{ route('budget.edit', ['id' => $budget->id]) }}" class="btn btn-primary btn-lg btn-block">
                    <i class="fa fa-btn fa-pencil"></i>{{ trans('budget.actions.edit') }}
                </a>
            </div>

            <div class="col-lg-4">
                <form action="{{ url('budget/' . $budget->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" id="delete-budget-{{ $budget->id }}" class="btn btn-danger btn-lg btn-block">
                        <i class="fa fa-btn fa-trash"></i>{{ trans('budget.actions.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
