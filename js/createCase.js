function validateInput(input) {
  // List of forbidden characters and keywords
  var forbiddenChars = ["'", '"', ";", "--", "/*", "*/"];
  for (var i = 0; i < forbiddenChars.length; i++) {
    if (input.includes(forbiddenChars[i])) {
      return false;
    }
  }
  return true;
}

function nextQuestion() {
  if (
    victimOrNot.value != "" &&
    textGender.value != "" &&
    textCat.value != "" &&
    textCrime.value != "" &&
    offenderName.value != "" &&
    crimeDate.value != ""
  ) {
    if (currentQuestion < questions.length - 1) {
      questions[currentQuestion].classList.add("hide");
      currentQuestion++;
      questions[currentQuestion].classList.remove("hide");
      updateProgressBar();
    } else {
      submitForm();
    }
  } else {
    messageContent = "املأ كافة الحقول للانتقال للصفحة التالية";
    getDownMessage();
  }
}

function prevQuestion() {
  if (currentQuestion < questions.length) {
    questions[currentQuestion].classList.add("hide");
    currentQuestion--;
    questions[currentQuestion].classList.remove("hide");
    updateProgressBar();
  } else {
    submitForm();
  }
}

function updateProgressBar() {
  const progressPercentage = ((currentQuestion + 1) / questions.length) * 100;
  progressBar.style.width = progressPercentage + "%";
}
