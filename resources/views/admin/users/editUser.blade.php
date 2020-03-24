@php
    if (isset($data)) {
      $user = $data;
    }
@endphp

<script>
    var level = '{{$user->level}}';
    $(document).ready(function () {
        Materialize.updateTextFields();
        $('#level').val(level);
    });
</script>


<form class="" action="{{URL::to('/updateUser')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="row">
        <div class="input-field col s12">
            <input id="fullname" name="fullname" type="text" class="validate" value="{{$user->fullname}}" required>
            <label for="fullname">Full Name</label>
        </div>
    </div>
    <div class="row">
        <div class="input-field col s12">
            <input id="email" name="email" type="text" class="validate" value="{{$user->email}}" required>
            <label for="email">Email</label>
        </div>
    </div>

    <div class="row">
          <label>User Level</label>
          <select class="browser-default" id="level" name="level">
              <option value="" disabled selected>Choose User Level</option>
              <option value="1">User</option>
              <option value="3">Adminstrator</option>
          </select>                                     
    </div>

    <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
    <button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
</form>
