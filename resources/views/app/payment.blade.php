@extends('layouts.master')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<!--==============================content=================================-->
<div id="content">
    <div class="row_7">
        <div class="container">
            <div class="row">
                <h2 class="pad_bot2">Revenue</h2>
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
              </tr>
            </thead>
            <tbody>
              @foreach ($OrderList as $food)
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
              </tr>
              @endforeach
          </tbody>
        </table>
        </div>
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
    background-color: #EF5350;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
	border-radius: 10px;
    padding: 2px 16px;
    background-color: #EF5350;
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
      <h2 style="color: #FFFFFF;">Fish</h2>
    </div>
    <div class="modal-body">
        <div class="row privacy_page">
            <div class="col-lg-4 col-md-4 col-sm-4">
				<a href="#" class="thumb"><figure class="img-polaroid"><img src="img/food_img.jpg" alt=""></figure></a>
			</div>   
			<div class="col-lg-8 col-md-8 col-sm-8" style="text-align:center;">
				<figure><img src="img/smalllogo1.png" alt=""></figure>
				<hr/>
				<h3>Fish</h3>
				<hr/>
				<p>This is a fish.</p>
				 <div class="center">
				    
					<p>
					  </p><div class="input-group">
						  <span class="input-group-btn">
							  <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
								<span class="glyphicon glyphicon-minus"></span>
							  </button>
						  </span>
						  <input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="100">
						  <span class="input-group-btn">
							  <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
								  <span class="glyphicon glyphicon-plus"></span>
							  </button>
						  </span>
					  </div>
					<p></p>
					<h2 style="padding:0;"><i class="fa fa-trash" aria-hidden="true"></i></h2>
					</div>
			</div> 
        </div> 
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>



<script>

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

// Get the button that opens the modal
// var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

// btn.onclick = function() {
//     modal.style.display = "block";
// }

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
$.get("http://127.0.0.1:8000/vieworderhist",function(data){
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