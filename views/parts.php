<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight text-center md:text-left border-b border-gray-400 pb-2">
    <?php echo $title; ?>
</h1>

<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm">
        <thead class="bg-gray-100 text-gray-800">
            <tr>
                <th class="py-3 px-4 text-left font-semibold border-b border-gray-400">Part ID</th>
                <th class="py-3 px-4 text-left font-semibold border-b border-gray-400">Part Name</th>
                <th class="py-3 px-4 text-left font-semibold border-b border-gray-400">Part Purchase Price</th>
                <th class="py-3 px-4 text-left font-semibold border-b border-gray-400">Part Sale Price</th>
                <th class="py-3 px-4 text-left font-semibold border-b border-gray-400">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($parts)): ?>
                <?php foreach ($parts as $part): ?>
                    <tr id="part-row-<?php echo $part['id']; ?>" class="border-b border-gray-300">
                        <td class="py-3 px-4 border-b border-gray-300"><?php echo $part['id']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 part-name" data-id="<?php echo $part['id']; ?>"><?php echo $part['name']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 part-purchasePrice" data-id="<?php echo $part['id']; ?>">€<?php echo $part['purchasePrice']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300 part-sellingPrice" data-id="<?php echo $part['id']; ?>">€<?php echo $part['sellingPrice']; ?></td>
                        <td class="py-3 px-4 border-b border-gray-300">
                            <button class="edit-btn bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md border border-gray-400" data-id="<?php echo $part['id']; ?>">Edit</button>
                            <button class="update-btn bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-md border border-gray-400" data-id="<?php echo $part['id']; ?>" style="display: none;">Update</button>
                            <form method="POST" action="/deletePart" style="display: inline;">
                                <input type="hidden" name="id" value="<?php echo $part['id']; ?>">
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-md border border-gray-400" onclick="return confirm('Are you sure you want to delete this part?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="edit-row-<?php echo $part['id']; ?>" class="bg-gray-50" style="display: none;">
                        <td colspan="5" class="py-3 px-4">
                            <form method="POST" action="/updatePart" class="space-y-4">
                                <input type="hidden" name="id" value="<?php echo $part['id']; ?>">
                                <div class="flex space-x-4">
                                    <input type="text" name="name" value="<?php echo $part['name']; ?>" required class="w-full rounded-md border border-gray-400 shadow-sm focus:border-gray-600 focus:ring focus:ring-gray-300">
                                    <input type="number" name="purchasePrice" value="<?php echo $part['purchasePrice']; ?>" required class="w-full rounded-md border border-gray-400 shadow-sm focus:border-gray-600 focus:ring focus:ring-gray-300">
                                    <input type="number" name="sellingPrice" value="<?php echo $part['sellingPrice']; ?>" required class="w-full rounded-md border border-gray-400 shadow-sm focus:border-gray-600 focus:ring focus:ring-gray-300">
                                </div>
                                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md border border-gray-400">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="py-3 px-4 text-center text-gray-500">No parts found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

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