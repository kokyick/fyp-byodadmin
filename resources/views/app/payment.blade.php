@extends('layouts.master')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<!--==============================content=================================-->
<div id="content">
    <div class="row_7">
        <div class="container">
            <div class="row">
                <h2 class="pad_bot2">Revenue Stats</h2>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <!--==============================row7=================================-->
    <div class="row_7">
        <div class="container">
            <div class="row">
          <h2 class="pad_bot2">Transactions History</h2>
                <div class="table-responsive">          
          <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toggle="table" data-url="data1.json" class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Order Status</th>
                <th>Time</th>
                <th>Outlet Name</th>
                <th>Bill</th>
                <th>Paid</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php $sum=0.00; ?>
              @foreach ($OrderList as $food)
              <?php $sum = $sum + (double)$food['order_bill']; ?>
              <tr class="vieworders">
                <td>
                    {{ $food['order_id'] }}
                </td>
                <td>
                    @if($food['order_status']==1)
                       <i style="color: #81C784;" class="fa fa-circle" aria-hidden="true"></i> Completed
                    @else
                       <i style="color: #FDD835;" class="fa fa-circle" aria-hidden="true"></i> Processing
                    @endif
                </td>
                <td>
                    {{ $food['order_time'] }}
                </td>
                <td>
                    {{ $food['outlet_name'] }}
                </td>
                <td>
                    {{ $food['order_bill'] }} RM
                </td>
                <td>
                    @if($food['order_payment']==1)
                       <i style="color: #81C784;" class="fa fa-circle" aria-hidden="true"></i> Paid
                    @else
                       <i style="color: #FDD835;" class="fa fa-circle" aria-hidden="true"></i> Processing
                    @endif
                </td>
                <td>
                    <div class="myBtn" id="{{ route('singleorder', $food['order_id']) }}">
                        <a href="#"></a><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </td>
              </tr>
              @endforeach
              <tr class="vieworders">
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    Total
                </td>
                <td>
                    {{$sum}} RM
                </td>
              </tr>
          </tbody>
        </table>
        </div>

                <h2>Generate report</h2>
                <form action="{{ route('htmltopdfview')}}" method="GET">
                    <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; padding: 4px; border-radius: 4px; width: 40%">
                        <i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;
                        <span id="datespan"></span> <b class="caret"></b>
                    </div>
                    <input style="display: none;" type="text" name="reportstart" id="reportstart">
                    <input style="display: none;" type="text" name="reportend" id="reportend">
                    <br/>
                    <select id="outl_id" name="outl_id" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; padding: 4px; border-radius: 4px; width: 40%">
                    @foreach ($RestaurantList as $outlet)
                        <option value="{{$outlet['outlet_id']}}">{{ $outlet['name'] }}</option>
                    @endforeach
                    </select>
                    <br/>
                    <button type="submit" style="margin-left: 0; margin-top: 10px;" class="btn btn-primary"><i class="fa fa-book" aria-hidden="true"></i> Generte report</button>
                </form>

    </div>

</div>
</div>

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    border-radius: 10px;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    border-radius: 10px 10px 0px 0px;
    background-color: #1565C0;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    border-radius: 10px;
    padding: 2px 16px;
    background-color: #1565C0;
    color: white;
}
.center{
    width: 150px;
    margin: 40px auto;
}

