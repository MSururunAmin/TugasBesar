let body = document.body;
let info = document.getElementById("info");
let MODE = document.getElementById("mode");
let HOME = document.getElementById("home");
let MODERED = document.getElementById("Modered");

const darkLimit = 5;
let darkCounter = 0;
let darkRemainingleft;

function darkMode() {
  if (darkRemainingleft == 1) {
    info.textContent = "jatah fitur darkmode anda sudah habis :)";
    mode.style.display = "none";
    home.textContent = "RESTART";
    return;
  }
  darkCounter += 1;
  darkRemainingleft = darkLimit - darkCounter;

  //render ke info element
  info.textContent = `Darkmode dipakai ${darkCounter}x, tersisa ${darkRemainingleft}`;
  body.classList.toggle("dark");
}

function modeDark() {
  if (darkRemainingleft == 1) {
    info.textContent = "jatah fitur darkmode anda sudah habis :)";
    home.textContent = "RESTART";
    MODERED.style.display = "none";
    return;
  }
  darkCounter += 1;
  darkRemainingleft = darkLimit - darkCounter;

  info.textContent = `Darkmode dipakai ${darkCounter}x, tersisa ${darkRemainingleft}`;
  body.classList.toggle("mode");
}

function reRender() {
  location.reload();
}
