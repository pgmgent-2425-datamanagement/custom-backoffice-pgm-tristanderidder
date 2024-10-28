<h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight text-center md:text-left border-b border-gray-400 pb-2">
    <?php echo $title; ?>
</h1>

<form method="POST" enctype="multipart/form-data" class="bg-gray-50 border border-gray-400 p-6 rounded-lg shadow-sm space-y-6 max-w-3xl mx-auto">
    <!-- Customer Section -->
    <fieldset class="border border-gray-400 rounded-lg p-4">
        <legend class="text-lg font-semibold text-gray-700">Customer</legend>

        <!-- Firstname -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Firstname</span>
            <input type="text" name="firstname" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
        </label>

        <!-- Lastname -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Lastname</span>
            <input type="text" name="lastname" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
        </label>

        <!-- Phone Number -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Phone number</span>
            <input type="text" name="phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
        </label>
    </fieldset>

    <!-- Device Section -->
    <fieldset class="border border-gray-400 rounded-lg p-4">
        <legend class="text-lg font-semibold text-gray-700">Device</legend>

        <!-- Brand Select -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Brand</span>
            <select id="brand-select-device" name="brand" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                <option value="">Select a brand</option>
                <?php foreach ($devices as $device): ?>
                    <option value="<?php echo $device['brand']; ?>"><?php echo $device['brand']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <!-- Model Select -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Model</span>
            <select name="model" id="model-select-device" required disabled class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                <option value="">Select a model</option>
                <?php foreach ($devices as $device): ?>
                    <option class="model-option" name="device" value="<?= $device['id']; ?>" data-brand="<?= $device['brand']; ?>"><?= $device['model']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </fieldset>

    <!-- Repair Section -->
    <fieldset class="border border-gray-400 rounded-lg p-4">
        <legend class="text-lg font-semibold text-gray-700">Repair</legend>

        <!-- Problem -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Problem</span>
            <textarea name="problem" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"></textarea>
        </label>

        <!-- Technician Select -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Technician</span>
            <select name="technician" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
                <?php foreach ($technicians as $technician): ?>
                    <option value="<?php echo $technician['id']; ?>"><?php echo $technician['firstname'] . ' ' . $technician['lastname']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <!-- Image -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Image</span>
            <input type="file" name="image" accept="image/*" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
        </label>
    </fieldset>

    <!-- Invoice Section -->
    <fieldset class="border border-gray-400 rounded-lg p-4">
        <legend class="text-lg font-semibold text-gray-700">Invoice</legend>

        <!-- Parts List -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Parts</span>
            <div id="parts-container" class="mt-2">
                <p class="text-gray-600">Please select a brand and model to view parts.</p>
                <?php foreach ($parts as $part): ?>
                    <div class="part-option" data-model-id="<?= $part['device_id']; ?>">
                        <input type="checkbox" name="parts[]" value="<?= $part['id']; ?>" class="part-checkbox" data-price="<?= $part['sellingPrice']; ?>"> <?= $part['name']; ?>
                        <span class="text-gray-600">€<?= $part['sellingPrice']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </label>

        <!-- Price Input -->
        <label class="block mt-4">
            <span class="text-gray-700 font-semibold">Price</span>
            <input type="text" name="price" id="price-input" required readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500">
        </label>
    </fieldset>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg px-4 py-3 transition">
        Add Repair
    </button>
</form>


<script type="text/javascript">
    function setupBrandModelSelection(brandSelectId, modelSelectId, modelOptionsClass, partsContainerId) {
        const modelOptions = document.querySelectorAll(`.${modelOptionsClass}`);
        const brandSelect = document.querySelector(`#${brandSelectId}`);
        const modelSelect = document.querySelector(`#${modelSelectId}`);
        const partsContainer = document.getElementById(partsContainerId);

        // Hide all parts initially
        const partOptions = document.querySelectorAll('.part-option');
        partOptions.forEach(part => part.style.display = 'none'); // Hide all parts on load

        // On change of brand select, enable the model select and filter the models based on the selected brand
        brandSelect.addEventListener('change', function() {
            const selectedBrand = this.value;
            console.log('Selected Brand:', selectedBrand);

            modelSelect.disabled = false; // Enable model select

            modelOptions.forEach(option => {
                if (option.dataset.brand === selectedBrand) {
                    option.style.display = 'block'; // Show matching models
                } else {
                    option.style.display = 'none'; // Hide non-matching models
                }
            });

            // Reset model select and clear parts container
            modelSelect.value = '';
            partsContainer.innerHTML = '<p>Please select a brand and model to view parts.</p>'; // Reset message
        });

        // On change of model select, filter parts based on the selected model
        modelSelect.addEventListener('change', function() {
            const selectedModelId = this.value; // Get the selected model ID

            // Clear parts container before displaying new parts
            partsContainer.innerHTML = '<p>Please select a brand and model to view parts.</p>'; // Reset message

            // Show parts only if a model is selected
            if (selectedModelId) {
                let hasParts = false;

                partOptions.forEach(part => {
                    // Use the model ID to match against the selected model
                    if (part.dataset.modelId == selectedModelId) { // Use == for string comparison
                        part.style.display = 'block'; // Show matching part
                        partsContainer.appendChild(part); // Append the visible part
                        hasParts = true; // Indicate that we found at least one part
                    }
                });

                // If no parts found, display message
                if (!hasParts) {
                    partsContainer.innerHTML = '<p>No parts available for the selected model.</p>';
                }

                console.log('Selected Model ID:', selectedModelId);
            }
        });
    }

    // Initialize for device section
    setupBrandModelSelection('brand-select-device', 'model-select-device', 'model-option', 'parts-container');

    // Function to update total price based on selected parts
    function updateTotalPrice() {
        const checkboxes = document.querySelectorAll('.part-checkbox');
        let totalPrice = 0;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                totalPrice += parseFloat(checkbox.getAttribute('data-price'));
            }
        });

        // Update the price input field with the total price
        document.getElementById('price-input').value = totalPrice.toFixed(2); // Format to 2 decimal places
    }

    // Add event listeners to checkboxes to update the total price on change
    const partCheckboxes = document.querySelectorAll('.part-checkbox');
    partCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotalPrice);
    });
</script>