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
      <p id="header">Hello,</p>
      <p>{{$mail_data['name']}} has just submitted a new Wish which is awaiting your approval.Visit the link to get more details about your request <a href="{{route('request',$mail_data['reference_code'])}}">Click here</a></p>
      <p>Thanks,</p>
      <p>V-Group</p>
  </div>
