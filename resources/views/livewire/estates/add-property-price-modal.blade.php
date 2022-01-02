  <form wire:submit.prevent="attachPrice">

      <div class="box-body">

          <div class="row">
            <div class="col-6">
              <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Property Price</h4>
            </div>
            <div class="col-6 d-flex justify-content-end">
              <a wire:click.prevent="addPrice()" href="#" class="text-primary">Add</a>
            </div>
          </div>
          <hr class="my-15">

          @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                  Ensure there are no duplicate selections for Property Type
              </div>
          @endif

          <table class="table table-bordered">
            <thead>
              <th>Payment Plan</th>
              <th>Price</th>
              <th class="text-right">&nbsp;</th>
            </thead>
            <tbody>
              @foreach ($planPrices as $key => $planPrice)
              <tr>
                <td>
                  <select wire:model.lazy="paired.{{$key}}.plan_id"
                      class="form-select form-control" required>
                      <option value="">Please select one</option>
                      @foreach ($paymentPlans as $paymentPlan)
                      <option value="{{ $paymentPlan->id }}">{{ $paymentPlan->name }}</option>
                      @endforeach
                  </select>
                </td>
                <td>
                  <select wire:model.lazy="paired.{{$key}}.price_id"
                      class="form-select form-control" required>
                      <option value="">Please select one</option>
                      @foreach ($propertyPrices as $PropertyPrice)
                      <option value="{{ $PropertyPrice->id }}">{{ $PropertyPrice->price }}</option>
                      @endforeach
                  </select>
                </td>
                <td class="text-right">
                  <a wire:click.prevent="removePrice({{ $key }})" href="#" class="text-danger">
                    <span class="material-icons-outlined">
                      delete
                      </span></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="d-grid grid-2">
            <input type="submit" class="btn-lg btn btn-primary mb-3" value="Add Price to Property">
        </div>
      </div>
  </form>
