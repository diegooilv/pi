export function previewImage(inputSelector, imgSelector) {
    const input = document.querySelector(inputSelector);
    const img = document.querySelector(imgSelector);

    if (!input || !img) return;

    input.addEventListener('change', (event) => {
        const file = event.target.files[0];

        if (!file) {
            img.style.display = 'none';
            img.src = '';
            return;
        }

        img.src = URL.createObjectURL(file);
        img.style.display = 'block';
    });
}