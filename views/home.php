<h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6 tracking-tight text-center md:text-left">
    <?php echo $title; ?>
</h1>

<div class="flex flex-col md:flex-row gap-6 mb-6">
    <!-- Left Column -->
    <div class="w-full md:w-4/12 flex flex-col items-center justify-center bg-secondary rounded-2xl shadow-lg p-6">
        <canvas id="repairsChart" class="mb-4"></canvas>
        <div class="text-center space-y-2">
            <p class="text-lg font-medium">Total invoices today: <?= $totalInvoices; ?></p>
            <p class="text-lg font-medium">Total repairs today: <?php echo $totalRepairsToday; ?></p>
        </div>
    </div>

    <!-- Right Column -->
    <div class="w-full md:w-8/12 bg-secondary rounded-2xl shadow-lg p-6">
        <canvas id="repairsChart2"></canvas>
    </div>
</div>

<!-- Table -->
<table class="w-full bg-secondary rounded-2xl shadow-lg py-4 mt-6 text-sm">
    <thead class="bg-[#d8e8f7] text-blue-900">
        <tr class="text-left">
            <th class="px-2 md:px-4 py-2">Issue Reported</th>
            <th class="px-2 md:px-4 py-2">Status</th>
            <th class="px-2 md:px-4 py-2">Customer Name</th>
            <th class="px-2 md:px-4 py-2">Device Type</th>
            <th class="px-2 md:px-4 py-2">Device</th>
            <th class="px-2 md:px-4 py-2">Technician</th>
            <th class="px-2 md:px-4 py-2">Invoice Total</th>
            <th class="px-2 md:px-4 py-2">Part Details</th>
            <th class="px-2 md:px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white text-gray-700">
        <?php if (!empty($repairOrders)): ?>
            <?php foreach ($repairOrders as $order): ?>
                <tr class="border-b">
                    <td class="px-2 md:px-4 py-2"><?php echo $order['issueReported']; ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['status']; ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['customer_firstname'] . ' ' . $order['customer_lastname']; ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['device_type'] ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['device_brand'] . ' ' . $order['device_model']; ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['technician_firstname'] . ' ' . $order['technician_lastname']; ?></td>
                    <td class="px-2 md:px-4 py-2"><?php echo $order['invoice_total']; ?></td>
                    <td class="px-2 md:px-4 py-2">
                        <?php if (!empty($order['part_name'])): ?>
                            Part ID: <?php echo $order['part_name']; ?>
                        <?php else: ?>
                            No parts used
                        <?php endif; ?>
                    </td>
                    <td class="px-2 md:px-4 py-2 flex space-x-2">
                        <?php if ($order['status'] === 'In Progress'): ?>
                            <form action="/updateRepairOrder" method="post">
                                <input type="hidden" name="repairorder_id" value="<?php echo $order['repairorder_id']; ?>">
                                <button class="bg-green-500 hover:bg-green-700 text-white rounded-xl px-4 py-2 transition">Completed</button>
                            </form>
                        <?php endif; ?>
                        <form action="/deleteRepairOrder" method="post">
                            <input type="hidden" name="repairorder_id" value="<?php echo $order['repairorder_id']; ?>">
                            <button class="bg-red-500 hover:bg-red-700 text-white rounded-xl px-4 py-2 transition">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9" class="text-center py-4">No repair orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const totalRepairsToday = <?php echo $totalInvoices; ?>;
        const completedRepairsToday = <?php echo $totalCompletedRepairsToday; ?>;
        const remainingRepairs = totalRepairsToday - completedRepairsToday;

        const ctx = document.getElementById('repairsChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Repairs', 'Remaining Repairs'],
                datasets: [{
                    data: [completedRepairsToday, remainingRepairs],
                    backgroundColor: ['#4caf50', '#f44336'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Repairs Overview for Today'
                    }
                }
            }
        });
    });
</script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1;
        const currentYear = currentDate.getFullYear();
        const formattedMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;
        const formattedDate = `${currentYear}-${formattedMonth}`;

        const repairsData = <?php echo json_encode($repairDataForMonth); ?>;
        const days = Array.from({
            length: 31
        }, (_, i) => i + 1);
        const repairCounts = days.map(day => repairsData[day] || 0);

        const ctx = document.getElementById('repairsChart2').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: `Repairs for ${formattedDate}`,
                    data: repairCounts,
                    backgroundColor: '#4caf50',
                    borderColor: '#f44336',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Repairs'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Day of the Month'
                        }
                    }
                }
            }
        });
    });
</script>