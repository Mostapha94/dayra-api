@extends('layouts.admin')

@section('title') {{__('Sales of ').$supplier->name }} @endsection

@section('content')
<!-- Page Headline -->
<div class="page-headline">
    <h1>{{__('Sales of ').$supplier->name }}</h1>
</div>
<!-- // Page Headline -->
<div class="row responsive-table">
    <div class="col-12 col-m-12">
        <table  class="table striped bordered" id="products_datatable">
            <thead>
                <tr class="primary-bg">
                    <th>{{__('User')}}</th>
                    <th>{{__('Address')}}</th>
                    <th>{{__('Quantity')}}</th>
                </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ \App\Models\User::find($order->user_id)->name }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>   
</div>
@endsection