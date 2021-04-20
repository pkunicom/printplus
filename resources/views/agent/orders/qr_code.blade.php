<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
    
<div class="visible-print text-center">
	<h1>Order ID : {{ $order_id ?? '' }}  </h1>

    {!! QrCode::size(250)->generate('{{$order_id}}'); !!}
     
    <p>QR code by PrintPlus</p>
</div>
    
</body>
</html>