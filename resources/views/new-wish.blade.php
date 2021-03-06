@extends('layouts.app')
@section('styles')
    <style>
    body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-repeat: no-repeat;
    background-size: 100% 100%
    }

    .card {
    padding: 30px 40px;
    margin-top: 40px;
    margin-bottom: 40px;
    border: none !important;
    box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2)
    }

    .blue-text {
    color: #00BCD4
    }

    .form-control-label {
    margin-bottom: 0
    }

    input,
    textarea,
    button {
    padding: 8px 15px;
    border-radius: 5px !important;
    margin: 5px 0px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    font-size: 18px !important;
    font-weight: 300
    }

    input:focus,
    textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #00BCD4;
    outline-width: 0;
    font-weight: 400
    }

    .btn-block {
    text-transform: uppercase;
    font-size: 15px !important;
    font-weight: 400;
    height: 43px;
    cursor: pointer
    }

    .btn-block:hover {
    color: #fff !important
    }

    button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
    }</style>
@endsection
@section('content')
<div class="container-fluid px-1 py-3 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Request a new Wish</h3>
            <p class="blue-text">Fill the form below</p>
            <div class="card">
                <form class="form-card" action="{{route('upload-request')}}" method="POST">
                    @csrf
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">@lang('Full Name')<span class="text-danger"> *</span></label> <input type="text" id="fname" name="name"  onblur="validate(1)" required> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">@lang('Employee code')<span class="text-danger"> *</span></label> <input type="text" id="lname" name="employee_code"  onblur="validate(2)" required> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Email<span class="text-danger"> *</span></label> <input type="text" id="email" name="email" placeholder="" onblur="validate(3)" required> </div>
                        <div class="form-group col-sm-6 flex-column d-flex"> <label class="form-control-label px-3">Phone number<span class="text-danger"> *</span></label> <input type="tel" id="mob" name="phone_no" placeholder="" onblur="validate(4)" required> </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">@lang('Description of your wish')<span class="text-danger"> *</span></label>
                            <textarea  name="description" id="job" rows="3" placeholder="@lang('Describe what do you need').." onblur="validate(5)" required></textarea>

                         </div>
                    </div>
                    <div class="row justify-content-between text-left">
                        <div class="form-group col-6 flex-column d-flex"> <label class="form-control-label px-3">@lang('Enter the amount needed for your need') (Rupees) </label> <input type="number" id="ans" name="amount" placeholder="" onblur="validate(6)" max="10000"> </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="form-group col-sm-6"> <button type="submit" class="btn-block btn-primary">Request</button> </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type='text/Javascript'>
function validate(val) {
    v1 = document.getElementById("fname");
    v2 = document.getElementById("lname");
    v3 = document.getElementById("email");
    v4 = document.getElementById("mob");
    v5 = document.getElementById("job");
    v6 = document.getElementById("ans");

    flag1 = true;
    flag2 = true;
    flag3 = true;
    flag4 = true;
    flag5 = true;
    flag6 = true;

    if(val>=1 || val==0) {
    if(v1.value == "") {
    v1.style.borderColor = "red";
    flag1 = false;
    }
    else {
    v1.style.borderColor = "green";
    flag1 = true;
    }
    }

    if(val>=2 || val==0) {
    if(v2.value == "") {
    v2.style.borderColor = "red";
    flag2 = false;
    }
    else {
    v2.style.borderColor = "green";
    flag2 = true;
    }
    }
    if(val>=3 || val==0) {
    if(v3.value == "") {
    v3.style.borderColor = "red";
    flag3 = false;
    }
    else {
    v3.style.borderColor = "green";
    flag3 = true;
    }
    }
    if(val>=4 || val==0) {
    if(v4.value == "") {
    v4.style.borderColor = "red";
    flag4 = false;
    }
    else {
    v4.style.borderColor = "green";
    flag4 = true;
    }
    }
    if(val>=5 || val==0) {
    if(v5.value == "") {
    v5.style.borderColor = "red";
    flag5 = false;
    }
    else {
    v5.style.borderColor = "green";
    flag5 = true;
    }
    }
    if(val>=6 || val==0) {
    if(v6.value == "") {
    v6.style.borderColor = "red";
    flag6 = false;
    }
    else {
    v6.style.borderColor = "green";
    flag6 = true;
    }
    }

    flag = flag1 && flag2 && flag3 && flag4 && flag5 && flag6;

    return flag;
    }
    </script>
@endsection
