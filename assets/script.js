document.addEventListener("DOMContentLoaded", () => {
  const loginForm = document.querySelector(".login");
  const signupForm = document.querySelector(".signup");

  document.getElementById("linkSignup").onclick = (e) => {
    e.preventDefault();
    loginForm.classList.remove("active");
    signupForm.classList.add("active");
  };

  document.getElementById("linkLogin").onclick = (e) => {
    e.preventDefault();
    signupForm.classList.remove("active");
    loginForm.classList.add("active");
  };

  const isDashboard = window.location.pathname.includes("dashboard.php");
  if (!isDashboard) initAuth();
  else initDashboard();
});

function initAuth() {
  document.getElementById("btnLogin").onclick = async () => {
    const email = loginEmail.value, password = loginPass.value;
    const r = await fetch("api/login.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email, password }),
    });
    const d = await r.json();
    if (r.ok) location.href = "dashboard.php";
    else alert(d.error);
  };

  document.getElementById("btnSignup").onclick = async () => {
    const nombre = signupNombre.value, email = signupEmail.value, password = signupPass.value;
    const r = await fetch("api/register.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ nombre, email, password }),
    });
    const d = await r.json();
    if (r.ok) {
      alert("Registro exitoso, inicia sesión");
      signupForm.classList.remove("active");
      loginForm.classList.add("active");
    } else alert(d.error);
  };
}

function initDashboard() {
  const purchaseCount = document.getElementById("purchaseCount");
  const reward = document.getElementById("reward");

  fetch("api/get_user.php")
    .then((r) => r.json())
    .then((d) => {
      purchaseCount.textContent = d.user.purchases;
      checkReward(d.user.purchases);
    });

  document.getElementById("addBtn").onclick = async () => {
    const r = await fetch("api/add_purchase.php");
    const d = await r.json();
    purchaseCount.textContent = d.purchases;
    checkReward(d.purchases);
  };

  document.getElementById("saveBtn").onclick = async () => {
    const nombre = nombreInput.value;
    const r = await fetch("api/update_profile.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ nombre }),
    });
    const d = await r.json();
    alert(d.success ? "Actualizado" : d.error);
  };

  document.getElementById("logoutBtn").onclick = async () => {
    await fetch("api/logout.php");
    location.href = "index.php";
  };

  function checkReward(c) {
    reward.classList.toggle("hidden", c < 9);
  }
}
