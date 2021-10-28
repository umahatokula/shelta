<div>
    <form wire:submit.prevent="search">
        <div class="input-group">
          <input wire:model="query" type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn" type="submit" id="button-addon3"><i class="ti-search"></i></button>
          </div>
        </div>
    </form>
</div>
