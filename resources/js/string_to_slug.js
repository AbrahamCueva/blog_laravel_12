document.addEventListener("DOMContentLoaded", function() {
    const nameInput = document.querySelector("input[name='title']");
    const slugInput = document.querySelector("input[name='slug']");

    nameInput.addEventListener("input", function() {
        let slug = nameInput.value
            .normalize("NFD").replace(/[\u0300-\u036f]/g, '')
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')  
            .replace(/\s+/g, '-')         
            .replace(/-+/g, '-');         

        slugInput.value = slug;
    });
});