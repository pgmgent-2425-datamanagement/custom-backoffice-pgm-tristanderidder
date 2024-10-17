<h1><?php echo $title; ?></h1>
<table>
    <thead>
        <tr>
            <th>Part ID</th>
            <th>Part Name</th>
            <th>Part Purchase Price</th>
            <th>Part Sale Price</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($parts)): ?>
            <?php foreach ($parts as $part): ?>
                <tr>
                    <td><?php echo $part['id']; ?></td>
                    <td><?php echo $part['name']; ?></td>
                    <td><?php echo $part['purchasePrice']; ?></td>
                    <td><?php echo $part['sellingPrice']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No parts found.</td>
            </tr>
        <?php endif; ?>
</table>