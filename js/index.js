
const textboxInput = document.getElementById("idNumberType");
const dropdownList = document.getElementById("dropdownList");

textboxInput.addEventListener("click", function () {
  dropdownList.style.display =
    dropdownList.style.display === "block" ? "none" : "block";
});

const dropdownOptions = document.getElementsByClassName("dropdown-option");
for (let i = 0; i < dropdownOptions.length; i++) {
  dropdownOptions[i].addEventListener("click", function () {
    textboxInput.value = dropdownOptions[i].textContent;
    dropdownList.style.display = "none";
  });
}

function openHome() {
  window.open("main.php", "_self");
}

function showMessage() {
  document.getElementById("mv").classList.toggle("m_width");
}

document
  .getElementById("registerAccount")
  .addEventListener("click", function (event) {
    event.preventDefault();
    document.getElementById("log").style.display = "none";
    document.getElementById("reg").style.display = "flex";
  });

document.getElementById("login").addEventListener("click", function (event) {
  event.preventDefault();
  document.getElementById("reg").style.display = "none";
  document.getElementById("log").style.display = "flex";
});
