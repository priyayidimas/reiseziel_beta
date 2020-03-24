<section class="blue-grey lighten-5">
        <div class="container">
            <h3 class="header">Leave Us Little Feedback</h3>
            <h5 class="sub-header">Help Us Improve Our Services</h5>
            <div class="row">
                <div class="col s3"></div>
                <div class="col s6">
                        <div class="card white darken-1">
                            <form action="{{URL::to('/addMessage')}}" method="post">
                                {!!csrf_field()!!}
                                <div class="card-content ">
                                    <span class="card-title">@if(Session::has('msg')) THANK YOU FOR YOUR FEEDBACK ! @endif</span>
                                    <div class="row">
                                            <div class="input-field col s12 m6">
                                                <input id="sender" name="sender" type="text" class="validate" required>
                                                <label for="sender">Email</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input id="subject" name="subject" type="text" class="validate" required>
                                                <label for="subject">Subject</label>
                                            </div>
                                            <div class="input-field col s12 m12">
                                                <textarea name="content" id="" cols="30" rows="10" class="materialize-textarea" required></textarea>
                                                <label for="content">Enter Message</label>
                                            </div>
                                    </div>
                                    <button type="submit" class="btn blue waves-effect">SEND <i class="material-icons right">send</i></button>
                                </form>
                                    
                                </div>
                            </div>
                </div>
                <div class="col s3"></div>
            </div>
        </div>
    </section>
    