
document.addEventListener("DOMContentLoaded", () => {
  if (!checkAuth()) return;

  loadStats();
});

function loadStats() {
  let tickets = [];
  try {
    tickets = JSON.parse(localStorage.getItem("tickets") || "[]");
  } catch (err) {
    console.error("Failed to parse tickets:", err);
    showError("Failed to load tickets. Please retry.");
    return;
  }

  const stats = {
    total: tickets.length,
    open: tickets.filter((t) => t.status === "open").length,
    closed: tickets.filter((t) => t.status === "closed").length,
  };

  document.getElementById("totalTickets").textContent = stats.total;
  document.getElementById("openTickets").textContent = stats.open;
  document.getElementById("closedTickets").textContent = stats.closed;

  const errorBanner = document.getElementById("errorBanner");
  if (errorBanner) errorBanner.style.display = "none";
}

function showError(message) {
  const banner = document.getElementById("errorBanner");
  if (banner) {
    banner.textContent = message;
    banner.style.display = "block";
  }
  showToast(message, "error");
}
