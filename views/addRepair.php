<h1><?php echo $title; ?></h1>

<form method="POST">
    <fieldset>
        <legend>Customer</legend>
        <label>
            <span>Firstname</span>
            <input type="text" name="firstname" required>
        </label>
        <label>
            <span>Lastname</span>
            <input type="text" name="lastname" required>
        </label>
        <label>
            <span>Phone number</span>
            <input type="text" name="phone" required>
        </label>
    </fieldset>

    <fieldset>
        <legend>Device</legend>
        <label>
            <span>Brand</span>
            <select id="brand-select-device" name="brand" required>
                <option value="">Select a brand</option>
                <?php foreach ($devices as $device): ?>
                    <option value="<?php echo $device['brand']; ?>"><?php echo $device['brand']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Model</span>
            <select name="model" id="model-select-device" required disabled>
                <option value="">Select a model</option>
                <?php foreach ($devices as $device): ?>
                    <option class="model-option" name="device" value="<?= $device['id']; ?>" data-brand="<?= $device['brand']; ?>"><?= $device['model']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </fieldset>

    <fieldset>
        <legend>Repair</legend>
        <label>
            <span>Problem</span>
            <textarea name="problem" required></textarea>
        </label>
        <label>
            <span>Technician</span>
            <select name="technician">
                <?php foreach ($technicians as $technician): ?>
                    <option value="<?php echo $technician['id']; ?>"><?php echo $technician['firstname'] . ' ' . $technician['lastname']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
    </fieldset>

    <fieldset>
        <legend>Invoice</legend>
        <label>
            <span>Parts</span>
            <div id="parts-container">
                <p>Please select a brand and model to view parts.</p>
                <!-- Parts will be populated here based on selections -->
                <?php foreach ($parts as $part): ?>
                    <div class="part-option" data-model-id="<?= $part['device_id']; ?>">
                        <input type="checkbox" name="parts[]" value="<?= $part['id']; ?>"> <?= $part['name']; ?>
                        <span>€<?= $part['sellingPrice']?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </label>
        <label>
            <span>Price</span>
            <input type="text" name="price" required>
        </label>
    </fieldset>
    <button type="submit" value="Save">Add repair</button>
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
</script>