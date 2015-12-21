{{-- If Your remove this row it will create a row for each div --}}
<div class="row">

    @unless(\Cookie::has('sponsor'))
    <div class="col s12 m4 l4">

        <h4 class="center"><span class="rf">Sponsor's</span> <span class="n">Profile</span></h4>
            <div class="card blue-grey darken-1">
                <div id="profile_card" class="card-content white-text">
                    <img src="{{ asset('img/profile.png') }}" width="85" height="85">
                    <p>NO SPONSOR</p>
                    <p>NO REGISTRATION</p>
                </div>
            </div>
            <ul class="collapsible collapsible-accordion ">
                <li>
                  <a class="collapsible-header waves-effect waves-light waves-red lighten-5 teal-text "><i class="material-icons left">attach_money</i>Select Sponsor's Link<i class="mdi-navigation-arrow-drop-down right"></i></a>
                <div class="collapsible-body">
                      <ul class="teal lighten-5" id="sploadlinks">
                      {{-- To be Populated Upon Search  --}}
                      </ul>
                </div>
                </li>
            </ul>
    </div>


{{-- Load About Me Section --}}
<div class="col s12 m4 l4">
<h4 class="center"><span class="rf">About</span> <span class="n">    Me </span></h4>
<div class="divider"></div>
<p id="about_me">
"Would you like me to give you
a formula for success?
It's quite simple, really.
Double your rate of failure
You're thinking of failure
as the enemy of success.
But it isn't at all
You can be discouraged by failure-or
you can learn from it.
So go ahead and make mistakes.
Make all you can.
Because, remember
that's where you'll find success.
On the far side."
</p>
<div class="divider"></div>

</div>
    @endunless
    @if(\Cookie::has('sponsor'))
    {{--*/ $cookie = \Cookie::get('sponsor') /*--}}
    <div class="col s12 m4 l4">

        <h4 class="center"><span class="rf">Sponsor's</span> <span class="n">Profile</span></h4>
            <div class="card blue-grey darken-1">
                <div id="profile_card" class="card-content white-text">
                    <img src="{{ $cookie['user']['profile']['profile_pic']  }}" width="85" height="85" class="circle white">
                    <p>{{ $cookie['user']['profile']['display_name']  }}</p>
                    @if($cookie['user']['profile']['contact_no'])
                    <span class="right">{{ $cookie['user']['profile']['contact_no']  }}</span>
                    @endif
                    @if($cookie['active'])
                    <span class="amber bold">PREMIUM VIP</span>
                    @endif
                    @unless($cookie['active'])
                    <span class="teal bold">FREEMIUM</span>
                    @endunless
                </div>
            </div>
            <ul class="collapsible collapsible-accordion ">
                <li>
                  <a class="collapsible-header waves-effect waves-light waves-red lighten-5 teal-text "><i class="material-icons left">attach_money</i>Select Sponsor's Link<i class="mdi-navigation-arrow-drop-down right"></i></a>
                <div class="collapsible-body">
                      <ul class="teal lighten-5" id="sploadlinks">
                      <li style="text-indent: 4rem;"><a href="{{ $cookie['link']  }}" class="teal-text">{{ $cookie['link']  }}<i class="material-icons right">send</i></a></li><hr>
                      </ul>
                </div>
                </li>
            </ul>
    </div>


{{-- Load About Me Section --}}
<div class="col s12 m4 l4">
<h4 class="center"><span class="rf">About</span> <span class="n">    Me </span></h4>
<div class="divider"></div>
<p id="about_me">
@if($cookie['user']['profile']['about_me'])
{{ $cookie['user']['profile']['about_me']  }}
@endif
@unless($cookie['user']['profile']['about_me'])
"Would you like me to give you
a formula for success?
It's quite simple, really.
Double your rate of failure
You're thinking of failure
as the enemy of success.
But it isn't at all
You can be discouraged by failure-or
you can learn from it.
So go ahead and make mistakes.
Make all you can.
Because, remember
that's where you'll find success.
On the far side."
@endunless
</p>
<div class="divider"></div>

</div>
    @endif


{{-- Load Here Bonuses Data --}}
<div class="col s12 m4 l4">
        <h5 class="center"><span class="rf">RoyalFlush</span><span class="n">  Bonus   </span><span style="font-family:'Segoe UI Symbol';color:black;font-size:40px;">&#x1f0aa;</span><span style="font-family:'Segoe UI Symbol';color:black;font-size:40px;">&#x1f0ab;</span><span style="font-family:'Segoe UI Symbol';color:black;font-size:40px;">&#x1f0ad;</span><span style="font-family:'Segoe UI Symbol';color:black;font-size:40px;">&#x1f0ae;</span><span style="font-family:'Segoe UI Symbol';color:black;font-size:40px;">&#x1f0a1;</span></h5>

            <ul class="collapsible">

                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">accessibility</i>Referrals
                    </div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>

                <li>
                    <div class="collapsible-header"><i class="material-icons">file_upload</i>Pass Ups
                    </div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>

                <li>
                    <div class="collapsible-header"><i class="material-icons">more_vert</i>Max Payline
                    </div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>

                <li>
                    <div class="collapsible-header"><i class="material-icons">change_history</i>Maxcyle
                    </div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>

                <li>
                    <div class="collapsible-header"><i class="material-icons">stars</i>Maxpayout Bonus
                    </div>
                    <div class="collapsible-body">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </li>
            </ul>
</div>
{{-- END BONUS DATA --}}
</div>
