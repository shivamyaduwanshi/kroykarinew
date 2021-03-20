<table>
    <thead>
    <tr>
        <th>Sr.</th>
        <th>Ad Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Sub Category</th>
        <th>Price</th>
        <th>User</th>
        <th>location</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @php $i = 1 @endphp
    @if($data)
        @foreach ($data as $key => $value)
        @php $value = (Object) $value @endphp
        <tr>
            <td>{{$i++}}</td>
            <td>{{$value->ad_id}}</td>
            <td>{{$value->title}}</td>
            <td>{{$value->category}}</td>
            <td>{{$value->sub_category}}</td>
            <td>$ {{$value->price}}</td>
            <td>{{$value->user}}</td>
            <td>{{$value->location}}</td>
            <td>{{date('Y-M-d',strtotime($value->created_at))}}</td>
        </tr>
        @endforeach
    @else
      <tr>
          <td>Record not found</td>
      </tr>
    @endif
    </tbody>
</table>