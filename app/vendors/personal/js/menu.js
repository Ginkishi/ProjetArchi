var toggleBtn = document.getElementById("toggleBtn");
var sidebar = document.querySelector(".sidebar");
var sidebarItems = document.querySelectorAll(".sidebar-item.drop");
var darkBtn = document.querySelector("#darkbtn");
var container = document.querySelector(".contain");

darkBtn.addEventListener("change", changeColor);

toggleBtn.addEventListener("click", () => {
  sidebar.classList.toggle("show");
  if (sidebar.classList.contains("show")) {
    setCookie("Menu", "show");
    // console.log("Menu ouvert");
  } else {
    setCookie("Menu", "hide");
    // console.log(getCookieValue("Menu"));
  }
});
sidebarItems.forEach(item => {
  item.addEventListener("click", () => {
    console.log(item);

    item.classList.toggle("show");
  });
});

if (getCookieValue("Menu") == "hide") {
  if (sidebar.classList.contains("show")) {
    sidebar.classList.toggle("show");
  }
}
if (getCookieValue("Mode") == "light") {
  if (container.classList.contains("shadow")) {
    container.classList.toggle("shadow");
    darkBtn.checked = true;
  } else {
    darkBtn.checked = false;
  }
}

function changeColor() {
  container.classList.toggle("shadow");
  if (container.classList.contains("shadow")) {
    setCookie("Mode", "dark");
  } else {
    setCookie("Mode", "light");
  }
}
