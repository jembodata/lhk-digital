<x-app-layout>
    
    <div class="py-1">
        <div class="grid items-center grid-cols-2 grid-rows-1 justify-items-center">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Laporan Harian kerja LHK
            </h2>
            {{-- <div>@livewire('clock')</div> --}}
            <div>
                <livewire:helper.clock>
                
            </div>
        </div>
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <section>
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <livewire:porg.create-porg>

                    {{-- <div class="grid grid-cols-4 gap-4 px-2 py-3 justify-items-center">
                        <!-- <div
                            class="flex items-center justify-center w-24 h-24 mx-32 transition-all duration-150 ease-in-out transform rounded-full shadow-md shadow-[#000] cursor-pointer bg-cyan-400 active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button id="test" class="font-bold text-gray-900 text-7xl">
                                P
                            </button>
                        </div>

                        <div
                            class="flex items-center justify-center w-24 h-24 mx-32 transition-all duration-150 ease-in-out transform rounded-full shadow-md shadow-[#000] cursor-pointer bg-[#22c55e] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button id="test" class="font-bold text-gray-900 text-7xl">
                                O
                            </button>
                        </div> -->

                        <div
                            class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-cyan-400 shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button class="font-bold text-gray-900 text-7xl">
                                P
                            </button>
                        </div>
                        <div
                            class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#22c55e] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button class="font-bold text-gray-900 text-7xl">
                                O
                            </button>
                        </div>
                        <div
                            class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#f59e0b] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button id="test" class="font-bold text-gray-900 text-7xl">
                                R
                            </button>
                        </div>
                        <div
                            class="flex items-center justify-center w-24 h-24 mx-32 rounded-full bg-[#e11d48] shadow-md shadow-[#000] active:transform active:translate-y-1 active:shadow-none focus:outline-none">
                            <button class="font-bold text-gray-900 text-7xl">
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
                    </div> --}}
                    

                    {{-- <div x-data="{ showMessage: '' }" class="text-center">
                        <button @click="showMessage = 'Tidak ada Order'"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            TAO
                        </button>

                        <button @click="showMessage = 'Tidak ada Bahan'"
                            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                            TB
                        </button>

                        <div class="mt-6 bg-[#000] shadow sm:p-3 sm:rounded-lg flex items-center justify-center h-20">
                            <div x-text="showMessage" x-transition class="font-mono text-[#16a34a] text-7xl">
                                --
                            </div>
                        </div>
                    </div> --}}

            </section>
        </div>
    </div>
</x-app-layout>
