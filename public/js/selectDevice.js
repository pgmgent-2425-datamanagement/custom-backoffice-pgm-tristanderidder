document.getElementById('modelInput').addEventListener('input', function () {
    var device = document.getElementById('deviceDropdown').value;
    var brand = document.getElementById('brandDropdown').value;
    var model = this.value;

    if (device && brand && model) {
        fetch(`/validateModel?device=${device}&brand=${brand}&model=${model}`)
            .then(response => response.json())
            .then(data => {
                const resultElement = document.getElementById('modelCheckResult');
                if (data.exists) {
                    resultElement.textContent = "Model number exists.";
                    resultElement.style.color = "green";
                } else {
                    resultElement.textContent = "Model number not found.";
                    resultElement.style.color = "red";
                }
            });
    }
});