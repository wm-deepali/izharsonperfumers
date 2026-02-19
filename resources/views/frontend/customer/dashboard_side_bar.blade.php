 <div class="dashboard-left-section listing-left-sidebar bg-light">
            <button class="close-listing-btn btn  ml-auto " id="closebtn"><i class="fa fa-close"> </i></button>
            <ul>
              <li><a href="{{route('dashboard')}}" @if (Request::route()->getName() == 'dashboard') class="active" @endif><i class="fa fa-home"> </i> Dashboard </a></li>
              <li><a href="{{route('my-orders')}}"  @if (Request::route()->getName() == 'my-orders') class="active" @endif><i class="fa fa-shopping-cart"> </i> My Orders </a></li>
              <li><a href="{{route('track-order')}}" @if (Request::route()->getName() == 'track-order') class="active" @endif ><i class="fa fa-truck"> </i>  Track Order  </a></li>
              <li><a href="{{route('order-reviews')}}"  @if (Request::route()->getName() == 'order-reviews') class="active" @endif><i class="fa fa-comment-o"> </i>  Order Reviews  </a></li>
              <li><a href="{{route('my-activities')}}" @if (Request::route()->getName() == 'my-activities') class="active" @endif><i class="fa fa-tasks"> </i> My Activities </a></li>
              <li><a href="{{route('my-enquiries')}}" @if (Request::route()->getName() == 'my-enquiries') class="active" @endif><i class="fa fa-question-circle"> </i> My Enquires </a></li>
              <li><a href="{{route('my-wishlist')}}" @if (Request::route()->getName() == 'my-wishlist') class="active" @endif><i class="fa fa-heart-o"> </i> My Wishlist </a></li>
              <li><a href="{{route('my-address-book')}}"  @if (Request::route()->getName() == 'my-address-book') class="active" @endif><i class="fa fa-address-book"> </i> My Address Book </a></li>
              <li><a href="{{route('my-account')}}" @if (Request::route()->getName() == 'my-account') class="active" @endif><i class="fa fa-cog"> </i> Account Setting </a></li>
              <li><a href="{{route('change-password')}}"  @if (Request::route()->getName() == 'change-password') class="active" @endif><i class="fa fa-key"> </i> Change Password </a></li>
              <li><a href="{{route('invite-friends')}}" @if (Request::route()->getName() == 'invite-friends') class="active" @endif><i class="fa fa-user"> </i> Invite Friends </a></li>
              <li><a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"> </i> Logout </a></li>
            </ul>
          </div>