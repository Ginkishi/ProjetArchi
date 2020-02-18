var toggleBtn = document.getElementById("toggleBtn");
var sidebar = document.querySelector(".sidebar");
var sidebarItems = document.querySelectorAll(".sidebar-item.drop");
toggleBtn.addEventListener("click", () => {
  sidebar.classList.toggle("show");
});
sidebarItems.forEach(item => {
  item.addEventListener("click", () => {
    console.log(item);

    item.classList.toggle("show");
  });
});
