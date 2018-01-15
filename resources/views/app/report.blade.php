
<header>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BYOD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/whale.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('img/whale.ico') }}" type="image/x-icon" />
    <meta name = "format-detection" content = "telephone=no" />
    <meta name="description" content="BYOD">
    <meta name="keywords" content="BYOD-ADMIN">
    <meta name="author" content="kokyick">
    <link rel="stylesheet" href="{{ asset('css/css/bootstrap.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css/camera.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">

    <script src="{{ asset('js/template/jquery.js') }}"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script src="{{ asset('js/template/jquery-migrate-1.2.1.js') }}"></script>
    <script src="{{ asset('js/template/superfish.js') }}"></script>
    <script src="{{ asset('js/template/jquery.mobilemenu.js') }}"></script>
    <script src="{{ asset('js/template/jquery.jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/template/jquery.ui.totop.js') }}"></script>
    <script src="{{ asset('js/template/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('js/template/jquery.equalheights.js') }}"></script>    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>

    <!-- Latest compiled and minified Locales -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/locale/bootstrap-table-zh-CN.min.js"></script>

    <!-- index 4 -->
    <script src="{{ asset('js/template/forms.js') }}"></script>
    
</header>

<div class="row_7">
        <div class="container">
            <div class="row">
                <img style="display: block; margin-left: auto; margin-right: auto;" class="img-thumb" src="{{$OrderList[0]['merchantdp']}}" alt="">     
                <h2 style="text-align: center;">{{$OrderList[0]['outlet_name']}}</h2>
                <h2 class="pad_bot2">Transactions report - ({{$myBody['startdate']}} - {{$myBody['enddate']}})</h2>
                <div class="table-responsive">     
          <table id="table" style="height: auto;" class="table table-striped">
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
                <?php $sum=0.00; ?>
              @foreach ($OrderList as $food)
              <tr class="vieworders">
                <?php $sum = $sum + (double)$food['order_bill']; ?>
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
    </div>
 <button id="printpagebutton" onclick="myFunction()" style="margin:5px;" class="btn btn-primary"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
<script>
function myFunction() {

        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //print
        window.print();

        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
}
</script>
</div>
</div>