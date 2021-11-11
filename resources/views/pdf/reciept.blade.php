
<link href="{{ public_path('assets/vendor_components/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">

<style>
  #invoice {
    font-size: 1rem
  }
</style>

<div class="container mt-5" id="invoice">
  <div class="d-flex justify-content-center row">
      <div class="col-md-8">
          <div class="p-3 bg-white rounded">
              <div class="row">
                  <div class="col-md-6">
                      <h1 class="text-uppercase">Invoice</h1>
                      <div class="billed"><span class="font-weight-bold text-uppercase">Billed:</span><span class="ml-1"> {{ $client->sname }}, {{ $client->onames }}</span></div>
                      <div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1"> {{ $transaction->date ? $transaction->date->toFormattedDateString()  : null }}</span></div>
                      <div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span><span class="ml-1"> #{{ $transaction->transaction_number }}</span></div>
                  </div>
                  <div class="col-md-6 text-right mt-3">
                      {{-- <img src="{{ asset('assets/images/user7-128x128.jpg') }}" alt="" class="img-fluid" width="150px"> --}}
                      <h5 class="text-danger mb-0">{{ config('app.name', 'Real Estate App') }}</h5><small>https://www.ochachorealhomes.com</small>
                  </div>
              </div>
              <div class="mt-3">
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Product</th>
                                  <th>Unit</th>
                                  <th class="text-right">Price (NGN)</th>
                                  <th class="text-right">Total (NGN)</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                    @if ($transaction->property)
                                        @if ($transaction->property->estatePropertyType)
                                            <span class="">{{ $transaction->property->estatePropertyType->estate ? $transaction->property->estatePropertyType->estate->name : null }}</span> - {{ $transaction->property->estatePropertyType->propertyType ? $transaction->property->estatePropertyType->propertyType->name : null }}
                                        @endif
                                    @endif  
                                  </td>
                                  <td>1</td>
                                  <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>
                                  <td class="text-right">
                                    <b>{{ number_format($transaction->amount, 2) }}</b>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>