<h1><?php echo $title; ?></h1>
<table>
    <thead>
        <tr>
            <th>Part ID</th>
            <th>Part Name</th>
            <th>Part Purchase Price</th>
            <th>Part Sale Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($parts)): ?>
            <?php foreach ($parts as $part): ?>
                <tr id="part-row-<?php echo $part['id']; ?>">
                    <td><?php echo $part['id']; ?></td>
                    <td class="part-name" data-id="<?php echo $part['id']; ?>"><?php echo $part['name']; ?></td>
                    <td class="part-purchasePrice" data-id="<?php echo $part['id']; ?>"><?php echo $part['purchasePrice']; ?></td>
                    <td class="part-sellingPrice" data-id="<?php echo $part['id']; ?>"><?php echo $part['sellingPrice']; ?></td>
                    <td>
                        <button class="edit-btn" data-id="<?php echo $part['id']; ?>">Edit</button>
                        <button class="update-btn" data-id="<?php echo $part['id']; ?>" style="display: none;">Update</button>
                    </td>
                </tr>
                <tr id="edit-row-<?php echo $part['id']; ?>" style="display: none;">
                    <td colspan="5">
                        <form method="POST" action="/updatePart">
                            <input type="hidden" name="id" value="<?php echo $part['id']; ?>">
                            <input type="text" name="name" value="<?php echo $part['name']; ?>" required>
                            <input type="number" name="purchasePrice" value="<?php echo $part['purchasePrice']; ?>" required>
                            <input type="number" name="sellingPrice" value="<?php echo $part['sellingPrice']; ?>" required>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No parts found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const partId = this.getAttribute('data-id');
            document.getElementById(`part-row-${partId}`).style.display = 'none';
            document.getElementById(`edit-row-${partId}`).style.display = 'table-row';
            this.style.display = 'none'; // Hide the edit button
            document.querySelector(`.update-btn[data-id='${partId}']`).style.display = 'inline'; // Show the update button
        });
    });
</script>