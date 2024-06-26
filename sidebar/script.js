const cloud = document.getElementById("cloud");
const sidebarMenu = document.querySelector(".sidebar-menu");
const spans = document.querySelectorAll("span");
const circle = document.querySelector(".circle");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");

menu.addEventListener("click", () => {
    sidebarMenu.classList.toggle("max-sidebar-menu");
    if (sidebarMenu.classList.contains("max-sidebar-menu")) {
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block";
    } else {
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none";
    }
    if (window.innerWidth <= 320) {
        sidebarMenu.classList.add("mini-sidebar-menu");
        main.classList.add("min-main");
        spans.forEach((span) => {
            span.classList.add("hidden");
        });
    }
});


cloud.addEventListener("click", () => {
    sidebarMenu.classList.toggle("mini-sidebar-menu");
    main.classList.toggle("min-main");
    spans.forEach((span) => {
        span.classList.toggle("hidden");
    });
});