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
      <p>We are sorry to inform that your wish of reference number {{$mail_data['reference_code']}} has been declined by our team .Visit the link to get more details about your request <a href="{{route('request',$mail_data['reference_code'])}}">Click here</a></p>
      <p>Thanks,</p>
      <p>V-Group</p>
  </div>
