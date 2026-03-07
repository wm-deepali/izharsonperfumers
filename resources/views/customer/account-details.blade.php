@extends('front.app')

@section('title', 'Account Details')

@section('content')

  <!-- Our Dashbord -->
  <section class="our-dashbord dashbord">
    <div class="container">
      <div class="row">
        @include('customer.dashboard-nav')
        <div class="col-lg-9 col-xl-10">
          @include('customer.dashboard-nav-dropdown')
          <div class="row">
            <div class="col-xl-12">
              <div class="account_user_deails pl40 pl0-md">
                <h2 class="title mb30">Account Details</h2>

                @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif

                @if(session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif

                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="ui_kit_tab style2">
                  <!-- nav tab Nav List Start -->
                  <ul class="nav nav-tabs mb15" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="t20-tab" data-bs-toggle="tab" data-bs-target="#t20"
                        type="button" role="tab" aria-controls="t20" aria-selected="true">Profile İnformation</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="baby-tab" data-bs-toggle="tab" data-bs-target="#baby" type="button"
                        role="tab" aria-controls="baby" aria-selected="false">Password</button>
                    </li>
                    <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="furniture-tab" data-bs-toggle="tab" data-bs-target="#furniture"
                          type="button" role="tab" aria-controls="furniture" aria-selected="false">Permissions</button>
                      </li> -->
                  </ul>
                  <!-- nav tab Nav List End -->
                  <!-- nav tab contents Start -->
                  <div class="tab-content pt20 row" id="myTabContent">

                    <div class="tab-pane fade show active col-lg-12" id="t20" role="tabpanel" aria-labelledby="t20-tab">
                      <div class="account_details_page form_grid">
                        <form class="contact_form" action="{{ route('customer.profile.update') }}" method="POST"
                          enctype="multipart/form-data">
                          @csrf

                          <div class="row">

                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label">Name</label>
                                <input class="form-control" type="text" name="name" value="{{ $customer->name }}">
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" value="{{ $customer->email }}">
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label">Contact Number</label>
                                <input class="form-control" type="text" name="mobile_number"
                                  value="{{ $customer->mobile_number }}">
                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label">Gender</label>

                                <select class="form-control" name="gender">

                                  <option value="">Select Gender</option>

                                  <option value="male" {{ $customer->gender == 'male' ? 'selected' : '' }}>
                                    Male
                                  </option>

                                  <option value="female" {{ $customer->gender == 'female' ? 'selected' : '' }}>
                                    Female
                                  </option>

                                </select>

                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-4">
                                <label class="form-label">Date of Birth</label>

                                <input class="form-control" type="date" name="dob" value="{{ $customer->dob }}">

                              </div>
                            </div>


                            <div class="col-md-6">
                              <div class="form-group mb-4">

                                <label class="form-label">Upload Profile Photo</label>

                                <input class="form-control" type="file" name="image" style="height: inherit;">

                                @if($customer->image)
                                  <img src="{{ asset('storage/' . $customer->image) }}" height="50" class="mt-2">
                                @endif

                              </div>
                            </div>


                            <div class="col-md-6">

                              <div class="form-group mb-4">

                                <label class="form-label">Default Shipping Address</label>

                                <textarea class="form-control" name="address_line_1"
                                  rows="3">{{ $customer->address_line_1 }}</textarea>

                              </div>

                            </div>


                            <div class="col-md-6">

                              <div class="form-group mb-4">

                                <label class="form-label">Default Billing Address</label>

                                <textarea class="form-control" name="address_line_2"
                                  rows="3">{{ $customer->address_line_2 }}</textarea>

                              </div>

                            </div>


                            <div class="col-sm-12">

                              <div class="form-group d-flex mb0">

                                <button type="submit" class="btn btn-thm me-3">
                                  Update
                                </button>

                                <button type="button" class="btn btn-white" onclick="this.form.reset();">

                                  Cancel

                                </button>


                              </div>

                            </div>

                          </div>

                        </form>
                      </div>
                    </div>

                    <div class="tab-pane fade col-xl-6" id="baby" role="tabpanel" aria-labelledby="baby-tab">
                      <div class="account_details_page form_grid">
                        <form class="contact_form" action="{{ route('customer.password.update') }}" method="POST">
                          @csrf

                          <div class="row">

                            <div class="col-md-12">
                              <div class="form-group mb-4">

                                <label class="form-label">Current Password</label>

                                <input class="form-control" type="password" name="current_password"
                                  placeholder="Enter Current Password" required>

                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group mb-4">

                                <label class="form-label">New Password</label>

                                <input class="form-control" type="password" name="new_password"
                                  placeholder="Enter New Password" required>

                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group mb-4">

                                <label class="form-label">Confirm New Password</label>

                                <input class="form-control" type="password" name="confirm_password"
                                  placeholder="Confirm New Password" required>

                              </div>
                            </div>


                            <div class="col-sm-12">

                              <div class="form-group d-flex mb0">

                                <button type="submit" class="btn btn-thm me-3">
                                  Update
                                </button>

                                <button type="button" class="btn btn-white" onclick="this.form.reset();">

                                  Cancel

                                </button>

                              </div>

                            </div>

                          </div>

                        </form>

                      </div>
                    </div>

                    <!-- <div class="tab-pane fade col-xl-8" id="furniture" role="tabpanel" aria-labelledby="furniture-tab">
                        <div class="account_details_page mb20 d-flex justify-content-between bb1">
                          <div class="second_step_setup pb10">
                            <h5 class="title">SMS</h5>
                            <p>Messages to be sent by zenmart to your mobile phone via SMS method</p>
                          </div>
                          <div class="switch shortcode_widget_switch">
                            <div class="ui_kit_whitchbox">
                              <div class="form-check form-switch mb10">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="account_details_page mb20 d-flex justify-content-between bb1">
                          <div class="second_step_setup pb10">
                            <h5 class="title">Email</h5>
                            <p>Messages to be sent by zenmart to your mobile phone via Email method</p>
                          </div>
                          <div class="switch shortcode_widget_switch">
                            <div class="ui_kit_whitchbox">
                              <div class="form-check form-switch mb10">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>
                                <label class="form-check-label" for="flexSwitchCheckDefault2"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="account_details_page d-flex justify-content-between bb1">
                          <div class="second_step_setup pb10">
                            <h5 class="title">Phone Call</h5>
                            <p>Messages to be sent by zenmart to your mobile phone via Phone Call method</p>
                          </div>
                          <div class="switch shortcode_widget_switch">
                            <div class="ui_kit_whitchbox">
                              <div class="form-check form-switch mb10">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault3">
                                <label class="form-check-label" for="flexSwitchCheckDefault3"></label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                  </div>
                  <!-- nav tab contents End -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection