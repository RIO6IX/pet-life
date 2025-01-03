// Prevent default form submission
document.getElementById("contact-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    addQuery();
});

// Function to add a new query
function addQuery() {
    const email = document.getElementById('email').value;
    const name = document.getElementById('name').value;
    const message = document.getElementById('message').value;

    const queryList = document.getElementById('query-items');
    const newId = queryList.children.length + 1;
    const li = document.createElement('li');
    li.id = `query-${newId}`;
    li.innerHTML = `
        <span><strong>Name:</strong> <span id="name-${newId}">${name}</span></span> <br>
        <span><strong>Email:</strong> <span id="email-${newId}">${email}</span></span> <br>
        <span><strong>Message:</strong> <span id="message-${newId}">${shortenMessage(message)}</span></span> <br>
        <button class="edit-button" onclick="editQuery(${newId})">Edit</button>
        <button class="save-button" style="display:none;" onclick="saveQuery(${newId})">Save</button>
        <button class="cancel-button" style="display:none;" onclick="cancelEdit(${newId})">Cancel</button>
        <button class="delete-button" onclick="deleteQuery(${newId})">Delete</button>
    `;
    queryList.appendChild(li);

    // Reset form
    document.getElementById('contact-form').reset();
}

// Function to shorten the message display
function shortenMessage(message, limit = 100) {
    if (message.length > limit) {
        return message.substring(0, limit) + '...';
    }
    return message;
}

// Function to make fields editable
function editQuery(id) {
    const nameElement = document.getElementById(`name-${id}`);
    const emailElement = document.getElementById(`email-${id}`);
    const messageElement = document.getElementById(`message-${id}`);

    nameElement.innerHTML = `<input type="text" id="edit-name-${id}" value="${nameElement.textContent}">`;
    emailElement.innerHTML = `<input type="email" id="edit-email-${id}" value="${emailElement.textContent}">`;
    messageElement.innerHTML = `<textarea id="edit-message-${id}">${messageElement.textContent}</textarea>`;

    document.querySelector(`#query-${id} .edit-button`).style.display = 'none';
    document.querySelector(`#query-${id} .save-button`).style.display = 'inline-block';
    document.querySelector(`#query-${id} .cancel-button`).style.display = 'inline-block';
}

// Function to save the edited query
function saveQuery(id) {
    const newName = document.getElementById(`edit-name-${id}`).value;
    const newEmail = document.getElementById(`edit-email-${id}`).value;
    const newMessage = document.getElementById(`edit-message-${id}`).value;

    document.getElementById(`name-${id}`).textContent = newName;
    document.getElementById(`email-${id}`).textContent = newEmail;
    document.getElementById(`message-${id}`).textContent = shortenMessage(newMessage);

    // Add AJAX call to save the updated data to the server
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "contactus.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
        }
    };
    xhr.send(`action=edit&id=${id}&name=${newName}&email=${newEmail}&message=${newMessage}`);

    // Update the UI
    document.querySelector(`#query-${id} .edit-button`).style.display = 'inline-block';
    document.querySelector(`#query-${id} .save-button`).style.display = 'none';
    document.querySelector(`#query-${id} .cancel-button`).style.display = 'none';
}

// Function to cancel editing the query
function cancelEdit(id) {
    const nameElement = document.getElementById(`name-${id}`);
    const emailElement = document.getElementById(`email-${id}`);
    const messageElement = document.getElementById(`message-${id}`);

    const originalName = nameElement.textContent;
    const originalEmail = emailElement.textContent;
    const originalMessage = messageElement.textContent;

    nameElement.innerHTML = originalName;
    emailElement.innerHTML = originalEmail;
    messageElement.innerHTML = shortenMessage(originalMessage);

    document.querySelector(`#query-${id} .edit-button`).style.display = 'inline-block';
    document.querySelector(`#query-${id} .save-button`).style.display = 'none';
    document.querySelector(`#query-${id} .cancel-button`).style.display = 'none';
}

// Function to delete a query
function deleteQuery(id) {
    const li = document.getElementById(`query-${id}`);
    li.parentNode.removeChild(li);

    // Add AJAX call to delete the inquiry from the server
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "contact_us.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status === 200) {
            console.log(this.responseText);
        }
    };
    xhr.send(`action=delete&id=${id}`);
}
