window.previewImage = function(event, querySelector) {
    let input = event.target;
    let imgPreview = document.querySelector(querySelector);
    if (!input.files.length) return
    let file = input.files[0];
    let objectURL = URL.createObjectURL(file);
    imgPreview.src = objectURL;
}