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
            <select id="brand-select" name="brand" required>
                <option value="">Select a brand</option>
                <?php foreach ($devices as $device): ?>
                    <option value="<?php echo $device['brand']; ?>"><?php echo $device['brand']; ?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <span>Model</span>
            <select name="model" id="model-select" required disabled>
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
            <span>Price</span>
            <input type="text" name="price" required>
        </label>
    </fieldset>
    <button type="submit" value="Save">Add repair</button>
</form>

<script type="text/javascript">
    const modelOptions = document.querySelectorAll('.model-option');
    const branchSelect = document.querySelector('#brand-select');

    // On change of brand select, enable the model select and filter the models based on the selected brand
    branchSelect.addEventListener('change', function() {
        const selectedBrand = this.value;
        const modelSelect = document.querySelector('select[name="model"]');

        modelSelect.disabled = false;
        modelOptions.forEach(option => {
            if (option.dataset.brand === selectedBrand) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });
    });
</script>