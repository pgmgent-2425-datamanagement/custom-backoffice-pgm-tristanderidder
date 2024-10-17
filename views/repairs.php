<h1><?php echo $title; ?></h1>

<form>
    <label>
        <span>Month:</span>
        <input class="month-input" type="month" name="month" value="<?php echo date('Y-m'); ?>" min="<?php echo date('Y-m'); ?>">
    </label>
</form>


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
                    <td>
                        <?php if ($order['status'] === 'In Progress'): // Only show button for In Progress orders 
                        ?>
                            <form action="/updateRepairOrder" method="post">
                                <input type="hidden" name="repairorder_id" value="<?php echo $order['repairorder_id']; ?>">
                                <button type="submit">Update</button>
                            </form>



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