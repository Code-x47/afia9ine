<!DOCTYPE html>
@extends("/home.admin")
<html>
<head>
<base href="/public">
</head>

<body>
@section('content1')
<h1 style="text-align: center; color:blue; margin-top:20px">Send Email To {{$user->email}}</h1>

<section class="container">
  

    @if($errors->any())
    @foreach($errors->all() as $err)
    <li>{{$err}}</li>
    @endforeach
    @endif

    <form action="{{url('sendMail',$user['id'])}}" class="form" method="post" enctype="multipart/form-data">
      @csrf
      <div class="input-box">
        <label>Email Greeting</label>
        <input type="text" placeholder="" name="greeting"  />
      </div>

      <div class="input-box">
        <label>Email FirstLine</label>
        <input type="text" placeholder="" name="fLine"  />
      </div>

      <div class="column">
        <div class="input-box">
          <label>Email Body</label><br>
          <textarea name="body" style="width: 700px; height:100px; margin-left:10px; margin-top:7px; border:1px solid rgb(222, 214, 214); border-radius:3%"></textarea>
        </div>
        
      </div>
        <div class="input-box address">
        <label>Email Url</label>
        <input type="text" placeholder="" name="url"  />

        <label>Button</label>
        <input type="text" placeholder="" name="button"  />
       
    
        <div class="pix">
          <label>Email LastLine</label><br>
          <input type="text" placeholder="" name="lLine"  />
       
        </div>
      </div>
      <button type="submit">Submit</button>
    </form>
  </section>

@endsection
</body>


</html>