</style>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <div class="modal-tit">
      
      </div>
    </div>
    <div class="modal-body">
        <div class="row privacy_page"> 
            <div style="text-align:center;">
                <!-- <figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
                <hr/> -->
                <div class="modal-info">
                        <div class="card" style="width: 90%;">
                           <div class="card-content" style="width: 100%;">
                              <figure><img src="{{ asset('img/smalllogo1.png') }}" alt=""></figure>
                              <hr/>
                              <ul id="list2" class="list2">
                             </ul>
                             <hr/>
                             <h3 id="order_bills"></h3>
                             <hr/>
                         </div>
                     </div>
                    <form action="{{ route('orderPaid')}}" method="POST">
                        {{ csrf_field() }}
                        <input style="display: none;" id="orderId" type="text" name="orderId" class="form-control">
                        <button type="submit" style="margin:5px;" class="btn btn-primary"><i class="fa fa-cash" aria-hidden="true"></i> Order Paid</button>
                    </form>
                    <form action="{{ route('cancelOrder')}}" method="POST">
                        {{ csrf_field() }}
                        <input style="display: none;" id="order1Id" type="text" name="order1Id" class="form-control">
                        <button type="submit" style="margin:5px;" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete Order</button>
                    </form>
                    <hr/>
                    <h3>Add new food to order</h3>
                    <hr/>
                    <form action="{{ route('addfoodorder')}}" style="padding: 10px;" method="POST">
                        {{ csrf_field() }}
                        <select class="form-control" name="dishes" id="dishes">
                          @foreach ($DishList as $Dish)
                            <option value="{{ $Dish['outletproduct_id'] }}">{{ $Dish['name'] }}</option>
                          @endforeach
                        </select>
                        <br/>
                        <input style="display: none;" id="order2Id" type="text" name="order2Id" class="form-control">

                        <input class="form-control" type="number" placeholder="Quantity" name="quan" id="quan">
                        <button type="submit" style="margin:5px;" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Food</button>

                    </form>
                </div>
            </div> 
        </div> 
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>



<script>
$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        $('#reportstart').val(start.format('DD/MM/YYYY'));
        $('#reportend').val(end.format('DD/MM/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);
    
});

$("div.table-responsive table tr").click(function(e){
  // Holds the product ID of the clicked element
  console.log("clicked here");
});
//number
//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
//end number

// Get the modal
var modal = document.getElementById('myModal');

var uri="https://whaletress-admin.azurewebsites.net/";
var testuri="http://127.0.0.1:8000/removefood/";
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
$('.myBtn').click(function(){
    var food = $(this).attr('id');
    console.log(food);
    $.get(food,function(data){
        var title = "<h2 style='color: #FFFFFF;'>Order #"+data[0][0].order_id+"</h2>"
        $(".modal-tit").html(title);
        var ul = document.getElementById("list2");
        var dataArr=data[0];
        for (i = 0; i < (data[0].length); i++) { 
          var a = document.createElement("a");
          var li = document.createElement("li");
          a.textContent =data[0][i].name+" x "+data[0][i].quantity;
          a.setAttribute('href', uri+"removefood/"+data[0][i].food_order_id);
          a.setAttribute('onclick', "return confirm('This dish will be deleted. Are you sure?')");
          li.appendChild(a);
          // li.appendChild(document.createTextNode(data[0][i].name+" x "+data[0][i].quantity));
          li.setAttribute("id", data[0][i].food_order_id); // added line
          ul.appendChild(li);
        }
        $("#order_bills").html(data[0][0].order_bill + " RM");
        $('#orderId').attr('value', data[0][0].order_id);
        $('#order1Id').attr('value', data[0][0].order_id);
        $('#order2Id').attr('value', data[0][0].order_id);
        // $('#dish_id').attr('value', data.merchant_product_id);
        // $('#itemname').attr('value', data.name);
        // $('#itemprice').attr('value', data.price);
        // $('#itemproduct_image').attr('value', data.product_image);
        // $('#itemmerchant_id').attr('value', data.merchant_id);
        // $('#food_type').attr('value', data.food_type);
        // $('#avg_ratings').attr('value', data.avg_ratings);
    });
    

    modal.style.display = "block";
});

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var ctx = document.getElementById('myChart').getContext('2d');
$.get(uri+"vieworderhist",function(data){
    console.log("data: " . data)
    var timearr=[];
    var pricearr=[];
    for (i = 0; i < data.length; i++) {
        console.log("order: "+data[i]);
        var clashchecker=false;
        for(x=0;x<timearr;x++){
            //check if time exist
            if(x==data[i]['order_time']){
                pricearr[x]+=data[i]['order_bill'];
                clashchecker=true;
                break;
            }

        }
        if(clashchecker==false){
            timearr.push(data[i]['order_time']);
            pricearr.push(data[i]['order_bill']);
        }
    }
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: timearr,
            datasets: [{
                label: "",
                backgroundColor: '#42A5F5',
                borderColor: '#1565C0',
                data: pricearr,
            }]
        },

        // Configuration options go here
        options: {}
    });                                         
});
</script>
//

@endsection