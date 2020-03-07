var time = document.getElementById("time");
var currentDate;
var currentTime;

setInterval(() => {
  time.innerHTML = "";
  currentDate = new Date();

  if (currentDate.getMinutes() < 10) {
    currentTime = currentDate.getHours() + ":" + "0" + currentDate.getMinutes();
  } else {
    currentTime = currentDate.getHours() + ":" + currentDate.getMinutes();
  }
  time.innerHTML = currentTime;
}, 1000);
