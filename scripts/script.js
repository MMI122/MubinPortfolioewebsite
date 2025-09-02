var scrollbtn = document.querySelector('.scroll');
var header = document.querySelector('header');

window.addEventListener('scroll', () => {
    scrollbtn.classList.toggle('show', window.scrollY > 100);
    header.classList.toggle('scrl', window.scrollY > 50);
});

let fontscroll = document.querySelector(".font");
let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
window.addEventListener("scroll", () => {
    let scrolltop = document.documentElement.scrollTop;
    fontscroll.style.width = `${(scrolltop/height)*100}%`;
});

var sider = document.getElementById('sider');
var BTNSIDER = document.getElementById('BTNSIDER');

BTNSIDER.onclick = function() {
    sider.classList.toggle('show');
    BTNSIDER.classList.toggle('clicked');
}