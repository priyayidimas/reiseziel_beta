@php
$data = DB::table('customer')->get();
@endphp
<style media="screen">
  tr td{
    border: 1px solid #000000;
  }
</style>
  <table>
  <tr>
  <td colspan="4" align="center"><h2>REISEZIEL CUSTOMERS</h2></td>
  </tr>
  </table>
<table class="bordered data">
  <thead>
    <tr style="background-color: #ffc107; color:#111 ">
        <th>NO</th>
        <th>TITLE</th>
        <th>FULLNAME</th>
        <th>EMAIL</th>
        <th>ADDRESS</th>
        <th>PHONE</th>
        <th>CREATED AT</th>
    </tr>
  </thead>

  <tbody>
    @php
      $n = 1
    @endphp
    @foreach ($data as $row)
      <tr>
        <td>{{$n++}}</td>
        <td>{{$row->gender}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->email}}</td>
        <td>{{$row->address}}</td>
        <td>{{$row->phone}}</td>
        <td>{{$row->created_at}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
