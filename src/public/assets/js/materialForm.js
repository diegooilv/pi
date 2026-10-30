const form = document.getElementById("materialForm");
const submit = document.getElementById("materialSubmitBtn");
const preview = document.getElementById("preview");
const image = document.getElementById("image");
const required = ["title", "description", "type", "url", "category_id"];

if (image && preview) {
    image.addEventListener("change", () => {
        if (image.files[0]) preview.src = URL.createObjectURL(image.files[0]);
    });
}

if (form) {
    form.addEventListener("submit", (event) => {
        document.querySelectorAll(".post-field.has-error").forEach((field) => field.classList.remove("has-error"));
        let valid = true;

        required.forEach((id) => {
            const field = document.getElementById(id);
            if (!field || !field.value.trim()) {
                field?.closest(".post-field")?.classList.add("has-error");
                valid = false;
            }
        });

        const url = document.getElementById("url");
        if (url && !url.validity.valid) {
            url.closest(".post-field").classList.add("has-error");
            valid = false;
        }

        if (!valid) return event.preventDefault();
        submit.disabled = true;
        submit.textContent = "Salvando...";
    });
}