//Validate if at least one AREA checkbox is selected
(function () {
  function addValidation(checkboxes) {
    const firstCheckbox = getFirstCheckbox(checkboxes);

    if (firstCheckbox) {
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function () {
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
    const errorMessage = !isChecked(checkboxes)
      ? "É necessário ter pelo menos uma opção selecionada."
      : "";
    firstCheckbox.setCustomValidity(errorMessage);
  }

  const form = document.querySelector("#tutor-form");

  // Let's add a validation for the first group of checkboxes
  const checkboxes = form.querySelectorAll('input[name="area[]"]');
  addValidation(checkboxes);
})();

//Validate if at least one ENVIRONMENT checkbox is selected
(function () {
  function addValidation(checkboxes) {
    const firstCheckbox = getFirstCheckbox(checkboxes);

    if (firstCheckbox) {
      for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener("change", function () {
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
    const errorMessage = !isChecked(checkboxes)
      ? "É necessário ter pelo menos uma opção selecionada."
      : "";
    firstCheckbox.setCustomValidity(errorMessage);
  }

  const form = document.querySelector("#tutor-form");

  // Let's add a validation for the first group of checkboxes
  const checkboxes = form.querySelectorAll('input[name="environment[]"]');
  addValidation(checkboxes);
})();

//Validate if at least five CAPACITIES checkbox are selected
(function() {
    const form = document.querySelector('#tutor-form');
    const checkboxes = form.querySelectorAll('input[name="capacity[]"]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        const checkedCheckboxes = form.querySelectorAll('input[name="capacity[]"]:checked');

        return checkedCheckboxes.length == 5;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'Deve selecionar cinco capacidades.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();