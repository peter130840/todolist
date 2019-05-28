

@foreach ($ToDoLists as $ToDoLists)
    <p>
      <!-- {{ $ToDoLists->id . '.' . DB::table('todolists')->leftJoin('users','users.id','=','todolists.user_id')->where('users.id','=','$ToDoLists->user_id')->get(). ' ' . $ToDoLists->job . ' ' . $ToDoLists->done}} -->
      {{ $ToDoLists->id . '.' . $ToDoLists->user_name . ' ' . $ToDoLists->job . ' ' . $ToDoLists->done}}
      <form action="/ToDoList/{{$ToDoLists->id}}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <input type="submit" value="刪除" >
      </form>
    </p>
@endforeach

<form action="/ToDoList" method="POST">
{{ csrf_field() }}
     <!-- <input type="text" name="name" placeholder="輸入姓名"> -->
     <select name="user_id" id="user_id">
     @foreach($Users as $Users)
        <option value ="{{$Users->id}}">{{$Users->name}}</option>
     @endforeach   
     </select>
     <input type="hidden" name="user_name" value="$ToDoLists->user_name">
     <input type="text" name="job" placeholder="輸入工作內容">
     <input type="hidden" name="done" value="0">
     <input type="submit">
</form>
<br>
<form action="/ToDoList/Users" method="POST">
{{ csrf_field() }}
     <input type="text" name="name" placeholder="輸入姓名">
     <input type="submit">
</form>
<script>
   $(
   );
</script>
