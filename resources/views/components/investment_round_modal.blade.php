<!-- Modal -->
<div class="modal fade" id="investment-round-modal" tabindex="-1" role="dialog" aria-labelledby="investment-round-title" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="investment-round-title">{{ __('Investment Round') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    @component('components.investment_round')
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
