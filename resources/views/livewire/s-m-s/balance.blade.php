<div>
    <div class="card widget widget-stats">
        <div class="card-body">
            <div class="widget-stats-container d-flex">
                <div class="widget-stats-icon widget-stats-icon-danger">
                    <i class="material-icons-outlined">sms</i>
                </div>
                <div class="widget-stats-content flex-fill" wire:init="getSMSBalance">
                    <span class="widget-stats-title">SMS Balance</span>
                    <span class="widget-stats-amount">&#8358;{{ number_format($smsBalance, 2) }}</span>
                    <span class="widget-stats-info">&nbsp;</span>
                </div>
            </div>
        </div>
    </div>
</div>
