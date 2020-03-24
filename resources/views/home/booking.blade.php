<section class="grey lighten-5" style="padding-top: 875px; padding-bottom: 200px">
    <h3 class="header">Book Now</h3>
    <h5 class="sub-header scrollspy" id="form">Search for available Plane Or Trains</h5><br>

    
    <div class="row container book">
            <div class="row en-container">
                    <div class="col s12">
                            @if (Session::has('msg'))
                            <div id="card-alert" class="card {{Session::get('color')}}">
                              <div class="card-content white-text">
                                  <p>{!!Session::get('msg')!!}</p>
                              </div>
                              <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                            </div>
                          @endif
                    </div>
                </div>
        <div class="tabs-vertical">
                <div class="col s12 m3 l3">
                    <ul class="tabs">
                        <li class="tab">
                            <a class="waves-effect waves-cyan" href="#plane"><i class="zmdi zmdi-apps"></i>Plane</a>
                        </li>
                        <li class="tab">
                            <a class="waves-effect waves-cyan" href="#train"><i class="zmdi zmdi-email"></i>Train</a>
                        </li>
                    </ul>
                    </div>
                    <div class="col s12 m9 l9">
                        <div id="plane" class="tab-content">
                            <div class="card white">
                                <div class="card-content">
                        
                                    <form class="" action="{{URL::to('/booking/searchTrans')}}" method="post" autocomplete="off">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="2">
                                        <div class="row">
                                                <div class="input-field col s12 m5">
                                                    <input id="from" name="from" type="text" class="validate bandara" required>
                                                    <label for="from">From</label>
                                                </div>
                                                <div class="input-field col s12 m5">
                                                    <input id="to" name="to" type="text" class="validate bandara" required>
                                                    <label for="to">To</label>
                                                </div>
                                                <div class="col s12 m2">
                                                        <label>Total Passenger</label>
                                                        <select class="browser-default" id="passenger" name="passenger">
                                                                <option value="1" selected>1</option>
                                                                @for ($i = 2; $i <= 5; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>    
                                                                @endfor
                                                        </select>     
                                                </div>
                                            </div>
                                            <div class="row">
                                                    <div class="input-field col s12 m5">
                                                        <input id="depart" name="depart" type="text" class="validate date" required>
                                                        <label for="depart">Departure Date</label>
                                                    </div>
                                                    <div class="input-field col s12 m5">
                                                            <input id="return" name="return" type="text" class="validate date return" disabled required>
                                                            <label for="return">Return Date</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m6 left" style="padding-top: 7px;padding-bottom: 20px">
                                                        <input type="checkbox" id="check" />
                                                        <label for="check">Return</label>
                                                    </div>
                                                    <div class="col s12 m6 right-align">
                                                        <button type="submit" class="btn waves-effect blue">Search Flight</button>
                                                    </div>
                                                </div>
                                        </form>
                                </div>

                            </div>
                        </div>
                        <div id="train" class="tab-content">
                            <div class="card white">
                                <div class="card-content">
                                
                                        <form class="" action="{{URL::to('/booking/searchTrans')}}" method="post" autocomplete="off">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="type" value="1">
                                            <div class="row">
                                                    <div class="input-field col s12 m5">
                                                        <input id="from" name="from" type="text" class="validate stasiun" required>
                                                        <label for="from">Origin</label>
                                                    </div>
                                                    <div class="input-field col s12 m5">
                                                        <input id="to" name="to" type="text" class="validate stasiun" required>
                                                        <label for="to">Destination</label>
                                                    </div>
                                                    <div class="col s12 m2">
                                                        <label>Total Passenger</label>
                                                        <select class="browser-default" id="passenger" name="passenger">
                                                                <option value="1" selected>1</option>
                                                                @for ($i = 2; $i <= 5; $i++)
                                                                <option value="{{$i}}">{{$i}}</option>    
                                                                @endfor
                                                        </select>     
                                                </div>
                                                </div>
                                                <div class="row">
                                                        <div class="input-field col s12 m5">
                                                            <input id="depart" name="depart" type="text" class="validate date" required>
                                                            <label for="depart">Departure Date</label>
                                                        </div>
                                                        <div class="input-field col s12 m5">
                                                            <input id="return" name="return" type="text" class="validate date return" disabled required>
                                                            <label for="return">Return Date</label>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m6 left" style="padding-top: 7px;padding-bottom: 20px">
                                                        <input type="checkbox" id="check2" />
                                                        <label for="check2">Return</label>
                                                    </div>
                                                    <div class="col s12 m6 right-align">
                                                        <button class="btn waves-effect blue" type="submit">Search Train</button>
                                                    </div>
                                                </div>
                                            </form>

                                </div>
                            </div>  
                        </div>
                    </div>
            </div>

    </div>
</section>
