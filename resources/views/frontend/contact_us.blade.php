@extends('frontend.includes.main')
@section('title','Contact Us')
@section('content')

 <style>
       strong {
           color: red;
       }
   </style>

     <section class="py-5 bg-light mb-3">
        <div class="container text-center">
          <h2>Contact Us</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="(url('/'))">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="feedback-section ">
        <div class="container">
          <div class="contact-us-info my-5">
            <div class="contact-us-box">
              <div class="contact-box">
              <i class="fa fa-phone"> </i>
              @if(!empty($siteData[0]->mobile_number))
              <h6> {{$siteData[0]->mobile_number}}</h6>
              @else
               <h6>NA</h6>
               @endif
            </div>
          </div>

            <div class="contact-us-box">
              <div class="contact-box">
              <i class="fa fa-whatsapp"> </i>
              @if(!empty($siteData[0]->whatsapp_number))
              <h6> {{$siteData[0]->whatsapp_number}}</h6>
              @else
                <h6> NA</h6>
              @endif
  </div>          </div>

            <div class="contact-us-box">
              <div class="contact-box">
              <i class="fa fa-envelope"> </i>
               @if(!empty($siteData[0]->email))
              <h6> {{$siteData[0]->email}}</h6>
              @else
                <h6> NA</h6>
              @endif
             
            </div>
            </div>

            <div class="contact-us-box">
              <div class="contact-box">
              <i class="fa fa-map-marker"> </i>
                @if(!empty($siteData[0]->address))
              <h6> {{$siteData[0]->address}}</h6>
              @else
                <h6> NA</h6>
              @endif
                
             </div>
            </div>
          </div>
            
          
          <div class="feedback-pnl mb-5 d-flex flex-wrap">
            <div class="feedback-left">
             <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.5016848805753!2d151.19555831436543!3d-33.902485480646945!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12b1c8bb1988ab%3A0xf55a5fbdd848b715!2s100%20McEvoy%20St%2C%20Alexandria%20NSW%202015%2C%20Australia!5e0!3m2!1sen!2sin!4v1653644582382!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                
              </iframe> -->
                @if(!empty($siteData[0]->map))
               <iframe src="{{$siteData[0]->map}}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                
              </iframe>
              @else 
              No map found!!.
              @endif

            </div>
            <div class="feedback-right">
              <h5 class="mb-3">Contact Us Form</h5>
              @if(session('info'))
                  <div class="alert alert-success">
                  {{(session('info'))}}

                  </div>
                  @endif
              
              <form method="post" action="{{route('postContactData')}}" enctype="multipart/form-data">
                @csrf
                <fieldset>
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>First Name</label>
                      <div class="wdinput">

                      <input type="text" name="first_name" class="form-control" placeholder="First Name">
                       @if ($errors->has('first_name'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                     @endif
                    </div>
                  </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="wdinput">
                      <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                       @if ($errors->has('last_name'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                     @endif
                    </div>
                  </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <div class="wdinput">
                      <input type="number" name="mobile_number" class="form-control" placeholder="Phone Number">
                       @if ($errors->has('mobile_number'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('mobile_number') }}</strong>
                            </span>
                     @endif
                    </div>
                  </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Email Address</label>
                      <div class="wdinput">
                      <input type="email" name="email" class="form-control" placeholder="Email Address">
                       @if ($errors->has('email'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                     @endif
                    </div>
                  </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label>Messages</label>
                      <div class="wdinput">
                      <textarea class="form-control" rows="4" name="message" placeholder="Messages"></textarea>
                       @if ($errors->has('message'))
                            <span class="invalid feedback"role="alert">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                     @endif
                    </div>
                  </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <div class="wdinput">
                      <button class="btn submit-btn bg-dark text-white w-100" type="submit">Submit</button>
                    </div>
                  </div>
                  </div>
                </div>
                </fieldset>
              </form>

            </div> 
          </div>
          </div>
        
      </section>



@endsection