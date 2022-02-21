@props(['id', 'maxWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));

$maxWidth = [
    'sm' => ' modal-sm',
    'md' => '',
    'lg' => ' modal-lg',
    'xl' => ' modal-xl',
][$maxWidth ?? 'md'];
@endphp

<!-- Modal -->
<div 
  x-data="{
      show: @entangle($attributes->wire('model')).defer,
  }"
  x-init="() => {

      let el = document.querySelector('#modal-id-{{ $id }}')

      let modal = new bootstrap.Modal(el);

      $watch('show', value => {
          if (value) {
              modal.show()
          } else {
              modal.hide()
          }
      });

      el.addEventListener('hide.bs.modal', function (event) {
      show = false
      })
  }"
  wire:ignore.self
  tabindex="-1"
  id="modal-id-{{ $id }}"
  aria-labelledby="exampleModalCenteredScrollableTitle modal-id-{{ $id }}"
  aria-hidden="true"
  x-ref="modal-id-{{ $id }}"
  x-on:close.stop="show = false"
  x-on:keydown.escape.window="closeModalOnEscape()"
  x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
  x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
  class="modal fade" id="modal-center" tabindex="-1"
  style="display: none;"
  >
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable {{ $maxWidth }}">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">&nbsp;</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>{{ $slot }}</p>
          </div>
      </div>
  </div>
</div>