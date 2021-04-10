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
    #visit
    {
        background-color: #047857;
        padding: 15px 40px;
        color: white;
        text-decoration: none;
        border-radius: 4px;
    }
    #visit:hover
    {
        background-color: #10B981
    }
    .visit-box
    {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        margin-top: 2rem;
    }
  </style>

  <div class="container">
      <div class="">
          <img src="{{asset('icons/logo.png')}}" >
      </div>
      <p id="header">Hello {{$mail_data['name']}},</p>

      <p>{{$mail_data['grant_name']}} has just granted your wish of reference number {{$mail_data['reference_code']}} click the button for more details</p>
        <div class="visit-box">
            <a href="{{route('request',$mail_data['reference_code'])}}" id="visit">Visit Wish</a>
        </div>
      <p>Thanks,</p>
      <p>V-Group</p>
  </div>
