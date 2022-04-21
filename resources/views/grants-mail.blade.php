@extends('layouts.app')
@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @error('mail')
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @enderror
    <h2 class="text-muted">Granted Mail</h2>
    <p class="py-2">
        Send a mail to all employees who have granted wishes of others
    </p>
    <div class="row">
       <div class="col-12">
           <form action="{{route('grants-mail.send')}}" method="POST">
               @csrf
               <textarea cols="80" id="editor1" name="mail" rows="10" data-sample-short>
                   &lt;p&gt;Enter your &lt;strong&gt;mail text&lt;/strong&gt;;
               </textarea>
               <div class="my-4">
                    <input type="submit" class="btn btn-secondary btn-lg" value="SEND MAIL">
               </div>
           </form>

       </div>
    </div>

</div>
@endsection

@section('name')

@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
<script>
      CKEDITOR.replace('editor1', {
      height: 400,
      baseFloatZIndex: 10005,
      removeButtons: 'PasteFromWord'
    });
</script>
@endsection
