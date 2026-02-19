@extends('frontend.includes.main')
@section('title','FAQs')
@section('content')

       <section class="py-5 bg-light mb-3">

        <div class="container text-center">

          <h2>FAQs</h2>

          <nav aria-label="breadcrumb">

            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">

              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

              <li class="breadcrumb-item active" aria-current="page">FAQs</li>

            </ol>

          </nav>

        </div>

      </section>



      <section class="feedback-section mt-5">

        <div class="container">

          <div class="page-section">

  @if (isset($faq_categories) && count($faq_categories) > 0)
                @foreach ($faq_categories as $faq_category)
      
             <div class="faqs-box mb-5">
              <h2 class="mb-3">{{ $loop->iteration }}.{{ $faq_category->name }}</h2>
              <div class="faqs-box-pnl mb-2">
                @if (isset($faq_category->faqs) && count($faq_category->faqs) > 0)
                   @foreach ($faq_category->faqs as $faq)
                <!-- Accordion -->
                <div class="acc-container">        
                <div class="acc">
                <div class="acc-head">
                <p>{{$faq->question}}</p>
                </div>
                    <div class="acc-content">
                    <p>{{$faq->answer}}</p>
                    </div>
                </div>
                </div>
                    @endforeach
                    @endif
              </div>
            </div>
            @endforeach
            @endif


          </div>

        </div>

      </section>


      <script type="text/javascript">
    
        $(document).ready(function() {
// $('.acc-container .acc:nth-child(1) .acc-head').addClass('active');
// $('.acc-container .acc:nth-child(1) .acc-content').slideDown();
$('.acc-head').on('click', function() {
    if($(this).hasClass('active')) {
      $(this).siblings('.acc-content').slideUp();
      $(this).removeClass('active');
    }
    else {
      $('.acc-content').slideUp();
      $('.acc-head').removeClass('active');
      $(this).siblings('.acc-content').slideToggle();
      $(this).toggleClass('active');
    }
});     
});
      </script>


@endsection