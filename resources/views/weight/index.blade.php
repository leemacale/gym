<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="px-8 overflow-x-auto">
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Weight Progress') }}
                </h2>
      
                    <x-bladewind::button color="gray" icon="plus"
                        onclick="window.location='{{ route('weight.add') }}'">Add</x-bladewind::button>
             
            </div>
        </x-slot>
 <canvas id="weightChart" width="600" height="400"></canvas>


        <div class="mt-6 bg-white divide-y rounded-lg shadow-sm overflow-x">
            <x-bladewind::table compact="true" divider="thin" striped="true" celled="true" class="overflow-scroll"
                searchable="true">

                <x-slot name="header">
                    <th>Date</th>
                    <th>Weight</th>
                    <th>Remarks</th>

                    <th></th>
                </x-slot>
                @foreach ($weight as $weights)
                    <tr>
                        <td>{{ $weights->date }}</td>
                        <td>{{ $weights->weight }}</td>
                        <td>{{ $weights->remarks }}</td>
                        <td>
                            <form method="POST" action="{{ route('weight.destroy', $weights->id) }}">
                                @csrf
                                @method('DELETE')
                          
                                    <x-bladewind::button color="gray" icon="trash" title="delete" class="w-full m-2"
                                        can_submit="true">DELETE</x-bladewind::button>
                            
                            </form>
                        </td>
                   
                    </tr>
                @endforeach
            </x-bladewind::table>


        </div>
    </div>
</x-app-layout>

 <script>
        fetch('/chart/weights')
            .then(res => res.json())
            .then(data => {
                const labels = data.map(entry => new Date(entry.date).toLocaleDateString());
                const weights = data.map(entry => entry.weight);
                const remarks = data.map(entry => entry.remarks);

                const ctx = document.getElementById('weightChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Weight over Time',
                            data: weights,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            tension: 0.2
                        }]
                    },
                    options: {
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const index = context.dataIndex;
                                        const weight = context.raw;
                                        const remark = remarks[index] ?? 'No remarks';
                                        return `Weight: ${weight} kg\nNote: ${remark}`;
                                    }
                                }
                            }
                        },
                        onClick: function(evt) {
                            const points = chart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
                            if (points.length) {
                                const index = points[0].index;
                                const remark = remarks[index];
                                alert(`Date: ${labels[index]}\nWeight: ${weights[index]} kg\nRemark: ${remark || 'No remarks'}`);
                            }
                        },
                        scales: {
                            x: { title: { display: true, text: 'Date' } },
                            y: { title: { display: true, text: 'Weight (kg)' } }
                        }
                    }
                });
            });
    </script>