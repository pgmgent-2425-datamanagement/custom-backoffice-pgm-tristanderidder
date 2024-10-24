<h1 class="text-3xl font-bold underline"><?php echo $title; ?></h1>

<p>Total invoices today: <?php echo $totalInvoices; ?></p>
<canvas id="repairsChart" width="400" height="200"></canvas>


<p>Total repairs today: <?php echo $totalRepairsToday; ?></p>

<table>
    <thead>
        <tr>
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
                    <td>
                        <?php if ($order['status'] === 'In Progress'): // Only show button for In Progress orders 
                        ?>
                            <form action="/updateRepairOrder" method="post">
                                <input type="hidden" name="repairorder_id" value="<?php echo $order['repairorder_id']; ?>">
                                <button type="submit">Completed</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="/deleteRepairOrder" method="post">
                            <input type="hidden" name="repairorder_id" value="<?php echo $order['repairorder_id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
    // When the page loads, create the doughnut chart
    document.addEventListener('DOMContentLoaded', function() {
        // PHP-generated data
        const totalRepairsToday = <?php echo $totalInvoices; ?>;
        const completedRepairsToday = <?php echo $totalCompletedRepairsToday; ?>;

        // Remaining repairs (Total - Completed)
        const remainingRepairs = totalRepairsToday - completedRepairsToday;

        // Create the chart
        const ctx = document.getElementById('repairsChart').getContext('2d');
        const repairsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Completed Repairs', 'Remaining Repairs'],
                datasets: [{
                    data: [completedRepairsToday, remainingRepairs], // Completed and remaining repairs
                    backgroundColor: ['#4caf50', '#f44336'], // Green for completed, red for remaining
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: `Repairs Overview for Today`
                    }
                }
            }
        });
    });
</script>