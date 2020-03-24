
<div>
        <nav class="nav blue">
          <div class="nav-wrapper">
            <a href="{{url('/')}}" class="brand-logo" style="padding-left:20px"><img class="hide-on-med-and-down" src="{{url('/assets/images/logo.gif')}}" height="35" width="35" alt=""> Reiseziel</a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="nav-right right hide-on-med-and-down">
              <li><a href="{{URL::to('/retrieveBooking')}}">Retrieve Booking</a></li>
              @if (Auth::check())
                <li><a class="dropdown-button" href="#!" data-activates="dropdown2"><i class="material-icons right">arrow_drop_down</i>{{Auth::user()->email}}</a></li>
              @else
                <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons right">arrow_drop_down</i>My Account</a></li>
              @endif
            </ul>
            <ul class="side-nav" id="mobile-menu">
              <li><a href="#">item1</a></li>
              <li><a href="#">item2</a></li>
            </ul>
          </div>
        </nav>
      </div>
      
      <ul id="dropdown1" class="dropdown-content blue lighten-5">
          <li><a href="{{URL::to('/login')}}" class="waves-effect blue-text">Login</a></li>
          <li><a href="{{URL::to('/register')}}" class="waves-effect blue-text">Register</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content blue lighten-5">
          <li><a href="{{URL::to('/dashboard')}}" class="waves-effect blue-text">Dashboard</a></li>
          <li class="divider"></li>
          <li><a href="{{URL::to('/logout')}}" class="waves-effect blue-text">Logout</a></li>
        </ul>