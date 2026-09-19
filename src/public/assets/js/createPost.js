const form = document.querySelector(".create-post__form");
const submitBtn =
    document.getElementById("createPostBtn") ||
    document.getElementById("editPostBtn");
const imageInput = document.getElementById("image");
const preview = document.getElementById("preview");
const fields = {
    title: document.getElementById("title"),
    category_id: document.getElementById("category_id"),
    body: document.getElementById("body"),
};

function clearErrors() {
    document.querySelectorAll(".post-field.has-error").forEach((el) => {
        el.classList.remove("has-error");
    });
}

function showError(field) {
    field.closest(".post-field").classList.add("has-error");
}

function validate() {
    clearErrors();
    let valid = true;
    if (!fields.title.value.trim()) {
        showError(fields.title);
        valid = false;
    }
    if (!fields.category_id.value) {
        showError(fields.category_id);
        valid = false;
    }
    if (!fields.body.value.trim()) {
        showError(fields.body);
        valid = false;
    }
    return valid;
}

if (imageInput && preview) {
    imageInput.addEventListener("change", () => {
        const file = imageInput.files[0];
        if (!file) {
            return;
        }
        const imageUrl = URL.createObjectURL(file);
        preview.src = imageUrl;
    });
}

if (form) {
    form.addEventListener("submit", (event) => {
        if (!validate()) {
            event.preventDefault();
            return;
        }
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = "Salvando...";
        }
    });
}