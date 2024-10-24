<h1><?php echo $title; ?></h1>

<form>
    <label>
        <span>Month:</span>
        <input class="month-input" type="month" name="month" value="<?php echo date('Y-m'); ?>" min="<?php echo date('Y-m'); ?>">
    </label>
</form>

<canvas id="repairsChart" width="400" height="200"></canvas>


<table>
    <thead>
        <tr>
            <th>Repair Order ID</th>
            <th>Issue Reported</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Device type</th>
            <th>Device</th>
            <th>Technician</th>
            <th>Invoice Total</th>
            <th>Part Details</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($repairOrders)): ?>
            <?php foreach ($repairOrders as $order): ?>
                <tr>
                    <td><?php echo $order['repairorder_id']; ?></td>
                    <td><?php echo $order['issueReported']; ?></td>
                    <td><?php echo $order['status']; ?></td>
                    <td><?php echo $order['customer_firstname'] . ' ' . $order['customer_lastname']; ?></td>
                    <td><?php echo $order['device_type'] ?></td>
                    <td><?php echo $order['device_brand'] . ' ' . $order['device_model']; ?></td>
                    <td><?php echo $order['technician_firstname'] . ' ' . $order['technician_lastname']; ?></td>
                    <td><?php echo $order['invoice_total']; ?></td>
                    <td>
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
                <td colspan="8">No repair orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
    const monthInput = document.querySelector('.month-input');

    // On change of month input, reload the page with the new month
    monthInput.addEventListener('change', function(e) {
        e.preventDefault();
        // Extract the month from the value (formatted as YYYY-MM)
        const selectedDate = monthInput.value; // e.g., '2024-06'
        console.log(selectedDate);

        const month = selectedDate.split('-')[1]; // Extract '06'

        // Reload the page with the month value
        window.location.href = '/repairs?month=' + month;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    // Automatically detect the current month and year
    document.addEventListener('DOMContentLoaded', function() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth() + 1; // JavaScript months are 0-indexed, so we add 1
        const currentYear = currentDate.getFullYear();

        // Format the month to always be two digits (e.g., '04' for April)
        const formattedMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;
        const formattedDate = `${currentYear}-${formattedMonth}`; // Format: 'YYYY-MM'

        // PHP-generated repair data for the current month
        const repairsData = <?php echo json_encode($repairDataForMonth); ?>;

        // Prepare chart data
        const days = [];
        const repairCounts = [];

        // Assuming `repairsData` is an object where keys are day numbers, and values are repair counts
        for (let i = 1; i <= 31; i++) {
            days.push(i);
            repairCounts.push(repairsData[i] || 0); // Use 0 if no repairs for that day
        }

        // Create the chart
        const ctx = document.getElementById('repairsChart').getContext('2d');
        const repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: days, // Days of the month
                datasets: [{
                    label: `Repairs for ${formattedDate}`,
                    data: repairCounts, // Repair counts per day
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
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