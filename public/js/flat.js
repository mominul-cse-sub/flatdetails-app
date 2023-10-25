function openMenu(THIS) {
    if (THIS.classList.contains("opened")) {
        THIS.classList.remove("opened");
    } else {
        THIS.classList.add("opened");
    }
}

function closeAlertModal() {
    setTimeout(() => {
        document.getElementById("alertContainerID").innerHTML = "";
    }, 4000);
}

function handleBasicForm(submitButton) {
    try {
        var element = document.getElementById(submitButton);
        element.classList.add("loading");
        element.setAttribute("disabled", true);
        return true;
    } catch (Error) {
        console.log(Error.message);
        // Create a new div element
        const newDiv = document.createElement("div");

        // Set classes for the div (you can add multiple classes by separating them with spaces)
        newDiv.className = "alert alert-dismissible alert-danger";

        // Set inner HTML content for the div
        newDiv.innerHTML = Error.message;

        // Create a button element
        const closeButton = document.createElement("button");
        closeButton.type = "button";
        closeButton.className = "btn-close";
        closeButton.setAttribute("data-bs-dismiss", "alert");
        closeButton.setAttribute("aria-label", "Close");

        // Append the button to the new div
        newDiv.appendChild(closeButton);

        // Append the new div to the parent div
        const parentDiv = document.getElementById("alertContainerID");
        parentDiv.innerHTML = "";
        parentDiv.appendChild(newDiv);
        return false;
    }
}
