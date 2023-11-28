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

function handleDivision(Division) {
    var divisionId = Division.value;
    var selectDistrict = document.getElementById("district");
    var selectThana = document.getElementById("thana");
    selectDistrict.setAttribute("disabled", true);
    selectThana.setAttribute("disabled", true);

    fetch(`${API_ENDPOINT}/districts/${divisionId}`)
        .then((response) => response.json())
        .then((result) => {
            selectDistrict.innerHTML = "<option>Select District</option>";
            selectThana.innerHTML = "<option>Select Thana</option>";
            selectDistrict.removeAttribute("disabled");
            Object.keys(result).map((item, index) => {
                const district = result[item];
                var option = document.createElement("option");
                option.text = district.name;
                option.value = district.id;
                selectDistrict.appendChild(option);
            });
        })
        .catch((error) => console.log("error", error));
}

function handleDistrict(District) {
    var districtId = District.value;
    var selectThana = document.getElementById("thana");
    selectThana.setAttribute("disabled", true);

    fetch(`${API_ENDPOINT}/thanas/${districtId}`)
        .then((response) => response.json())
        .then((result) => {
            selectThana.innerHTML = "<option>Select Thana</option>";
            selectThana.removeAttribute("disabled");
            Object.keys(result).map((item, index) => {
                const thana = result[item];
                var option = document.createElement("option");
                option.text = thana.name;
                option.value = thana.id;
                selectThana.appendChild(option);
            });
        })
        .catch((error) => console.log("error", error));
}

function openNotification(notification) {
    var page = "";
    if (
        notification.event_type == 1 ||
        notification.event_type == 2 ||
        notification.event_type == 3
    ) {
        page = "flat";
    }
    if (notification.is_read == 0) {
        fetch(`${API_ENDPOINT}/notification/${notification.id}`)
            .then((response) => response.json())
            .then(() => {
                if (notification.event_type == 4) {
                    window.location = "/user/profile";
                } else {
                    window.location = `/${page}/${notification.path_id}`;
                }
            })
            .catch((error) => console.log("error", error));
    } else {
        if (notification.event_type == 4) {
            window.location = "/user/profile";
        } else {
            window.location = `/${page}/${notification.path_id}`;
        }
    }
    return;
}

function selectAvatar(THIS) {
    const file = THIS.files[0];
    if (!file) {
        return;
    }
    if (
        file.type == "image/png" ||
        file.type == "image/jpg" ||
        file.type == "image/jpeg"
    ) {
        var avatarPreview = document.getElementById("avatarPreview");
        var avatarForm = document.getElementById("avatarForm");
        avatarPreview.src = URL.createObjectURL(file);
        // avatarForm.submit();

        // Smart way
        var formData = new FormData(avatarForm);

        var requestOptions = {
            method: "POST",
            // headers: myHeaders,
            body: formData,
            // redirect: "follow",
        };

        fetch(`${API_ENDPOINT}/uploadAvatar`, requestOptions)
            .then((response) => response.json())
            .then((result) => {
                console.log(result);
            })
            .catch((error) => console.log("error", error));
    } else {
        alert("Please select JPG, JPEG or PNG type file");
    }
}
