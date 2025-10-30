
let tickets = [];
let editIndex = null;

document.addEventListener("DOMContentLoaded", () => {
 
  if (!checkAuth()) return;

 
  loadTickets();

  const form = document.getElementById("ticketForm");
  form.addEventListener("submit", handleSubmit);

  
  document.getElementById("title").addEventListener("input", validateTitle);
  document
    .getElementById("description")
    .addEventListener("input", validateDescription);
});

function loadTickets() {
  tickets = JSON.parse(localStorage.getItem("tickets") || "[]");
  renderTickets();
}

function renderTickets() {
  const container = document.getElementById("ticketsList");

  if (tickets.length === 0) {
    container.innerHTML =
      '<p class="tickets-empty">No tickets yet. Create one above!</p>';
    return;
  }

  container.innerHTML = tickets
    .map(
      (ticket, index) => `
    <div class="ticket-card">
      <div class="ticket-card-header">
        <h3 class="ticket-card-title">${escapeHtml(ticket.title)}</h3>
        <span class="ticket-status-badge status-${ticket.status}">
          ${ticket.status.replace("_", " ")}
        </span>
      </div>
      <p class="ticket-card-description">
        ${escapeHtml(ticket.description) || "No description provided."}
      </p>
      <div class="ticket-card-actions">
        <button onclick="handleEdit(${index})" class="ticket-action-btn">
          Edit
        </button>
        <button onclick="handleDelete(${index})" class="ticket-action-btn delete">
          Delete
        </button>
      </div>
    </div>
  `
    )
    .join("");
}

function handleSubmit(e) {
  e.preventDefault();

  const title = document.getElementById("title").value.trim();
  const description = document.getElementById("description").value.trim();
  const status = document.getElementById("status").value;


  clearErrors();

 
  let isValid = true;

  if (!title) {
    showError("titleError", "Title is required.");
    isValid = false;
  }

  if (description.length > 1000) {
    showError(
      "descriptionError",
      "Description must be less than 1000 characters."
    );
    isValid = false;
  }

  if (!["open", "in_progress", "closed"].includes(status)) {
    showError("statusError", "Invalid status value.");
    isValid = false;
  }

  if (!isValid) {
    showToast("Please fix the form errors.", "error");
    return;
  }

  const ticket = { title, description, status };

  if (editIndex !== null) {
   
    tickets[editIndex] = ticket;
    editIndex = null;
    document.getElementById("submitBtn").textContent = "Create Ticket";
    showToast("Ticket updated successfully!", "success");
  } else {
    
    tickets.push(ticket);
    showToast("Ticket created successfully!", "success");
  }

  
  localStorage.setItem("tickets", JSON.stringify(tickets));


  document.getElementById("ticketForm").reset();

 
  renderTickets();
}

function handleEdit(index) {
  editIndex = index;
  const ticket = tickets[index];

  document.getElementById("title").value = ticket.title;
  document.getElementById("description").value = ticket.description;
  document.getElementById("status").value = ticket.status;
  document.getElementById("submitBtn").textContent = "Update Ticket";

 
  window.scrollTo({ top: 0, behavior: "smooth" });
}

function handleDelete(index) {
  if (confirm("Are you sure you want to delete this ticket?")) {
    tickets.splice(index, 1);
    localStorage.setItem("tickets", JSON.stringify(tickets));
    showToast("Ticket deleted.", "error");
    renderTickets();
  }
}


function validateTitle() {
  const title = document.getElementById("title").value.trim();
  const error = document.getElementById("titleError");

  if (!title) {
    error.textContent = "Title is required.";
  } else {
    error.textContent = "";
  }
}

function validateDescription() {
  const description = document.getElementById("description").value.trim();
  const error = document.getElementById("descriptionError");

  if (description.length > 1000) {
    error.textContent = "Description must be less than 1000 characters.";
  } else {
    error.textContent = "";
  }
}

function showError(elementId, message) {
  const element = document.getElementById(elementId);
  if (element) {
    element.textContent = message;
  }
}

function clearErrors() {
  document
    .querySelectorAll(".form-error")
    .forEach((el) => (el.textContent = ""));
}

function showToast(message, type = "success") {
  const toast = document.getElementById("toastNotification");
  toast.textContent = message;
  toast.className = `toast-notification ${type} show`;

  setTimeout(() => {
    toast.className = "toast-notification";
  }, 3000);
}

function escapeHtml(text) {
  const div = document.createElement("div");
  div.textContent = text;
  return div.innerHTML;
}
