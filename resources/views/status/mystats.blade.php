    <div class="my-3">
     <form class="form-inline">
          <label class="sr-only" for="requestee_name">Requestee name</label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input class="form-control" type="text" id="requestee_name" name="requestee_name" onkeyup="searchname(this.value)"  placeholder="@lang('Enter your name')">
             <div class="dropdown-search hidden " id="dropdown-search">

             </div>
         </div>
     </form>
 </div>
       <div id="statsdetails">
           <h5 class="font-weight-bold">@lang('Completed wishes'): <span class="text-primary" id="stats">&nbsp; </span></h5>
       </div>
 <div class="table-responsive-sm mt-5">
     <table class="table table-hover">
         <caption>@lang('Details of your request')</caption>
         <thead>
           <tr>
             <th scope="col">@lang('Name')</th>
             <th scope="col">@lang('Amount') (₹)</th>
             <th scope="col">@lang('Status')</th>
             <th scope="col">@lang('Date')</th>

           </tr>
         </thead>
         <tbody id="table-body">

         </tbody>
       </table>
 </div>
