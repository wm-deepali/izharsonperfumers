<div class="row">
    <div class="col-lg-12">
        <div class="dashboard_navigationbar dn db-md">
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn"><i class="fas fa-bars pr10"></i>
                    Dashboard Navigation</button>
                <ul id="myDropdown" class="dropdown-content">
                    <li>
                        <a class="{{ request()->is('customer/account-details') ? 'active' : '' }}"
                            href="{{ route('customer.account-details') }}">
                            <span class="flaticon-growth"></span>AccountDetails
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('customer/orders') ? 'active' : '' }}" href="{{ route('customer.orders') }}">
                            <span class="flaticon-checked-box"></span>Order
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('customer/account-address') ? 'active' : '' }}"
                            href="{{ route('customer.account-address') }}">
                            <span class="flaticon-location"></span>Address
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('customer/wishlist') ? 'active' : '' }}"
                            href="{{ route('customer.wishlist') }}">
                            <span class="flaticon-badge"></span>Wishlist
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('customer/invoices') ? 'active' : '' }}"
                            href="{{ route('customer.invoices') }}">
                            <span class="flaticon-invoice"></span>Invoices
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="flaticon-exit"></span>Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</div>