<div class="col-lg-3 col-xl-2 dn-md">
    <div class="users_account_details extra-dashboard-menu">
        <div class="account_details_user d-flex pb10 bb1 mb10">
            @php $customer = auth()->guard('customer')->user(); @endphp
            <img class="me-3"
                src="{{ $customer->image ? asset('storage/' . $customer->image) : asset('front/images/team/ad-thumb.png') }}"
                alt="Generic placeholder image">
            <div class="content_details text-start">
                <h5 class="title">{{ $customer->name ?? 'Customer' }}</h5>
                <a class="stitle" href="mailto:{{ $customer->email }}">{{ $customer->email }}</a>
            </div>
        </div>
        <div class="ed_menu_list">
            <ul>
                <li>
                    <a class="{{ request()->is('customer/account-details') ? 'active' : '' }}" href="{{ route('customer.account-details') }}">
                        <span class="flaticon-growth"></span>Account Details
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('customer/orders') ? 'active' : '' }}" href="{{ route('customer.orders') }}">
                        <span class="flaticon-checked-box"></span>Order
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('customer/account-address') ? 'active' : '' }}" href="{{ route('customer.account-address') }}">
                        <span class="flaticon-location"></span>Address
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('customer/wishlist') ? 'active' : '' }}" href="{{ route('customer.wishlist') }}">
                        <span class="flaticon-badge"></span>Wishlist
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('customer/invoices') ? 'active' : '' }}" href="{{ route('customer.invoices') }}">
                        <span class="flaticon-invoice"></span>Invoices
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="flaticon-exit"></span>Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>