@php
    if (Auth::check()) {
        $user = Auth::user();
    }else {
        $user = "";
    }
@endphp
<ul id="dropdown1" class="dropdown-content">
        {{-- <li><a href="#!" class="waves-effect">one</a></li>
        <li><a href="#!" class="waves-effect">two</a></li>
        <li class="divider"></li> --}}
        <li><a href="{{URL::to('/logout')}}" class="waves-effect">Logout</a></li>
    </ul>
    <nav class="blue ">
                <div class="nav-wrapper">
                <a href="#!"class="btn-floating btn-large waves-effect waves-light blue  btn-slide" data-activates="mobile-demo"><i class="material-icons">menu</i></a>
                    <a href="{{url('/')}}" class="brand-logo " style="margin-left: 20px"><img class="hide-on-med-and-down" src="{{url('/assets/images/logo.gif')}}" height="35" width="35" alt=""> Reiseziel</a>
                    <!-- activate side-bav in mobile view -->
                    <ul class="right hide-on-med-and-down">
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons right">arrow_drop_down</i>{{$user->email}}</a></li>
                    </ul>
                </div>
    </nav>
    <ul class="side-nav" id="mobile-demo">
    
        <li><div class="user-view">
          <div class="background">
            <img src="{{URL::asset('/assets/images/desert.jpg')}}" height="176" width="300">
          </div>
            <a href="#!user"><img class="circle" src="{{url('/assets/images/koala.jpg')}}"></a>
            <a href="#!name"><span class="white-text name">{{$user->fullname}}</span></a>
            <a href="#!email"><span class="white-text email">{{$user->email}}</span></a>
          </div></li>
          
          <li class="no-padding"><a href="{{URL::to('/dashboard')}}" class="waves-effect hoverable"><i class="material-icons">web</i>My Account</a></li>
          <li class="no-padding"><a href="{{URL::to('/dashboard/viewCustomers')}}" class="waves-effect hoverable"><i class="material-icons">people</i>Passenger Quick Pick</a></li>
                 <li class="no-padding">
                     <ul class="collapsible collapsible-accordion">
                         <li>
                             <a class="collapsible-header hoverable waves-effect"><i class="material-icons">payment</i>My Purchase</a>
                             <div class="collapsible-body">
                                 <ul>
                                    <li><a href="{{URL::to('/dashboard/viewReservations')}}" class="waves-effect hoverable"><i class="material-icons">print</i>Purchase History</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
    

        {{-- <li class="no-padding"><a href="{{URL::to('/config')}}" class="waves-effect hoverable"><i class="material-icons">settings</i>Config</a></li> --}}
    
      <div class="mobile-only hide-on-med-and-up">
            <div class="divider"></div>
            <li><a href="{{URL::to('/logout')}}" class="waves-effect">logout</a></li>
      </div>
    </ul>
    