<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>User Registration</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="assets/css/regStyle.css" />
  </head>
  <body>
    <section class="container">
        <header>User Registration Page</header>

        @if($errors->any())
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
        @endif

        <form action="reg" class="form" method="post" enctype="multipart/form-data">
          @csrf
          <div class="input-box">
            <label>Full Name</label>
            <input type="text" placeholder="Enter full name" name="name"  />
          </div>
    
          <div class="input-box">
            <label>Email Address</label>
            <input type="text" placeholder="Enter email address" name="email"  />
          </div>
    
          <div class="column">
            <div class="input-box">
              <label>Password</label>
              <input type="password" placeholder="Enter password" name="password" />
            </div>
            
          </div>
            <div class="input-box address">
            <label>Address</label>
            <input type="text" placeholder="Enter street address" name="address"  />
           
        
            <div class="pix">
              <label>Profile Picture</label><br>
              <input type="file" placeholder="Enter your region" name="profile"  />
           
            </div>
          </div>
          <button type="submit">Submit</button>
        </form>
      </section>
  </body>
</html>
