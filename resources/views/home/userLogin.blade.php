<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login Page</title>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="assets/css/login.css">
</head>
<body style="background: lemonchiffon;">


<div class="login">
   
  <h2 class="active" style="cursor: pointer; border-bottom: none;" ><a href="/index"> Back </a></h2>

  <h2 class="active" style="cursor: pointer;">  sign in </h2>

  <h2 class="active" style="cursor: pointer;"> <a href="/userReg"> sign up </a> </h2>
  @if($errors->any())
  @foreach($errors->all() as $err)
  <li>{{$err}}</li>
  @endforeach
  @endif
  <form action="/login" method="Post">
   
    @csrf

    <input type="text" class="text" name="email">
     <span>username</span>

    <br>
    
    <br>

    <input type="password" class="text" name="password">
    <span>password</span>
    <br>

    <input type="checkbox" id="checkbox-1-1" class="custom-checkbox" />
    <label for="checkbox-1-1">Keep me Signed in</label>
    
    <button class="signin">
      Sign In
    </button>


    <hr>

    <a href="#" style="color: white; margin-left:58px;">Forgot Password?</a>
  </form>

</div>


</body>
</html>
