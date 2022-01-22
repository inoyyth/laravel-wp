<div>
  PRODUCT PAGE
</div>
<table>
  @foreach($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title->rendered }}</td>
    </tr>
  @endforeach
</table>