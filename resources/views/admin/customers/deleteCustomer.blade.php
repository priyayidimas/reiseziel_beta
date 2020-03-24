
<form class="" action="{{URL::to('/deleteCustomer')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
        <p>Are you sure want to delete this customer with email {{$cus->email}} with name {{$cus->name}} ?</p>
        <input type="hidden" name="id" value="{{ $cus->id }}">
    </div>
    
    <button type="submit" class="btn red waves-effect waves-light">Yes</button>
    <button type="button" class="btn btn-flat" data-dismiss="modal">No</button>

</form>