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
            <span>Brand</span>
            <select id="brand-select-invoice" name="invoice_brand" required>
                <option value="">Select a brand</option>
                <?php foreach ($devices as $device): ?>
                    <option value="<?php echo $device['brand']; ?>"><?php echo $device['brand']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Model</span>
            <select name="invoice_model" id="model-select-invoice" required disabled>
                <option value="">Select a model</option>
                <?php foreach ($devices as $device): ?>
                    <option class="model-option-invoice" name="device" value="<?= $device['id']; ?>" data-brand="<?= $device['brand']; ?>"><?= $device['model']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>
            <span>Parts</span>
            <div id="parts-container">
                <?php foreach ($parts as $part): ?>
                    <div class="part-option" data-model-id="<?= $part['model_id']; ?>">
                        <input type="checkbox" name="parts[]" value="<?= $part['id']; ?>"> <?= $part['name']; ?>
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
        const partsContainer = document.getElementById(partsContainerId);

        // On change of brand select, enable the model select and filter the models based on the selected brand
        brandSelect.addEventListener('change', function() {
            const selectedBrand = this.value;
            const modelSelect = document.querySelector(`#${modelSelectId}`);

            // Reset model selection and parts visibility
            modelSelect.disabled = false;
            modelSelect.value = ""; // Reset model selection
            partsContainer.querySelectorAll('.part-option').forEach(part => part.style.display = 'none');

            modelOptions.forEach(option => {
                if (option.dataset.brand === selectedBrand) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });

        // On change of model select, filter parts based on the selected model
        const modelSelect = document.querySelector(`#${modelSelectId}`);
        modelSelect.addEventListener('change', function() {
            const selectedModelId = this.value;

            // Show/hide parts based on the selected model
            const partOptions = partsContainer.querySelectorAll('.part-option');
            partOptions.forEach(part => {
                if (part.dataset.modelId === selectedModelId) {
                    part.style.display = 'block';
                } else {
                    part.style.display = 'none';
                }
            });

            // If no model is selected, hide all parts
            if (!selectedModelId) {
                partOptions.forEach(part => part.style.display = 'none');
            }
        });
    }

    // Initialize for device section
    setupBrandModelSelection('brand-select-device', 'model-select-device', 'model-option', 'parts-container');

    // Initialize for invoice section
    setupBrandModelSelection('brand-select-invoice', 'model-select-invoice', 'model-option-invoice', 'parts-container');
</script>