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
            Hello and welcome to Make a wish foundation which is a part of V-group initiated by Mr.Advait Jajodia. This is website is specifically designed for V-Group employees, this unique idea was brought to life by our Managing director of V-group Mr. Advait Jajodia where any employee can freely ask for wishes following a few steps and his wishes can be seen and also be granted by any other employee from all corners of the establishment.
        </p>
        <p class="home-message mt-3 text-justify">
            You are all welcome to use V-Group Make a wish  web application 👐
        </p>
        <div class="logo my-3">
            <img src="{{asset('icons/logo.png')}}" alt="V-group logo" class="image-logo">
        </div>
    </div>

</div>
@endsection
