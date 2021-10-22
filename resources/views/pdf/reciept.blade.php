
<link href="{{ public_path('assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet"><link href="{{ public_path('assets/css/style.css') }}" rel="stylesheet">

<style>
  .invoice{
    font-size: 11px
  }
</style>


<div class="invoice printableArea">
    <div class="row">
      <div class="col-12">
        <div class="page-header">
          <h4 class="d-inline"><span class="fs-30">Invoice</span></h4>
          <div class="pull-right text-end">
              <h5>{{date('d-m-Y')}}</h5>
          </div>	
        </div>
      </div>
      <!-- /.col -->
    </div>
    <div class="row invoice-info">
      <div class="col-md-6">
        <strong>From</strong>	
        <address>
          <strong class="text-blue fs-24">Ochacho Homes</strong><br>
          <strong class="d-inline">124 Lorem Ipsum, Suite 478,  Dummuy, USA 123456</strong><br>
          <strong>Phone: (00) 123-456-7890 &nbsp;&nbsp;&nbsp;&nbsp; Email: info@example.com</strong>  
        </address>
      </div>
      <!-- /.col -->
      <div class="col-md-6 d-flex justify-content-end">
        <strong>To</strong>
        <address>
          <strong class="text-blue fs-24">{{$client->name}}</strong><br>
          {{$client->address}}<br>
          <strong>Phone: {{$client->phone}} &nbsp;&nbsp;&nbsp;&nbsp; Email: {{$client->email}}</strong>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-12 invoice-col mb-15">
          <div class="invoice-details row no-margin">
            <div class="col-md-6 col-lg-3"><b>Invoice </b>#0154879</div>
            <div class="col-md-6 col-lg-3"><b>Order ID:</b> FC12548</div>
            <div class="col-md-6 col-lg-3"><b>Payment Due:</b> 14/08/2018</div>
            <div class="col-md-6 col-lg-3"><b>Account:</b> 00215487541296</div>
          </div>
      </div>
    <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered">
          <tbody>
          <tr>
            <th>#</th>
            <th>Description</th>
            <th>Serial #</th>
            <th class="text-end">Quantity</th>
            <th class="text-end">Unit Cost</th>
            <th class="text-end">Subtotal</th>
          </tr>
          <tr>
            <td>1</td>
            <td>Milk Powder</td>
            <td>12345678912514</td>
            <td class="text-end">2</td>
            <td class="text-end">{{ number_format($transaction->amount, 2) }}</td>
            <td class="text-end">{{ number_format($transaction->amount, 2) }}</td>
          </tr>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-12 justify-content-end">
          <p class="lead"><b>Payment Due</b><span class="text-danger"> 14/08/2018 </span></p>

          <div>
              <p>Sub - Total amount  :  $3,592.00</p>
              <p>Tax (18%)  :  $646.56</p>
              <p>Shipping  :  $110.44</p>
          </div>
          <div class="total-payment">
              <h3><b>Total :</b> $4,349.00</h3>
          </div>

      </div>
      <!-- /.col -->
    </div>
  </div>