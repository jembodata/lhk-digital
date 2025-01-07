<?php

use Livewire\Volt\Component;
use App\Models\Porg_Data;

new class extends Component {
    //
    public function with(): array
    {

        $filterDate = request('filter_date', \Carbon\Carbon::today()->toDateString());

        return [
            'porg_data' => Auth::user()
                ->porg_data()
                ->whereDate('created_at', $filterDate)
                ->orderBy('created_at', 'desc') // Optionally order by a column
                ->with('user')
                ->get(),
            'user_name' => Auth::user()->name,
            'filter_date' => $filterDate
        ];
    }
}; ?>

<div>
    <div class="mb-5">
        <label for="filter_date" class="block text-gray-700">Filter by Date</label>
        <input type="date" id="filter_date" name="filter_date" class="p-2 border border-gray-300 rounded-lg" value="{{ request('filter_date', \Carbon\Carbon::today()->toDateString()) }}">
        <button type="submit" class="p-2 ml-2 text-white bg-blue-500 rounded-lg">Filter</button>
    </div>


    <div class="p-5 mb-5 bg-white rounded-lg shadow">
        <h2 class="text-lg font-semibold text-gray-800">Nama Operator: {{ $user_name }}</h2>
    </div>

    <table class="w-full table-fixed">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Shift</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Tanggal dan Waktu</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Status</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Type Size</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">No OP</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Target Output</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Actual Output</th>
                <th class="p-5 text-sm font-semibold leading-6 text-left text-gray-900 whitespace-nowrap">Hour Meter</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @foreach ($porg_data as $data)
            @php
            // Get the hour from created_at
            $createdAtHour = \Carbon\Carbon::parse($data->created_at)->format('H:i');

            // Determine the shift based on the created_at time
            if ($createdAtHour >= '06:45' && $createdAtHour < '15:15' ) {
                $shift='Shift 1' ;
                } elseif ($createdAtHour>= '14:45' && $createdAtHour < '23:15' ) {
                    $shift='Shift 2' ;
                    } elseif ($createdAtHour>= '22:45' || $createdAtHour < '07:15' ) {
                        $shift='Shift 3' ;
                        } else {
                        $shift='Unknown Shift' ;
                        }
                        @endphp
                        <tr class="transition-all duration-500 bg-white hover:bg-gray-50">
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap ">{{ $shift }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->created_at }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ Str::limit($data->Status, 50) }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->{"Type Size"} }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->{"No OP"} }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->{"Target Output"} }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->{"Actual Output"} }}</td>
                        <td class="p-5 text-sm font-medium leading-6 text-gray-900 whitespace-nowrap">{{ $data->{"Hour Meter"} }}</td>
                        </tr>
                        @endforeach
        </tbody>
    </table>
</div>