@extends('layouts.app')
@section('styles')
  <style>
       @media only screen and (max-width: 600px) {
         .image-contact
         {
            display: none;
         }
         .text-content
         {
             margin-left: 0 !important;
             margin-top: 0 !important;
         }
         p
         {
            font-size: 17px !important;
         }

}
      body
      {
          background-color: #eae5e5;
      }
      .contactus
      {
        margin-top: 2.5rem;
      }
      .image-contact
      {
        margin-left: 2rem;
      }
            p
            {
                font-size: 20px;
            }
            footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgb(63, 62, 62);
            color: white;
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            }
  </style>
@endsection
@section('content')
    <div class="container contactus">
            <div style="margin-left: 4rem; margin-top: 2.5rem;" class=" text-content">
                 <h1 class="font-weight-bold">@lang('Contact us')</h1>
                 <p>@lang('You can email us at ')
                    <a href = "mailto:vtodo@spentose.com?subject = Feedback&body = Message">vtodo@spentose.com</a></p>
                  <p>@lang('Call us ') 91-22-68626202 / 203 / 206 / 222</p>
                  <p>@lang('We are found at Alcon Biosciences, 3rd Floor  South Wing, the International building, above SBI bank, Maharshi Karve Road, Churchgate')</p>
            </div>
    </div>
@endsection
@section('footer')
    <footer>
    @lang('Make a wish') &copy; 2021
    </footer>
@endsection
