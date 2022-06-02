/*Change regions*/
var select = document.getElementById("pais");
var formularios = document.querySelectorAll(".formulario");

select.onchange = function () {
  for (var i = 0; i < formularios.length; i++)
    formularios[i].style.display = "none";
  var divID = select.options[select.selectedIndex].value;
  var div = document.getElementById(divID);
  div.style.display = "block";
};

/*Verify checkboxes required*/
(function () {
  const form = document.querySelector("#sectionForm");
  const checkboxes = form.querySelectorAll("input[type=checkbox]");
  const checkboxLength = checkboxes.length;
  const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

  function init() {
    if (firstCheckbox) {
      for (let i = 0; i < checkboxLength; i++) {
        checkboxes[i].addEventListener("change", checkValidity);
      }

      checkValidity();
    }
  }

  function isChecked() {
    const checkedCheckboxes = form.querySelectorAll(
      'input[type="checkbox"]:checked'
    );

    return checkedCheckboxes.length == 5;
  }

  function checkValidity() {
    const errorMessage = !isChecked()
      ? "You must select five capacities."
      : "";
    firstCheckbox.setCustomValidity(errorMessage);
  }

  init();
})();
