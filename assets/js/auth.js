
function checkAuth() {
  const token = localStorage.getItem("ticketapp_session");
  if (!token) {
    window.location.href = "/login";
    return false;
  }
  return true;
}


function logout() {
  localStorage.removeItem("ticketapp_session");
  localStorage.removeItem("tickets");
  showToast("Logged out successfully", "success");
  setTimeout(() => {
    window.location.href = "/";
  }, 1000);
}


function showToast(message, type = "success") {
  let toast = document.getElementById("toast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "toast";
    toast.className = "toast";
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.className = `toast ${type} show`;
  setTimeout(() => {
    toast.className = `toast ${type} hidden`;
  }, 3000);
}


document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();

      document
        .querySelectorAll(".error")
        .forEach((el) => (el.textContent = ""));

      let valid = true;
      if (!email) {
        document.getElementById("emailError").textContent = "Email is required";
        valid = false;
      }
      if (!password) {
        document.getElementById("passwordError").textContent =
          "Password is required";
        valid = false;
      }
      if (!valid) {
        showToast("Please fix the errors", "error");
        return;
      }

      const mockUser = JSON.parse(
        localStorage.getItem("mock_user") ||
        '{"email":"admin@test.com","password":"password"}'
      );

      if (email === mockUser.email && password === mockUser.password) {
        const token = "session_" + Date.now();
        localStorage.setItem("ticketapp_session", token);
        showToast("Login successful!", "success");
        setTimeout(() => {
          window.location.href = "/dashboard";
        }, 1000);
      } else {
        showToast("Invalid email or password. Try again", "error");
      }
    });
  }

  const signupForm = document.getElementById("signupForm");
  if (signupForm) {
    signupForm.addEventListener("submit", (e) => {
      e.preventDefault();

      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();
      const confirm = document.getElementById("confirmPassword").value.trim();

      document
        .querySelectorAll(".error")
        .forEach((el) => (el.textContent = ""));

      let valid = true;
      if (!email) {
        document.getElementById("emailError").textContent = "Email required";
        valid = false;
      }
      if (!password) {
        document.getElementById("passwordError").textContent =
          "Password required";
        valid = false;
      } else if (password.length < 6) {
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters";
        valid = false;
      }
      if (password !== confirm) {
        document.getElementById("confirmError").textContent =
          "Passwords do not match";
        valid = false;
      }

      if (!valid) {
        showToast("Please fix errors", "error");
        return;
      }

     
      if (localStorage.getItem("mock_user")) {
        const user = JSON.parse(localStorage.getItem("mock_user"));
        if (user.email === email) {
          showToast("User exists. Login instead.", "error");
          return;
        }
      }

      localStorage.setItem("mock_user", JSON.stringify({ email, password }));
      showToast("Account created!", "success");
      setTimeout(
        () => (window.location.href = "/login"),
        1500
      );
    });
  }

});
