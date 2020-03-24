
<script>
    Materialize.updateTextFields();
</script>

    <div class="row">
        <div class="input-field col s12">
            <input name="code" type="text" class="validate" required value="{{$message->sender}}" readonly>
            <label for="code">Sender</label>
        </div>
        <div class="input-field col s12">
            <input id="description" name="description" type="text" class="validate" required value="{{$message->subject}}" readonly>
            <label for="description">Subject</label>
        </div>
        <div class="input-field col s12 m12">
                <textarea name="content" id="" cols="30" rows="10" class="materialize-textarea" readonly>{{$message->content}}</textarea>
                <label for="content">Content</label>
            </div>
    </div>
   
            
{{--  <div class="divider"></div>  --}}

<div class="col s6">
        <form action="{{url('/deleteMessage')}}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{$message->id}}">
            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
            <button type="submit" class="btn red waves-effect waves-light">Delete<i class="material-icons left">delete</i></button>
        </form>
    </div>

<script src="{{url('/assets/js/autocomplete.js')}}"></script>
