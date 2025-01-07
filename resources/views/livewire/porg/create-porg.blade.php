<?php

use Livewire\Volt\Component;
use WireUi\Traits\WireUiActions;
use App\Models\Porg_Data;

new class extends Component {
    use WireUiActions;

    public $nama_plant;
    public $tipe_proses;
    public $nama_mesin;
    public $nama_foreman;
    public $no_op;
    public $type_size;
    public $nama_operator;
    public $bahan_material;
    public $hour_meter;
    public $actual_output;
    public $target_output;
    public $nama_customer;
    public $status;

    public $persiapanData;
    public $operasionalData;
    public $reloadingData;
    public $gangguanData;

    public $isButtonVisible = false;

    public $isButtonDisabled = false;

    //disable button 1 click
    //public $isSubmitting = false;

    public function mount()
    {
        // Fetch data for each status for the authenticated user
        $userId = auth()->id();

        $this->persiapanData = Porg_Data::where('user_id', $userId)->where('Status', 'Persiapan')->orderBy('created_at', 'desc')->first();
        $this->operasionalData = Porg_Data::where('user_id', $userId)->where('Status', 'Operasional')->orderBy('created_at', 'desc')->first();
        $this->reloadingData = Porg_Data::where('user_id', $userId)->where('Status', 'Reloading')->orderBy('created_at', 'desc')->first();
        $this->gangguanData = Porg_Data::where('user_id', $userId)
            ->whereNotIn('Status', ['Reloading', 'Persiapan', 'Operasional'])
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function submit($status): void
    {
        //if ($this->isSubmitting) {
        //    return; // Prevent multiple submissions
        // }

        //$this->isSubmitting = true; // Mark the form as being submitted

        $validated = $this->validate([
            'nama_plant' => ['required', 'string'],
            'tipe_proses' => ['required', 'string'],
            'nama_mesin' => ['required', 'string'],
            'nama_foreman' => ['required', 'string'],
            'no_op' => ['required', 'string'],
            'type_size' => ['required', 'string'],
            'nama_operator' => ['required', 'string'],
            'bahan_material' => ['required', 'string'],
            'hour_meter' => ['required', 'string'],
            'actual_output' => ['required', 'string'],
            'target_output' => ['required', 'string'],
            'nama_customer' => ['required', 'string'],
        ]);

        $this->status = $status;

        try {
            auth()
                ->user()
                ->porg_data()
                ->create([
                    'nama_plant' => $this->nama_plant,
                    'tipe_proses' => $this->tipe_proses,
                    'nama_mesin' => $this->nama_mesin,
                    'nama_foreman' => $this->nama_foreman,
                    'no_op' => $this->no_op,
                    'type_size' => $this->type_size,
                    'nama_operator' => $this->nama_operator,
                    'bahan_material' => $this->bahan_material,
                    'hour_meter' => $this->hour_meter,
                    'actual_output' => $this->actual_output,
                    'target_output' => $this->target_output,
                    'nama_customer' => $this->nama_customer,
                    'Status' => $this->status,
                ]);

            $this->mount();

            $this->notification()->send([
                'icon' => 'success',
                'title' => "{$status} Success!",
                'description' => 'This is a description.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Database submission failed: ' . $e->getMessage());

            $this->notification()->send([
                'icon' => 'error',
                'title' => 'Submission Failed!',
                'description' => 'There was an error while saving the data. Please try again later.',
            ]);
        }

        if ($this->isButtonVisible) {
            $this->isButtonVisible = false; // Hide the button if it's visible
        }

        // dd($this->noOp, $this->typeSize, $this->man, $this->hourMeter, $this->actualOutput, $this->targetOutput);
    }

    public function disruptionSubmit($status)
    {
        $validated = $this->validate([
            'nama_plant' => ['required', 'string'],
            'tipe_proses' => ['required', 'string'],
            'nama_mesin' => ['required', 'string'],
            'nama_foreman' => ['required', 'string'],
            'no_op' => ['required', 'string'],
            'type_size' => ['required', 'string'],
            'nama_operator' => ['required', 'string'],
            'bahan_material' => ['required', 'string'],
            'hour_meter' => ['required', 'string'],
            'actual_output' => ['required', 'string'],
            'target_output' => ['required', 'string'],
            'nama_customer' => ['required', 'string'],
        ]);

        $this->status = $status;

        try {
            auth()
                ->user()
                ->porg_data()
                ->create([
                    'nama_plant' => $this->nama_plant,
                    'tipe_proses' => $this->tipe_proses,
                    'nama_mesin' => $this->nama_mesin,
                    'nama_foreman' => $this->nama_foreman,
                    'no_op' => $this->no_op,
                    'type_size' => $this->type_size,
                    'nama_operator' => $this->nama_operator,
                    'bahan_material' => $this->bahan_material,
                    'hour_meter' => $this->hour_meter,
                    'actual_output' => $this->actual_output,
                    'target_output' => $this->target_output,
                    'nama_customer' => $this->nama_customer,
                    'Status' => $this->status,
                ]);

            $this->mount();

            $this->notification()->send([
                'icon' => 'success',
                'title' => "{$status} Success!",
                'description' => 'This is a description.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Database submission failed: ' . $e->getMessage());

            $this->notification()->send([
                'icon' => 'error',
                'title' => 'Submission Failed!',
                'description' => 'There was an error while saving the data. Please try again later.',
            ]);
        }
    }

    public function agree(): void
    {
        $this->notification()->send([
            'icon' => 'error',
            'title' => 'Gangguan',
            'description' => 'This is a description.',
        ]);

        $this->isButtonVisible = !$this->isButtonVisible; // Toggle button visibility
    }

    // public function updateUser()
    // {
    //     // Disable the button after the first click
    //     $this->isButtonDisabled = true;

    //     // Optionally, you can send feedback to the user
    //     session()->flash('message', 'User updated successfully!');
    // }
}; ?>

<div>
    <div>
        <form wire:submit='submit' class="grid grid-cols-4 grid-rows-3 gap-3">
            <x-select wire:model="nama_plant" label="Plant" placeholder="Pilih Plant" :options="['PLANT A', 'PLANT B', 'PLANT C', 'PLANT D', 'PLANT E']"/>
            <x-select wire:model="tipe_proses" label="Tipe Proses" placeholder="Pilih Tipe Proses" :options="['Drawing', 'Stranding', 'Cabling', 'Extruder', 'Bunching', 'Tapping']"/>
            <x-input wire:model="nama_mesin" label="Nama mesin" placeholder="Masukan Nama Mesin" icon="tag" />
            <x-input wire:model="nama_foreman" label="Nama Foreman" placeholder="Masukan Nama Foreman" icon="users" />
            <x-input wire:model="no_op" label="No. OP" placeholder="Masukan No. OP" icon="tag" />
            <x-input wire:model="type_size" label="Type Size" placeholder="Masukan Type Size" icon="tag" />
            <x-input wire:model="nama_operator" label="Nama Operator" placeholder="Masukan Nama Operator" icon="users" />
            <x-input wire:model="bahan_material" label="Item/Bahan Material" placeholder="Masukan Nama Bahan/Item" icon="tag" />
            <x-input wire:model="hour_meter" label="Hour Meter" placeholder="Masukan Hour Meter" icon="tag" />
            <x-input wire:model="actual_output" label="Actual Output (m)" placeholder="Masukan Actual Output" icon="tag" />
            <x-input wire:model="target_output" label="Target Output (m)" placeholder="Masukan Target Output" icon="tag" />
            <x-input wire:model="nama_customer" label="Nama Customer" placeholder="Masukan Nama Custumer" icon="users" />
        </form>
    </div>
    <div class="grid grid-cols-1 gap-8 px-3 xl:grid-cols-4 justify-items-center">
        <div
            class="font-mono mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center w-full h-10 text-[#16a34a] text-3xl">
            @if ($persiapanData)
                <!-- Show the data for Persiapan -->
                {{ $persiapanData->created_at->format('H:i:s') }}
            @else
                <!-- Show clock when no data for Persiapan -->
                <livewire:helper.clock :showDate="false" />
            @endif
        </div>
        <div
            class="font-mono mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center w-full h-10 text-[#16a34a] text-3xl">
            @if ($operasionalData)
                <!-- Show the data for Operasional -->
                {{ $operasionalData->created_at->format('H:i:s') }}
            @else
                <!-- Show clock when no data for Operasional -->
                <livewire:helper.clock :showDate="false" />
            @endif
        </div>
        <div
            class="font-mono mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center w-full h-10 text-[#16a34a] text-3xl">
            @if ($reloadingData)
                <!-- Show the data for Reloading -->
                {{ $reloadingData->created_at->format('H:i:s') }}
            @else
                <!-- Show clock when no data for Reloading -->
                <livewire:helper.clock :showDate="false" />
            @endif
        </div>
        <div
            class="font-mono mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center w-full h-10 text-[#16a34a] text-3xl">
            @if ($gangguanData)
                <!-- Show the data for Reloading -->
                {{ $gangguanData->created_at->format('H:i:s') }}
            @else
                <!-- Show clock when no data for Reloading -->
                <livewire:helper.clock :showDate="false" />
            @endif
        </div>
    </div>
    <div class="grid grid-cols-4 gap-4 px-2 py-3 justify-items-center">
        <div>
            <button wire:click="submit('Persiapan')" positive {{-- :class="{ 'bg-gray-300 cursor-not-allowed': $wire.isSubmitting }" :disabled="$wire.isSubmitting" --}}
                class="font-bold text-gray-900 text-7xl flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-cyan-400 shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                P
            </button>
        </div>
        <div class="">
            <button wire:click="submit('Operasional')" positive
                class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#22c55e] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none font-bold text-gray-900 text-7xl">
                O
            </button>
        </div>
        <div class="">
            <button wire:click="submit('Reloading')" positive
                class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#f59e0b] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none font-bold text-gray-900 text-7xl">
                R
            </button>
        </div>
        <div class="">
            <button x-on:click="$openModal('blur-md')"
                class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#e11d48] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none font-bold text-gray-900 text-7xl">
                G
            </button>
        </div>
        <div class="flex items-center justify-center h-2">
            <p>Persiapan</p>
        </div>
        <div class="flex items-center justify-center h-2">
            <p>Operasional</p>
        </div>
        <div class="flex items-center justify-center h-2">
            <p>Reloading</p>
        </div>
        <div class="flex items-center justify-center h-2">
            <p>Gangguan</p>
        </div>
    </div>

    @if ($isButtonVisible)
        <div x-data="{ showMessage: '--' }">
            <p class="text-xs">Tipe Gangguan*</p>
            <div class="grid grid-cols-1 px-3 py-3 xl:grid-cols-5 justify-items-center">
                <div @click="showMessage = 'Tidak ada Operator'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Operator')" negative
                        class="text-xl font-bold text-gray-900">
                        TOP
                    </button>
                </div>
                <div @click="showMessage = 'Gangguan operasi'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Gangguan operasi')" negative
                        class="text-xl font-bold text-gray-900">
                        GO
                    </button>
                </div>
                <div @click="showMessage = 'Tidak ada Bobin Produksi'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Bobin Produksi')" negative
                        class="text-xl font-bold text-gray-900">
                        TBP
                    </button>
                </div>
                <div @click="showMessage = 'Tidak ada Bobin Kayu'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Bobin Kayu')" negative
                        class="text-xl font-bold text-gray-900">
                        TBK
                    </button>
                </div>
                <div @click="showMessage = 'Tunggu Proses Sebelumnya'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tunggu Proses Sebelumnya')" negative
                        class="text-xl font-bold text-gray-900">
                        TPS
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-7 justify-items-center">
                <div @click="showMessage = 'Mesin Rusak'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Mesin Rusak')" negative
                        class="text-xl font-bold text-gray-900">
                        MR
                    </button>
                </div>
                <div @click="showMessage = 'Tidak ada Tools'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Tools')" negative
                        class="text-xl font-bold text-gray-900">
                        TAT
                    </button>
                </div>
                <div @click="showMessage = 'Tidak ada Order'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Order')" negative
                        class="text-xl font-bold text-gray-900">
                        TAO </button>
                </div>
                <div @click="showMessage = 'Tidak ada Bahan (Material)'"
                    class="flex items-center justify-center w-40 h-10 bg-[#f8fafc] shadow-sm shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none rounded-lg">
                    <button wire:click="disruptionSubmit('Tidak ada Bahan (Material)')" negative
                        class="text-xl font-bold text-gray-900" disable>
                        TB
                    </button>
                </div>
            </div>

            <div class="mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center h-20">
                <p class="font-mono text-[#16a34a] text-7xl" x-text="showMessage" x-transition></p>
            </div>
        </div>
    @else
        <p class="text-xs">Tipe Gangguan tidak akan tampil sebelum menekan tombol G*</p>
    @endif

    <x-modal name="blur-md" blur="md" persistent>
        <x-card title="Caution" icon="exclamation-triangle">
            <p>
                Enable Content
            </p>

            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />

                <x-button primary label="I Agree" wire:click="agree" negative x-on:click="close" />
            </x-slot>
        </x-card>
    </x-modal>

    {{-- <div>
        <!-- Button is disabled after the first click -->
        <button wire:click="updateUser" wire:loading.attr="disabled" {{ $isButtonDisabled ? 'disabled' : '' }}
            class="px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-700 active:bg-green-800">
            Update User
        </button>

        <!-- Show a success message after the button is clicked -->
        @if (session()->has('message'))
            <div class="mt-3 alert alert-success">
                {{ session('message') }}
            </div>
            <button class="px-4 py-2 bg-gray-300 rounded-md opacity-50 cursor-not-allowed" disabled>
                Disabled Button
            </button>
        @endif
    </div> --}}

    {{-- <div>
        <!-- Disable the button based on the Livewire property $isButtonDisabled -->
        <button wire:click="updateUser" wire:loading.attr="disabled" {{ $isButtonDisabled ? 'disabled' : '' }}
            class="bg-green-500 hover:bg-green-700 active:bg-green-800 px-4 py-2 rounded-md text-white 
        {{ $isButtonDisabled ? 'bg-gray-300 cursor-not-allowed opacity-50' : '' }}">
            Test Disable button
        </button>

        <!-- Show a loading state or success message -->
        <div wire:loading wire:target="updateUser">
            Updating...
        </div>

        @if (session()->has('message'))
            <div class="mt-3 text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div> --}}


</div>
