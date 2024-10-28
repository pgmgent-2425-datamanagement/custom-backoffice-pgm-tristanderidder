<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight text-center md:text-left border-b border-gray-400 pb-2">
    <?php echo $title; ?>
</h1>

<form class="mb-6">
    <label class="flex items-center space-x-3">
        <span class="text-lg font-semibold text-gray-700">Month:</span>
        <input class="month-input w-48 border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500" type="month" name="month" value="<?php echo date('Y-m'); ?>" min="<?php echo date('Y-m'); ?>">
    </label>
</form>

<div class="flex flex-col gap-4">
    <!-- Chart Container -->
    <div class="bg-gray-50 border border-gray-300 rounded-lg shadow-sm p-4 w-full">
        <canvas id="repairsChart" width="400" height="200"></canvas>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto w-full">
        <table class="min-w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Repair Order ID</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Issue Reported</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Status</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Customer Name</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Device Type</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Device</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Technician</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Invoice Total</th>
                    <th class="py-3 px-4 text-left font-semibold border-b border-gray-300">Part Details</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($repairOrders)): ?>
                    <?php foreach ($repairOrders as $order): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['repairorder_id']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['issueReported']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['status']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['customer_firstname'] . ' ' . $order['customer_lastname']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['device_type']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['device_brand'] . ' ' . $order['device_model']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300"><?php echo $order['technician_firstname'] . ' ' . $order['technician_lastname']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300">€<?php echo $order['invoice_total']; ?></td>
                            <td class="py-3 px-4 border-r border-gray-300">
                                <?php if (!empty($order['part_name'])): ?>
                                    Part ID: <?php echo $order['part_name']; ?>
                                <?php else: ?>
                                    No parts used
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="py-3 px-4 text-center text-gray-500">No repair orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<script type="text/javascript">
    const monthInput = document.querySelector('.month-input');

    // On change of month input, reload the page with the new month
    monthInput.addEventListener('change', function(e) {
        e.preventDefault();
        const selectedDate = monthInput.value; // e.g., '2024-06'
        const month = selectedDate.split('-')[1]; // Extract '06'
        window.location.href = '/repairs?month=' + month;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1; // JavaScript months are 0-indexed
        const currentYear = currentDate.getFullYear();
        const formattedMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;
        const formattedDate = `${currentYear}-${formattedMonth}`;

        // PHP-generated repair data for the current month
        const repairsData = <?php echo json_encode($repairDataForMonth); ?>;

        const days = [];
        const repairCounts = [];
        const backgroundColors = [];

        // Assuming `repairsData` is an object where keys are day numbers, and values are repair counts
        for (let i = 1; i <= 31; i++) {
            days.push(i);
            repairCounts.push(repairsData[i] || 0);
            // Alternate colors between #F4F0EC and #242124
            backgroundColors.push(i % 2 === 0 ? '#F4F0EC' : '#242124');
        }

        // Create the chart
        const ctx = document.getElementById('repairsChart').getContext('2d');
        const repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: days,
                datasets: [{
                    label: `Repairs for ${formattedDate}`,
                    data: repairCounts,
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
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