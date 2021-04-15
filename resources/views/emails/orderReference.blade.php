<style>
  .container
  {
    padding: 1.4rem 2rem;
   background-color: #f8fafc;
   color: #374151;
   line-height: 1.5;
  }
  img
  {
    height: 3rem;
    width: 3.4rem;
  }
  #header
  {
    padding-top: 10px;
    padding-bottom: 7px;
  }
</style>

<div class="container">
    <div class="">
        <img src="{{asset('icons/logo.png')}}" >
    </div>
    <p id="header">Hello {{$mail_data['name']}},</p>
    <p>You have recently submitted a wish of reference number  {{$mail_data['reference_code']}} this reference number can be used to see the status of your wish <a href="{{route('request',$mail_data['reference_code'])}}">Click here for more details</a></p>
    <p>Thanks,</p>
    <p>V-Group</p>
</div>