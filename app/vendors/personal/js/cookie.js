//alert(document.cookie);
function getCookieValue(name) {
  let result = document.cookie.match("(^|[^;]+)\\s*" + name + "\\s*=\\s*([^;]+)");
  return result ? result.pop() : "";
}
function setCookie(name, value, options = {}) {
  options = {
    path: "/",
    samesite: "strict",
    // add other defaults here if necessary
    ...options
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

  document.cookie = updatedCookie;
}
function deleteCookie(name) {
  setCookie(name, "", {
    "max-age": -1
  });
}

// deleteCookie("Hello");
if (getCookieValue("Hello") === "") {
  // let date = new Date(Date.now() + 86400e3);
  // date = date.toUTCString();
  setCookie("Hello", "World");
  setCookie("Mode", "dark");
  setCookie("Menu", "show");
  // setCookie("expires", date);
}
