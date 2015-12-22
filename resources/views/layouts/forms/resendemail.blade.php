{{-- Start Card Div --}}
<div class="col s12 m12 l12">
  <div class="card teal lighten-5">
    <div class="card-content teal-text">
      <span class="flow-text">Please Verify Your Account's Email</span> 
      <p>An email was sent to <span class="chip white-text teal">{{ $email }}</span></p> 
      <p>Exactly Around {{ $date }}</p>
      <br>
      <i class="material-icons left prefix medium orange-text">warning</i>
      <p class="flow-text pull-s2">Please Check Your Inbox</p>
      <p class="flow-text" pull-s2>Also Check Your Spam Box</p>
      <p class="flow-text pull-s2">If You Cant Find Any Email</p>
      <p class="flow-text pull-s2">Click Button Below To Resend Email</p>
   </div>    
  </div>
</div>

<a class="col s12 btn waves-effect waves-light teal darken-1" href="/resendEmail" name="action" >Resend Email Verification</a>
{{-- End Card --}}
