$(".textareaCountable").keyup(function () {
  var characterCount = $(this).val().length,
    current = $("#current"),
    maximum = $("#maximum"),
    theCount = $("#the-count");

  current.text(characterCount);

  /*This isn't entirely necessary, just playin around*/
  if (characterCount < 221) {
    current.css("color", "#000000");
  }
  if (characterCount > 222 && characterCount < 350) {
    current.css("color", "#C65102");
  }
  if (characterCount >= 350) {
    maximum.css("color", "#C20F00");
    current.css("color", "#C20F00");
    theCount.css("font-weight", "bold");
  } else {
    maximum.css("color", "#000000");
    theCount.css("font-weight", "normal");
  }
});
