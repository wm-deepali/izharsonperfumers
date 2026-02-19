@extends('frontend.includes.main')
@section('title','Feedback')
@section('content')
  <style>
       strong {
           color: red;
       }
   </style>

      <section class="py-5 bg-light mb-3">
        <div class="container text-center">
          <h2>Feedback</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Feedback</li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="feedback-section">
        <div class="container">
          <div class="feedback-pnl mb-5 d-flex flex-wrap">
            <div class="feedback-left">
              <img src="{{asset('frontend/images/about-us.jpg')}}" class="img-fluid">
            </div>
            <div class="feedback-right">
              <h5 class="mb-3">Feedback Form</h5>
              @if(session('info'))
                  <div class="alert alert-success">
                  {{(session('info'))}}

                  </div>
                  @endif

              <form  id="feedback-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="customer_id" value="{{Auth::guard('customer')->user()->id}}" id="customer_id">

                <fieldset>
                <div class="row">
                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>First Name</label>
                      <div class="wdinput">
                      <input type="text" name="first_name" class="form-control" placeholder="First Name" id="first_name">
                    <div class="text-danger validation-err" id="first_name-err"></div>
                    </div>
                  </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="wdinput">
                      <input type="text" name="last_name" class="form-control" placeholder="Last Name" id="last_name">
                      <div class="text-danger validation-err" id="last_name-err"></div>
                    </div>
                  </div>
                  </div>

                    <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Email</label>
                      <div class="wdinput">
                      <input type="text" name="email" class="form-control" placeholder="Email" id="email">
                      <div class="text-danger validation-err" id="email-err"></div>
                    </div>
                  </div>
                  </div>

                  <div class="col-xl-6 col-md-6 col-sm-6 col-xs-12 col-12">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <div class="wdinput">
                      <input type="number" name="mobile_number" class="form-control" placeholder="Phone Number" id="mobile_number">
                       <div class="text-danger validation-err" id="mobile_number-err"></div>
                    </div>
                  </div>
                  </div>
      <!-- for rating  -->
                

                   <div class="col-12">
                    <div class="form-group">
                      <label>Rate us </label>
                      <div class="wdinput">
                      <fieldset class="rating">
                    <input type="radio" class="rating" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" class="rating" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" class="rating" id="star4" name="rating" value="4" checked /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" class="rating" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                     <input type="radio" class="rating" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                     <input type="radio" class="rating" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                     <input type="radio" class="rating" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" class="rating" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                   <input type="radio" class="rating" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                   <input type="radio" class="rating" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                   
                      </fieldset><br>
                        <div class="text-danger validation-err" id="rating-err"></div>
                    </div>
                  </div>
                  </div>

            
                  <!-- end rate  -->

                  <div class="col-12">
                    <div class="form-group">
                      <label>Messages</label>
                      <div class="wdinput">
                      <textarea class="form-control" rows="4" placeholder="Messages" name="message" id="message"></textarea>


                       <div class="text-danger validation-err" id="message-err"></div>
                   
                    </div>
                  </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <div class="wdinput">
                      <button class="btn submit-btn bg-dark text-white w-100 submitFeedback" type="submit">Submit</button>
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
      
      <script type="text/javascript">
        $('#clientsays').owlCarousel({
          loop:true,
          margin:10,
          nav:false,
          responsive:{
            0:{
              items:1
            },
            600:{
              items:1
            },
            1000:{
              items:1
            }
          }
        })

          $(document).on('click', '.submitFeedback', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let first_name = $('#feedback-form #first_name').val();
            let customer_id = $('#feedback-form #customer_id').val();
            let last_name = $('#feedback-form #last_name').val();
            let mobile_number = $('#feedback-form #mobile_number').val();
            let email = $('#feedback-form #email').val();
            let message = $('#feedback-form #message').val();
            let rating = $('input[name=rating]:checked').val();
            let formData = new FormData();
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('mobile_number', mobile_number);
            formData.append('customer_id', customer_id);
            formData.append('email', email);
            formData.append('message', message);           
            formData.append('rating', rating);
           
            $.ajax({
                url: "{{ URL::to('/postFeedback') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal( "Success","Thankyou for your valuabe feedback!!","success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {

                                $(`#feedback-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
      </script>

   @endsection
