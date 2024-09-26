@extends('home.admin');



@section("content1")
<div class="details">
<div class="recentOrders">
    
    <div class="cardHeader">
        <h2>Admin Order Management Tool</h2>
        <a href="#" class="btn">View All</a>
    </div>

    
        <div class="table">
            <div class="table-header">
                <p>Order Details</p>
                <div>
                    <input placeholder="Search...">
                    <button class="add_new"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="table_section">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Product_name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Action</th>
                    </tr>       		
                    </thead>
                   @foreach($order as $order)
                    <tbody>
                        <tr>
                            <td>{{$order['id']}}</td>
                            <td>{{$order['name']}}</td>
                            <td>{{$order['email']}}</td>
                            <td>{{$order['address']}}</td>
                            <td>{{$order['product_name']}}</td>

                            <td>{{$order['price']}}</td>
                            <td>{{$order['quantity']}}</td>
                            <td>{{$order['payment_status']}}</td>
                            <td>{{$order['delivery_status']}}</td>
                                       
                                       
                            <td>
                                <button title="Update Payment Details" style="padding: 10px"><a href="update/{{$order['id']}}">Update</a></button>
                                <button title="" style="padding: 6px"><a href="print/{{$order['id']}}" style="color: white">Print PDF</a></button>
                                <button title="" style="background: rgb(12, 57, 12)"><a href="email/{{$order['id']}}" style="color: white">Send Email</a></button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
           
        </div>
    
   


</div>


</div>







@endsection