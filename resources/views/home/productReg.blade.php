
<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Register Products</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="assets/css/regStyle.css" />
  </head>
  <body>
    <section class="container">
        <header>Product Registration</header>

        @if($errors->any())
        @foreach($errors->all() as $err)
        <li>{{$err}}</li>
        @endforeach
        @endif

        <form action="proReg" class="form" method="post" enctype="multipart/form-data">
          @csrf
          <div class="input-box">
            <label>Product Name</label>
            <input type="text" placeholder="Enter Product Name" name="name" required />
          </div>
    
          <div class="input-box">
            <label>Price</label>
            <input type="number" placeholder="Enter Product Price" name="price" required />
          </div>
    
          <div class="column">
            <div class="input-box">
              <label>Discount Price</label>
              <input type="number" placeholder="Enter Discount Price" name="discount" required />
            </div>
            
          </div>
            <div class="input-box address">
            <label>Discount Details</label>
            <input type="text" placeholder="Enter Discount Rate" name="discountDetails" required />
        
            <div class="pix">
              <label>Product Picture</label><br>
              <input type="file" placeholder="" name="product" required />
           
            </div>
          </div>
          <button type="submit">Submit</button>
        </form>
      </section>
  </body>
</html>
