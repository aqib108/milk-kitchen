
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Milk Kitchen</title>
</head>

<body>
<table width="600" border="0" cellspacing="0" cellpadding="0" style="background:#ebebeb;">
  <tr>
    <td style="padding:20px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" style="background-color:#000;"><a href="http://kumbie.com/" target="_blank"><img src="{{asset('images/logo.png')}}" style="border:none;"  alt="" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left" style="background:#fff; padding:20px; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:25px;">
    
    

<div class="card-header">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" style="font-size:18px;">Invoice <strong>{{date('y-m-d')}}</strong></td>
    <td width="50%" style="font-size:18px;"><span class="float-right"><strong>Status:</strong> Pending</span></td>
  </tr>
  <tr>
    <td height="10"></td>
    <td></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="50%"><span class="mb-3">From</span></td>
        <td width="50%"><span class="mb-3">To:</span></td>
      </tr>
      <tr>
        <td height="10"></td>
        <td></td>
      </tr>
      <tr>
        <td><strong>{{$driver->name}}</strong></td>
        <td><strong>{{$customer->name}}</strong></td>
</tr>
      <tr>
        <td>{{$driver->email}}</td>
        <td>{{$customer->email}}</td>
      </tr>

      <tr>
        <td colspan="2">
        <div style="background-color:#CCC; height:1px; width:100%; margin-top:20px; margin-bottom:20px;"></div>
        
        </td>
        </tr>
    </table></td>
    </tr>
</table>
</div>


  <table cellpadding="0" cellspacing="0" class="table table-striped">
<thead>
<tr >
<th class="center">#</th>
<th>Item</th>
<th>Description</th>

<th class="right">Unit Cost</th>
  <th class="center">Qty</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>
<tr>
  @php $GrandTotal = 0 ;@endphp
@foreach ($products as $product)

<td class="center">1</td>
<td class="left strong">{{$product->name}}</td>
<td class="left">{{$product->desc}}</td>
<td class="right">{{$product->price}}</td>
  <td class="center">{{$product->carton}}</td>
  <?php $total =$product->price * $product->carton;
         $GrandTotal =$GrandTotal + $total;  
  ?>
<td class="right">{{$total}}</td>
</tr>
@endforeach

</tbody>
</table>





<table align="right" class="table table-clear">
<tbody>
<tr>
<td class="left">
<strong>Subtotal</strong>
</td>
<td class="right">{{$GrandTotal}}</td>
</tr>
<tr>
<td class="left">
<strong>Discount (0%)</strong>
</td>
<td class="right">0</td>
</tr>
<tr>
<td class="left">
 <strong>VAT (0%)</strong>
</td>
<td class="right">0</td>
</tr>
<tr>
<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>{{$GrandTotal}}</strong>
</td>
</tr>
</tbody>
</table>







    
    
    
    
    
    
    </td>
  </tr>
  <tr>
    <td align="center" valign="top"><a href="http://facebook.com/" target="_blank"><img src="{{asset('images/navigation_shadow.png')}}" style="border:none" width="600" height="10" alt="" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="10"></td>
  </tr>
  <tr>
    <td style="background:#000; padding:10px; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:16px;"><table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="81%" align="left"><table border="0" cellspacing="2" cellpadding="2" width="191">
          <tr>
            <td width="26" align="left" valign="middle"><img src="{{asset('images/1395931032_home.png')}}" name="_x0000_i1025" width="16" height="16" border="0" id="_x0000_i1025" /></td>
            <td width="154" align="left" valign="middle"><a href="www.kumbie.com" target="_blank" style="color:#fff">www.milkkitchen.com</a></td>
          </tr>
          <tr>
            <td width="26" align="left" valign="middle"><img src="{{asset('images/1395931068_Black_Email.png')}}" alt="Email:" name="_x0000_i1026" width="20" height="13" border="0" id="_x0000_i1026" /></td>
            <td width="154" align="left" valign="middle"><a href="mailto:support@kumbie.com" target="_blank" style="color:#fff">info@</a><a href="www.kumbie.com" target="_blank" style="color:#fff">milkkitchen.com</a></td>
          </tr>
        </table></td>
        <td width="6%" align="right"><a href="http://facebook.com/" target="_blank"><img src="{{asset('images/facebook.png')}}" style="border:none" width="26" height="27" alt="" /></a></td>
        <td width="7%" align="right"><a href="http://linkedin.com/" target="_blank"><img src="{{asset('images/likndin.png')}}" style="border:none" width="27" height="27" alt="" /></a></td>
        <td width="6%" align="right"><a href="https://twitter.com/" target="_blank"><img src="{{asset('images/twitter.png')}}" style="border:none" width="26" height="27" alt="" /></a></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="font-family:Arial; font-size:12px; color:#000;">Copyright © 2021 © milk kitchen All rights reserved

<br /></td>
  </tr>
    </table>

    </td>
  </tr>
</table>

<style>
.table-striped
{
	border:solid 1px #ddd;
	
}
.table-striped thead
{
	border:solid 1px #ddd;
	height:40px;
	font-weight:bold;
	color:#000;
}
.table-striped tr
{
	border:solid 0px #ddd;
	
}
.table-striped td
{
	border:solid 1px #ddd;
	padding:10px;
	
}
</style>

</body>
</html>
