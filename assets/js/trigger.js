(function () {
    "use strict";
console.log("trigger.js carregou");
    const trigger = document.getElementById("philosophersInfoTrigger");
    const card = document.getElementById("philosophersInfoCard");
    if (!trigger || !card) return;

    function closeCard() {
        card.classList.remove("philosophers__info-card--open");
        card.setAttribute("aria-hidden", "true");
        trigger.setAttribute("aria-expanded", "false");
    }

    function toggleCard() {
        const isOpen = card.classList.toggle("philosophers__info-card--open");
        card.setAttribute("aria-hidden", String(!isOpen));
        trigger.setAttribute("aria-expanded", String(isOpen));
    }

    trigger.addEventListener("click", (e) => {
        e.stopPropagation();
        toggleCard();
    });

    document.addEventListener("click", (e) => {
        if (!card.contains(e.target) && e.target !== trigger) {
            closeCard();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeCard();
    });
})();