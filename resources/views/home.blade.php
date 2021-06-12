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
    <div class="border border-secondary px-3 mt-5 py-2">
        <p class="home-message mt-3 text-justify">
          @lang('Make-a-wish Foundation is a part of the V-group initiated by Mr. Vishal Jajodia. The proposed website is a platform specially designed for V-Group employees to write their wishes which would be fulfilled by anyone amongst the group only. It is a very unique idea adopted by  Mr. Advait Jajodia son of Mr. Vishal Jajodia Managing Director of V Group where an employee can freely put his wish in simple steps and he will be pleased to see the fulfillment of his wish from any corner of the establishment.')
        </p>
        <p class="home-message mt-3 text-justify">
            @lang('You are all welcome to use V-Group Make a wish web application ')👐
        </p>
        <div class="logo my-3">
            <img src="{{asset('icons/logo.png')}}" alt="V-group logo" class="image-logo">
        </div>
    </div>

</div>
@endsection
