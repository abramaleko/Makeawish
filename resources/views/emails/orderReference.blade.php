<style>
  .container
  {
    padding: 1.4rem 2rem;
   background-color: #f8fafc;
   color: #374151;
   line-height: 1.5;
  }
  #header
  {
    padding-top: 10px;
    padding-bottom: 7px;
  }
</style>

<div class="container">
    <p id="header">Hello {{$mail_data['name']}},</p>
    <p>Congratulations, your wish of reference number {{$mail_data['reference_code']}} has been approved by our team <a href="{{route('request',$mail_data['reference_code'])}}">Click here to view the wish</a></p>
    <p>Thanks,</p>
    <p>V-Group</p>
</div>
