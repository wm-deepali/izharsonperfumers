@extends('front.app')

@section('title', 'Invoices')

@section('content')

    <section class="our-dashbord dashbord pb80">

        <div class="container">
            <div class="row">

                @include('customer.dashboard-nav')

                <div class="col-lg-9 col-xl-10">

                    @include('customer.dashboard-nav-dropdown')

                    <div class="account_user_deails pl40 pl0-lg">

                        <h2 class="title mb30">Invoices</h2>

                        <div class="order_table table-responsive">

                            <table class="table">

                                <thead class="table-light">

                                    <tr>
                                        <th>ID</th>
                                        <th>Date & Time</th>
                                        <th>Products</th>
                                        <th>Order Amount</th>
                                        <th>Order Status</th>
                                        <th>Invoice</th>
                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse($orders as $order)

                                        <tr>

                                            <th>#{{ $order->order_number }}</th>

                                            <td>{{ $order->created_at->format('d M Y g:i A') }}</td>

                                            <td>
                                                @foreach($order->order_details as $item)
                                                    <div>{{ $item->product->name }}</div>
                                                @endforeach
                                            </td>

                                            <td>₹ {{ $order->order_amount }}</td>

                                            <td class="status">
                                                <span class="style1">{{ $order->order_status }}</span>
                                            </td>

                                            <td>

                                                @if($order->invoice_url)

                                                    <a href="{{ asset('storage/' . $order->invoice_url) }}"
                                                        class="btn btn-sm btn-primary" target="_blank">

                                                        <i class="fas fa-download"></i> Download

                                                    </a>

                                                @else

                                                    <span class="text-muted">N/A</span>

                                                @endif

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="6" class="text-center">No invoices found</td>
                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>

    </section>

@endsection