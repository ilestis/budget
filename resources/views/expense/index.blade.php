@extends('layouts.app')

@section('header')
    {{ trans('expense.titles.index') }}
@endsection

@section('content')
    <section id="expenses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        {{ trans('expense.header') }}
                    </p>

                    @include('common.flashs')

                    {!! $filter->render() !!}

                    <table class="table table-striped task-table">

                        <!-- Table Headings -->
                        <thead>
                            <th>{{ trans('expense.fields.budget') }}</th>
                            <th>{{ trans('expense.fields.day') }}</th>
                            <th>{{ trans('expense.fields.amount') }}</th>
                            <th>{{ trans('expense.fields.details') }}</th>
                            <th class="text-right">
                                <a href="{{ route('expense.create') }}" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> {{ trans('expense.actions.create') }}
                                </a>
                            </th>
                        </thead>

                        <!-- Table Body -->
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ link_to_route('budget.show', $expense->budget->name, $expense->budget_id) }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $expense->day }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $expense->amount }}</div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        <span title="{{ $expense->details }}">{{ substr($expense->details, 0, 255)}}</span></div>
                                </td>
                                <td class="text-right">
                                    <form action="{{ url('expense/' . $expense->id) }}" method="POST" class="form-inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-expense-{{ $expense->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>{{ trans('expense.actions.delete') }}
                                        </button>
                                    </form>
                                    <a href="{{ route('expense.edit', ['id' => $expense->id]) }}" class="btn btn-primary">
                                        <i class="fa fa-btn fa-pencil"></i>{{ trans('expense.actions.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {!! $expenses->render() !!}

                </div>
            </div>
        </div>
    </section>
@endsection