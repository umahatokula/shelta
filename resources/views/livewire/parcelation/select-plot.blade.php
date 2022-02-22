<div>
    <style>
        .svg-container {
            /* width: 50em; */
        }

        /* .assigned {
            stroke: #000000;
            fill: #d3c159;
            stroke-width: 2px;
        } */

        path.assigned{
            fill:none;
            /* stroke:black; */
            pointer-events:all;
            cursor: pointer;
        }

        path:hover{
            fill:red;
            stroke:#e5c41d;
            stroke-width: 6px;
        }
        
        svg, svg * {
            pointer-events: none;
            cursor: no-drop;
        }
    </style>
    <div class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row y-middle">
                <div class="col-lg-12">
    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sec-title mb-50">
                                <h2 class="title black-color">
                                    <span>{{ $estate->name }}</span>
                                </h2>
                            </div>
                        </div>
                        <div class="col-md-8 text-end mt-3">
                            <div class="rs-contact contact-style2">
                                <div class="container">
                                    <div class="row y-middle">
                                        <div class="col-lg-12">
                                            <div class="contact-wrap">
                                                <div id="form-messages"></div>
                                                
                                                <form id="onlinePaymentForm">
                                                    <fieldset>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-30">
                                                                <select wire:model.lazy="estate_id" wire:change="onSelectEstate($event.target.value)"
                                                                    class="from-select from-control">
                                                                    <option value="">Please select estate</option>
                                                                    @foreach ($estates as $estate)
                                                                    <option value="{{ $estate->slug }}">
                                                                        {{ $estate->name }}
                                                                    </option>
                                                                    @endforeach
                    
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 mb-30">
                                                                <a href="{{ route('frontend.parcelation.select', $selectedEstate) }}" class="readon submit text-center" style="{{ empty($selectedEstate) ? 'pointer-events: none;' : null }}">See Plots <span wire:loading>[loading...]</span></a>
                                                            </div>
                                                    
                                                        </div> 
                                                    </fieldset>
                                                </form>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="svg-container">
                                
                                @include($selectedEstateSlug)

                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    
    $@push('scripts')
        <script>

            const onClick = function() {
                console.log(this.id, this.innerHTML);
                
                const data = {
                    plot_unique_number: this.id,
                }

                Livewire.emit('plotSelected', data)
            }

            var unassigned_plots = <?php echo json_encode($unassignedPlots); ?>

            unassigned_plots.map(plot => {
                var element = document.getElementById(plot.unique_number)

                if (element) {
                    element.style.fill = "#FFF";
                    element.classList.add("assigned");

                    element.onclick = onClick; // set the event handler of each path (element)
                }

            })
            
        </script>
    @endpush
</div>
