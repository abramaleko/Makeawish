@extends('layouts.app')
<style>
 @media only screen and (max-width: 600px) {
  #wishes {
    width: auto !important;
  }
  .home-message
  {
      font-size: 14px !important;
  }
}
.image-logo
  {
      width: 44px;
      height: 44px;
  }
  .home-message
  {
      font-size: 20px;
  }
  .border
  {
    border-radius: 15px;
  }
</style>

@section('content')
<div class="container">
    <div class="px-3 py-2 mt-5 border border-secondary">
        <p class="mt-3 text-justify home-message">
          @lang('The Make a Wish platform is an online initiative by the V group leadership wherein employees falling under a certain salary bracket can post wishes.')
        </p>
        <p class="mt-3 text-justify home-message">
            @lang('These wishes can be something as simple as a small item (pencil box, apparel, instrument) or even an experience like a trip to a tourist attraction. The total cost of a  wish should be within the range of 3,000 to 10,000 rupees.')
        </p>
        <p class="mt-3 text-justify home-message">
            @lang('These posted wishes will be fulfilled by higher management and employees in senior positions. Kindly contact Mrs. Prajakta Deshpande (hr@spentose.com) in HR for head office and Mr. Dheeraj Sharma (hrvapi@spentose.com) in HR for factory for any further clarifications or if your wish exceeds the given budget. Kindly contact Mr. Vivek Bhojwani (vtodo@spentose.com) in case of any technical assistance.')
        </p>
        <p class="mt-3 text-justify home-message">
           @lang('Please share')
        </p>
        <div class="my-3 logo">
            <img src="{{asset('icons/logo.png')}}" alt="V-group logo" class="image-logo">
        </div>
    </div>

</div>
@endsection
