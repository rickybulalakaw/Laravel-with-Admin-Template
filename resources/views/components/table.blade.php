@props(['table_values' => []])
<table class="table-auto {{$table_values['table_class']}}">
  <thead>
    @foreach($table_values['tableheaders'] as $th)
    <th class="{{ $th['class'] }}" >{{ $th['value']  }}</th>
    @endforeach
  </thead>
  <tbody>
    @foreach($table_values['tablebody'] as $tb)
    <tr>
      @foreach($tb as $td)
      <td class="{{ $td['class'] }}  ">{{$td['value']}}</td>
      @endforeach
    </tr>
    @endforeach
  </tbody>
</table>