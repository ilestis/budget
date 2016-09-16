@extends('layouts.app')

@section('header')
    {{ trans('budget.titles.index') }}
@endsection

@section('content')
    <section id="budgets">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        {{ trans('budget.header') }}
                    </p>

                    @include('common.flashs')

                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>{{ trans('budget.fields.name') }}</th>
                            <th>{{ trans('budget.fields.target') }}</th>
                            <th>{{ trans('budget.fields.periodicity') }}</th>
                            <th class="text-right">
                                <a href="{{ route('budget.create') }}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> {{ trans('budget.actions.create') }}
                                </a>
                            </th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($budgets as $budget)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ link_to_route('budget.show', $budget->name, $budget->id) }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $budget->target }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ trans('budget.values.periodicity.' . $budget->periodicity) }}</div>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('budget.edit', ['id' => $budget->id]) }}" class="btn btn-primary">
                                        <i class="fa fa-btn fa-pencil"></i>{{ trans('budget.actions.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {!! $budgets->render() !!}

                </div>
            </div>
        </div>
    </section>
@endsection