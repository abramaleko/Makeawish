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
      <p>Your request of reference number {{$mail_data['reference_code']}} has successfully be received by our team. We will notify you once your request has been approved </p>
      <p>Thanks,</p>
      <p>V-Group</p>
  </div>
