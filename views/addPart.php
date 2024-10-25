<h1 class="text-4xl md:text-5xl font-extrabold text-blue-900 mb-6 tracking-tight text-center md:text-left">
    <?php echo $title; ?>
</h1>

<form method="POST" class="bg-white p-6 rounded-xl shadow-md space-y-6 max-w-lg mx-auto">
    <!-- Part Name -->
    <label class="block">
        <span class="text-gray-700 font-semibold">Part Name</span>
        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </label>

    <!-- Purchase Price -->
    <label class="block">
        <span class="text-gray-700 font-semibold">Purchase Price</span>
        <input type="number" name="purchase_price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </label>

    <!-- Selling Price -->
    <label class="block">
        <span class="text-gray-700 font-semibold">Selling Price</span>
        <input type="number" name="selling_price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
    </label>

    <!-- Device Section -->
    <fieldset class="border border-gray-200 rounded-xl p-4">
        <legend class="text-lg font-semibold text-gray-700">Device</legend>

        <!-- Brand Select -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Brand</span>
            <select id="brand-select-device" name="brand" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Select a brand</option>
                <?php foreach ($devices as $device): ?>
                    <option value="<?php echo $device['brand']; ?>"><?php echo $device['brand']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <!-- Model Select -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Model</span>
            <select name="model" id="model-select-device" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="">Select a model</option>
                <?php foreach ($devices as $device): ?>
                    <option class="model-option" name="device" value="<?= $device['id']; ?>" data-brand="<?= $device['brand']; ?>"><?= $device['model']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </fieldset>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl px-4 py-3 transition">
        Add Part
    </button>
</form>

<script type="text/javascript">
    function setupBrandModelSelection(brandSelectId, modelSelectId, modelOptionsClass, partsContainerId) {
        const modelOptions = document.querySelectorAll(`.${modelOptionsClass}`);
        const brandSelect = document.querySelector(`#${brandSelectId}`);
        const modelSelect = document.querySelector(`#${modelSelectId}`);
        const partsContainer = document.getElementById(partsContainerId);

        brandSelect.addEventListener('change', function() {
            const selectedBrand = this.value;
            modelSelect.disabled = false;
            modelOptions.forEach(option => {
                option.style.display = option.dataset.brand === selectedBrand ? 'block' : 'none';
            });
        });

        modelSelect.addEventListener('change', function() {
            const selectedModelId = this.value;
            partsContainer.innerHTML = selectedModelId ? '<p>No parts available for the selected model.</p>' : '<p>Please select a brand and model to view parts.</p>';
        });
    }

    setupBrandModelSelection('brand-select-device', 'model-select-device', 'model-option', 'parts-container');
</script>