@extends('admin/index')
@section('title')
  Simple Admin Dashboard
@endsection
@extends('admin/navigation')
<body>
@section('content')

<div class="content-wrapper">

  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">First</a>
        <a href="#!" class="breadcrumb">Second</a>
        <a href="#!" class="breadcrumb">Third</a>
      </div>
    </div>
  </nav>

    <div class="row">
    <div class="col s12 m12">
      <div class="card white darken-1 z-depth-2">
        <div class="card-content light-blue-text">
          <span class="card-title center">Card Title</span>
          <table>
            <thead>
              <tr>
                <td></td>
                <td></td>
              </tr>
            </thead>

            <tbody>
              @foreach ($data as $row)
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
                <tr>
                  <td>{{$row->id}}</td>
                  <td>{{$row->description}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-action">
          <a href="#modal1" class="waves-effect waves-light btn modal-trigger">This is a link</a>
        </div>
      </div>
    </div>
  </div>

    <!-- Modal Structure -->
    <div id="modal1" class="modal">
      <div class="modal-content">

        <div class="input-field col s12">
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">First Name</label>
        </div>
        <div class="input-field col s12">
          <input id="icon_prefix" type="text" class="validate autocomplete">
          <label for="icon_prefix">Mom Name</label>
        </div>
        <div class="input-field range-field col s12">
            <p>Craze Meter</p>
            <input type="range" id="test5" min="0" max="100" />
        </div>

        <div class="input-field col s12">
          <input id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Mom Name</label>
        </div>

  <div class="input-field col s12">
    <select>
      <option value="" disabled selected>Choose your option</option>
      <option value="1">Option 1</option>
      <option value="2">Option 2</option>
      <option value="3">Option 3</option>
      </select>
      <label>Materialize Select</label>
  </div>


      </div>
      <div class="modal-footer">
        <a href="#" class="waves-effect waves-green btn-flat modal-action modal-close">Agree</a>
      </div>
    </div>


</div>



@endsection
</body>
</html>
