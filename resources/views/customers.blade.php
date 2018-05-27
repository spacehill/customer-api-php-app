@extends('layouts.app')

@section('title', 'Customers')

@section('content')
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th># of Orders</th>
            </tr>
        </thead>
            <tbody>
                @if(count($customers["items"]) > 0)
                    @foreach($customers["items"] as $customer)
                        <tr>
                            <td><a href="{{route('customer.show', ['id' => $customer->id])}}">{{ $customer->last_name }}, {{ $customer->first_name }}</a></td>
                            <td>{{ $customer->number_of_orders}}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
    </table>
    @if(count($customers["items"]) > 0)
        @for ($pageNumber = 1; $pageNumber <= $customers["total_pages"]; $pageNumber++)
        <li><a href="{{route('customers', ['page' => $pageNumber])}}">{{ $pageNumber }}</a></li>
        @endfor
    @endif
    <br />Total customers {{$customers["total_items"]}}
@endsection
