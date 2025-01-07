<?php

use Livewire\Volt\Component;

new class extends Component {
    //
    public $currentDateTime;
    public $showDate = true;

    public function mount()
    {
        $this->currentDateTime = now()->format('d-m-Y H:i:s');
    }
}; ?>

<div 
    x-data="{
        currentDateTime: @entangle('currentDateTime'),
        showDate: @entangle('showDate'),
        updateTime() {
            setInterval(() => {
                this.currentDateTime = new Date().toLocaleString('en-GB', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    ...(this.showDate ? { day: '2-digit', month: '2-digit', year: 'numeric' } : {})
                });
            }, 1000);
        }
    }"
    x-init="updateTime()"
    class="font-mono"
>
    <div class="mt-2 font-bold">
        <!-- Display the updated time -->
        <span x-text="currentDateTime"></span>
    </div>
</div>

