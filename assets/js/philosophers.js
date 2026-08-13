(function () {
    "use strict";
console.log("philosophers.js carregou");
    const accordion = document.querySelector("[data-philosophers-accordion]");
    if (!accordion) return;

    const items = Array.from(accordion.querySelectorAll("[data-philosophers-item]"));

    function setListDelays(item) {
        const listItems = item.querySelectorAll(".philosophers-list__item");
        listItems.forEach((el, index) => {
            el.style.setProperty("--philosophers-item-delay", `${80 + index * 60}ms`);
        });
    }

    function openItem(item, trigger) {
        loadImages(item);
        item.classList.add("is-open");
        trigger.setAttribute("aria-expanded", "true");
        setListDelays(item);
    }

    function closeItem(item, trigger) {
        item.classList.remove("is-open");
        trigger.setAttribute("aria-expanded", "false");
    }

    function loadImages(item) {
        item.querySelectorAll("img[data-src]").forEach((img) => {
            if (!img.src) {
                img.src = img.dataset.src;
                img.removeAttribute("data-src");
            }
        });
    }

    items.forEach((item) => {
        const trigger = item.querySelector("[data-philosophers-trigger]");
        if (!trigger) return;

        trigger.addEventListener("click", () => {
            const isOpen = item.classList.contains("is-open");

            items.forEach((other) => {
                if (other !== item) {
                    const otherTrigger = other.querySelector("[data-philosophers-trigger]");
                    closeItem(other, otherTrigger);
                }
            });

            if (isOpen) {
                closeItem(item, trigger);
            } else {
                openItem(item, trigger);
            }
        });
    });

    const initiallyOpen = accordion.querySelector(".philosophers-category.is-open");
    if (initiallyOpen) setListDelays(initiallyOpen);
})();