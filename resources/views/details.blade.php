@extends('layouts.app')

@section('title', $customer->first_name . "'s Order History")

@section('content')
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th># of Products</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if(count($customer->orders) > 0)
                @if(count($customer->orders) > 0)
                    @foreach($customer->orders as $order)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($order->date_created)->format('Y-m-d H:i:s')}}</td>
                            <td>{{ $order->items_total}}</td>
                            <td>${{ $order->total_inc_tax}}</td>
                        </tr>
                    @endforeach                   
                @endif
                <tr>
                    <td colspan="2">Lifetime Value</td>
                    <td>${{ $customer->life_time_value }}</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
