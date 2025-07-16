var messageContent = "اختار صنف الجريمة اولا";
const offenderName = document.getElementById("offender_name");
const crimeDate = document.getElementById("crime_date");

const victimOrNot = document.getElementById("victimOrNot");
const dropdownList_1 = document.getElementById("dropdownList_1");

victimOrNot.addEventListener("click", function () {
  dropdownList_1.style.display =
    dropdownList_1.style.display === "block" ? "none" : "block";
});

const dropdownOptions = document.getElementsByClassName("dropdown-option_1");
for (let i = 0; i < dropdownOptions.length; i++) {
  dropdownOptions[i].addEventListener("click", function () {
    victimOrNot.value = dropdownOptions[i].textContent;
    dropdownList_1.style.display = "none";
  });
}

document.addEventListener("click", function (event) {
  if (!dropdownList_1.contains(event.target) && event.target !== victimOrNot) {
    dropdownList_1.style.display = "none";
  }
});

// *********************************************

const textGender = document.getElementById("offender_gender");
const dropdownList_2 = document.getElementById("dropdownList_2");

textGender.addEventListener("click", function () {
  dropdownList_2.style.display =
    dropdownList_2.style.display === "block" ? "none" : "block";
});

const dropdownOptions_2 = document.getElementsByClassName("dropdown-option_2");
for (let i = 0; i < dropdownOptions_2.length; i++) {
  dropdownOptions_2[i].addEventListener("click", function () {
    textGender.value = dropdownOptions_2[i].textContent;
    dropdownList_2.style.display = "none";
  });
}

document.addEventListener("click", function (event) {
  if (!dropdownList_2.contains(event.target) && event.target !== textGender) {
    dropdownList_2.style.display = "none";
  }
});

// *************************************************************

const textCat = document.getElementById("crime_cat");
const dropdownList_4 = document.getElementById("dropdownList_4");
var crimeCatID = "";
var specific_id = "";
var class_name = "";

textCat.addEventListener("click", function () {
  dropdownList_4.style.display =
    dropdownList_4.style.display === "block" ? "none" : "block";
});

const dropdownOptions_4 = document.getElementsByClassName("dropdown-option_4");
for (let i = 0; i < dropdownOptions_4.length; i++) {
  dropdownOptions_4[i].addEventListener("click", function () {
    textCat.value = dropdownOptions_4[i].textContent;
    crimeCatID = dropdownOptions_4[i].id;
    getDropId(crimeCatID);
    work();
    dropdownList_4.style.display = "none";
  });
}

document.addEventListener("click", function (event) {
  if (!dropdownList_4.contains(event.target) && event.target !== textCat) {
    dropdownList_4.style.display = "none";
  }
});

// ***************************************************
const textCrime = document.getElementById("crime_type");
function work() {
  const dropdownList_3 = document.getElementById(specific_id);
  const dropdownOptions_3 = document.getElementsByClassName(class_name);

  for (let i = 0; i < dropdownOptions_3.length; i++) {
    dropdownOptions_3[i].addEventListener("click", function () {
      textCrime.value = dropdownOptions_3[i].textContent;
      // console.log(dropdownOptions_3[i].textContent);
      dropdownList_3.style.display = "none";
    });
  }

  document.addEventListener("click", function (event) {
    if (!dropdownList_3.contains(event.target) && event.target !== textCrime) {
      dropdownList_3.style.display = "none";
    }
  });
}

// *********************************************
textCrime.addEventListener("click", function () {
  if (textCat.value == "") {
    const message = document.createElement("div");
    message.id = "chooseCat";
    messageContent = "اختار صنف الجريمة اولا";
    message.textContent = messageContent;
    // textCat.focus();
    document.body.appendChild(message);

    setTimeout(function () {
      message.style.top = "15%"; // Move the message down to its final position
      setTimeout(function () {
        message.style.top = "-50px"; // Move the message up
        setTimeout(function () {
          message.remove();
        }, 2000);
      }, 2000); // Adjust the delay before moving up here
    }, 10);
  } else {
    // console.log(crimeCatID);
    if (crimeCatID == "environment") {
      document.getElementById("dropdownList_5").style.display = "block";
      // displayNone();
    } else if (crimeCatID == "properties") {
      document.getElementById("dropdownList_3").style.display = "block";
      // displayNone();
    } else if (crimeCatID == "drugs") {
      document.getElementById("dropdownList_6").style.display = "block";
      // displayNone();
    } else if (crimeCatID == "insult") {
      document.getElementById("dropdownList_7").style.display = "block";
      // displayNone();
    }
  }
});
// ***************************************************************

function getDropId(id) {
  if (id == "environment") {
    specific_id = "dropdownList_5";
    class_name = "dropdown-option_5";
  } else if (id == "properties") {
    specific_id = "dropdownList_3";
    class_name = "dropdown-option_3";
  } else if (id == "drugs") {
    specific_id = "dropdownList_6";
    class_name = "dropdown-option_6";
  } else if (id == "insult") {
    specific_id = "dropdownList_7";
    class_name = "dropdown-option_7";
  }
}

function getDownMessage() {
  const message = document.createElement("div");
  message.id = "chooseCat";
  message.textContent = messageContent;
  // textCat.focus();
  document.body.appendChild(message);

  setTimeout(function () {
    message.style.top = "15%"; // Move the message down to its final position
    setTimeout(function () {
      message.style.top = "-50px"; // Move the message up
      setTimeout(function () {
        message.remove();
      }, 2000);
    }, 2000); // Adjust the delay before moving up here
  }, 10);
}
