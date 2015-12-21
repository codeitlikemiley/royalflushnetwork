@extends('app')

@section('content')
<div class="row">
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- TenCard Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View All Ten Cards --}}
              <div class="card-content">
                  <span class="card-title activator teal-text text-darken-4">Latest Cycler<i class="material-icons right">visibility</i></span>
                  <p><a href="#">iyuri305</a></p>

                 
              </div>

              {{-- TenCardLine --}}
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Ten Cardline<i class="material-icons right">close</i></span>
                    <div class="collection">
                    <a href="#!" class="collection-item active">Alvin</a> {{-- Top Card --}}
                    <a href="#!" class="collection-item">Coco</a>
                    <a href="#!" class="collection-item">Chip</a>
                    <a href="#!" class="collection-item">Munk</a>

                    </div>
              </div>
    </div>
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- JackCard Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View All Jack Cards --}}
              <div class="card-content">

                  <span class="card-title activator teal-text text-darken-4">Latest Cycler<i class="material-icons right">visibility</i></span>
                  <p><a href="#">iyuri305</a></p>
              </div>

              {{-- Jack CardLines --}}
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Jack Cardline<i class="material-icons right">close</i></span>
                    <div class="collection">
                    <a href="#!" class="collection-item active">Alvin</a> {{-- Top Card --}}
                    <a href="#!" class="collection-item">Coco</a>
                    <a href="#!" class="collection-item">Chip</a>
                    <a href="#!" class="collection-item">Munk</a>

                    </div>
              </div>
    </div>
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- QueenCard Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View All Queen Card --}}
              <div class="card-content">

                  <span class="card-title activator teal-text text-darken-4">Latest Cycler<i class="material-icons right">visibility</i></span>
                  <p><a href="#">iyuri305</a></p>
              </div>

              {{-- Queen Cardline --}}
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Queen Cardline<i class="material-icons">close</i></span>
                    <div class="collection">
                    <a href="#!" class="collection-item active">Alvin</a> {{-- Top Card --}}
                    <a href="#!" class="collection-item">Coco</a>
                    <a href="#!" class="collection-item">Chip</a>
                    <a href="#!" class="collection-item">Munk</a>

                    </div>
              </div>
    </div>
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- KingCard Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View All King Cards --}}
              <div class="card-content">

                  <span class="card-title activator teal-text text-darken-4">Latest Cycler<i class="material-icons right">visibility</i></span>
                  <p><a href="#">iyuri305</a></p>
              </div>

              {{-- KingCardline --}}
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">King Cardline<i class="material-icons right">close</i></span>
                    <div class="collection">
                    <a href="#!" class="collection-item active">Alvin</a> {{-- Top Card --}}
                    <a href="#!" class="collection-item">Coco</a>
                    <a href="#!" class="collection-item">Chip</a>
                    <a href="#!" class="collection-item">Munk</a>

                    </div>
              </div>
    </div>
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- AceCard Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View All Ace Card --}}
              <div class="card-content">

                  <span class="card-title activator teal-text text-darken-4">Latest Cycler<i class="material-icons right">visibility</i></span>
                  <p><a href="#">iyuri305</a></p>
              </div>

              {{-- AceCardline --}}
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">Ace Cardline<i class="material-icons right">close</i></span>
                    <div class="collection">
                    <a href="#!" class="collection-item active">Alvin</a> {{-- Top Card --}}
                    <a href="#!" class="collection-item">Coco</a>
                    <a href="#!" class="collection-item">Chip</a>
                    <a href="#!" class="collection-item">Munk</a>

                    </div>
              </div>

    </div>
    <div class="card teal lighten-5 col s12 m4 l2">
              {{-- RoyalFlushBonus Logo --}}
              <div class="card-image waves-effect waves-block waves-light">
                  <img class="activator" src="/img/rfnlogo.png">
              </div>

              {{-- View Latest  RFNBonus --}}
              <div class="card-content">


                  <h4><span>$</span><span id="rfn_bonus"> {{ $rfnbonus }} </span></h4>
              </div>

              {{-- RFNBONUS --}}

                {{-- Vue COmponent --}}
            {{-- <rfnbonus></rfnbonus>

            <template id="rfn_bonus">
            <h4>RFNBONUS</h4>
            <span>$</span>
            <span id="totalbonus"> </span>
            </template> --}}

    </div>

</div>

@endsection
