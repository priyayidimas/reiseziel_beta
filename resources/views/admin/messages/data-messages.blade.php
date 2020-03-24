@php
$data = DB::table('message')->get();
@endphp
<style media="screen">
  tr td{
    border: 1px solid #000000;
  }
</style>
  <table>
  <tr>
  <td colspan="4" align="center"><h2>REISEZIEL MESSAGES</h2></td>
  </tr>
  </table>
<table class="bordered data">
  <thead>
    <tr style="background-color: #ffc107; color:#111 ">
        <th>NO</th>
        <th>SENDER</th>
        <th>SUBJECT</th>
        <th>MESSAGES</th>
    </tr>
  </thead>

  <tbody>
    @php
      $n = 1
    @endphp
    @foreach ($data as $row)
      <tr>
        <td>{{$n++}}</td>
        <td>{{$row->sender}}</td>
        <td>{{$row->subject}}</td>
        <td>{{$row->content}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
