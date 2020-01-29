var toggleBtn = document.getElementById("toggleBtn");
var sidebar = document.querySelector(".sidebar");
var sidebarItems = document.querySelectorAll(".sidebar-item");
toggleBtn.addEventListener("click", () => {
  sidebar.classList.toggle("show");
});
sidebarItems.forEach(item => {
  item.addEventListener("click", () => {
    if (item.querySelector(".submenu") != null) {
      //   item.querySelector(".submenu").classList.toggle("show");
      if (item.querySelector(".submenu").classList.contains("show")) {
        item.querySelector(".submenu").classList.toggle("show");
      } else {
        let current = document.querySelector(".submenu.show");
        if (current != null) {
          current.classList.toggle("show");
          item.querySelector(".submenu").classList.toggle("show");
        } else {
          item.querySelector(".submenu").classList.toggle("show");
        }
      }
    }
  });
});
