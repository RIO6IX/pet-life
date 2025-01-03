var user_id;

function enableEdit() {
    let input_fields = document.querySelectorAll(".editable")
    input_fields.forEach(field => {
        field.disabled = false
    })

    document.getElementById("submit-btn").hidden = false
}

document.getElementById("search-form").addEventListener("submit", function (e) {
    e.preventDefault()

    const form_data = new FormData(this)

    fetch("users_admin.php", {
        method: "POST",
        body: form_data
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == "success") {
            console.log(data)

            user_id = data.userid

            document.getElementById("user_account_type").value = data.account_type
            document.getElementById("fname").value = data.fname
            document.getElementById("lname").value = data.lname
            document.getElementById("phone_num").value = data.phone_num
            document.getElementById("email").value = data.email
            document.getElementById("street").value = data.street
            document.getElementById("city").value = data.city
            document.getElementById("postal_code").value = data.postal_code

            if (data.image != "none") {
                document.getElementById("user-image-form").action = "users_admin.php?action=update-img&id=" + data.userid
                document.getElementById("user-profile-pic").src = "profile_pictures/users/" + data.image
                document.getElementById("user-image-form").hidden = false
            }

            document.getElementById("user-info-form").action = "users_admin.php?action=edit&type=" + data.account_type + "&id=" + data.userid
            document.getElementById("delete-link").href = "users_admin.php?action=delete&type=" + data.account_type + "&id=" + data.userid

            document.getElementById("edit-btn").disabled = false
            document.getElementById("delete-btn").disabled = false

        } else {
            alert("Account not Found")
        }
    })
    .catch(error => console.error(error))
})
