@extends('front.app')

@section('title', 'My Orders')

@section('content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord pb80">
        <div class="container">
            <div class="row">
                @include('customer.dashboard-nav')
                <div class="col-lg-9 col-xl-10">
                    @include('customer.dashboard-nav-dropdown')
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="account_user_deails pl40 pl0-lg">
                                <h2 class="title mb30">Order</h2>
                                <div class="order_table table-responsive">
                                    <table class="table">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Date & Time </th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Payment Status</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Order Amount</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <th scope="row">{{ $order->order_number }}</th>
                                                    <td>{{ $order->created_at }}</td>
                                                    <td>
                                                        @foreach ($order->order_details as $item)
                                                            <div>{{ $item->product->name ?? 'Product' }}</div>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $order->payment_status }}</td>
                                                    <td class="status"><span class="style1">{{ $order->order_status }}</span>
                                                    </td>
                                                    <td>{{ $order->order_amount }}</td>
                                                    <td class="action"><span class="details"><a href="{{ route('customer.order.details', $order->id) }}"
                                                            class="btn btn-sm btn-primary">View</a></span></td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection