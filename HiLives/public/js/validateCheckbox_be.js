(function() {
    function addValidation(checkboxes) {
        const firstCheckbox = getFirstCheckbox(checkboxes);

        if (firstCheckbox) {
            for (let i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', function() {
                    checkValidity(checkboxes, firstCheckbox);
                });
            }

            checkValidity(checkboxes, firstCheckbox);
        }
    }

    function getFirstCheckbox(checkboxes) {
        return checkboxes.length > 0 ? checkboxes[0] : null;
    }

    function isChecked(checkboxes) {
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity(checkboxes, firstCheckbox) {
        const errorMessage = !isChecked(checkboxes) ? 'U moet ten minste één optie hebben geselecteerd.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    const form = document.querySelector('#register-form');

    // Let's add a validation for the first group of checkboxes
    const checkboxes = form.querySelectorAll('input[name="area[]"]');
    addValidation(checkboxes);
})();