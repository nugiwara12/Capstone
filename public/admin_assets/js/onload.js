
//new
function handleFileUpload(input) {
    const preview2 = document.getElementById('preview2');
    const customizeImagePreview = document.getElementById('customizeImagePreview');
    const customizeBox = document.getElementById('customizeBox');
    const canvas = document.getElementById('canvas');
    const canvasContainer = document.getElementById('canvasContainer');
    const widthInput = document.getElementById('widthInput');
    const heightInput = document.getElementById('heightInput');
    const topInput = document.getElementById('topInput');
    const leftInput = document.getElementById('leftInput');

    if (input.files.length > 0) {
        const file = URL.createObjectURL(input.files[0]);
        preview2.src = file;
        preview2.style.display = 'block';
        customizeBox.style.display = 'none';
        customizeImagePreview.style.display='block';
        canvasContainer.style.display = 'flex';
        canvas.style.display = 'block';
        canvas.style.width = widthInput.value + '%';
        canvas.style.height = heightInput.value + '%';
        canvas.style.top = topInput.value + '%';
        canvas.style.left = leftInput.value + '%';

        // Create styled delete button
        const deleteButton = document.createElement('button');
        deleteButton.innerHTML = '&times;';
        deleteButton.style.position = 'absolute';
        deleteButton.style.top = '5px';
        deleteButton.style.right = '5px';
        deleteButton.style.background = 'red';
        deleteButton.style.color = 'white';
        deleteButton.style.border = 'none';
        deleteButton.style.borderRadius = '50%';
        deleteButton.style.width = '30px';
        deleteButton.style.height = '30px';
        deleteButton.style.cursor = 'pointer';

        // Add delete functionality
        deleteButton.onclick = function() {
            preview2.src = '';
            preview2.style.display = 'none';
            canvasContainer.style.display = 'none';
            canvas.style.display = 'none';
            input.value = ''; // Clear file input
            customizeBox.style.display='flex';
            customizeImagePreview.style.display ='none';
            deleteButton.remove(); // Remove delete button
        };

        // Append button to canvasContainer
        canvasContainer.appendChild(deleteButton);

        console.log("File uploaded and canvas adjusted.");
    } else {
        preview2.style.display = 'none';
        canvasContainer.style.display = 'none';
        canvas.style.display = 'none';
        console.log("No file uploaded.");
    }
}

// function handleFileUpload(input) {
//     const preview2 = document.getElementById('preview2'); // Change to match your HTML
//     const customizeBox = document.getElementById('customizeBox');
//     const canvas = document.getElementById('canvas'); // Ensure this exists
//     const canvasContainer = document.getElementById('canvasContainer'); // Ensure this exists
//     const widthInput = document.getElementById('widthInput'); // Ensure this exists
//     const heightInput = document.getElementById('heightInput'); // Ensure this exists
//     const topInput = document.getElementById('topInput'); // Ensure this exists
//     const leftInput = document.getElementById('leftInput'); // Ensure this exists

//     if (input.files.length > 0) {
//         const file = URL.createObjectURL(input.files[0]); // Create a URL for the uploaded file
//         preview2.src = file; // Set the preview source
//         preview2.style.display = 'block'; // Show the image preview
//         customizeBox.style.display = 'none';
//         canvasContainer.style.display = 'block'; // Show canvas container
//         canvas.style.display = 'block'; // Show canvas

//         // Update canvas size and position based on input values
//         canvas.style.width = widthInput.value + '%';
//         canvas.style.height = heightInput.value + '%';
//         canvas.style.top = topInput.value + '%';
//         canvas.style.left = leftInput.value + '%';

//         console.log("File uploaded and canvas adjusted.");
//     } else {
//         preview.style.display = 'none'; // Hide image preview if no file uploaded
//         canvasContainer.style.display = 'none'; // Hide canvas container
//         canvas.style.display = 'none'; // Hide canvas

//         console.log("No file uploaded.");
//     }
// }

function togglePrintingArea(checkbox) {
    const fileInput = document.getElementById('fileInput');
    const customizeBox = document.getElementById('customizeBox');
    const browseLink = document.getElementById('browseLink');
    const widthInput = document.getElementById('widthInput');
    const heightInput = document.getElementById('heightInput');
    const topInput = document.getElementById('topInput');
    const leftInput = document.getElementById('leftInput');

    if (checkbox.checked) {
        // Enable inputs
        fileInput.disabled = false; // Enable file input
        widthInput.disabled = false; // Enable width input
        heightInput.disabled = false; // Enable height input
        topInput.disabled = false; // Enable top input
        leftInput.disabled = false; // Enable left input
        customizeBox.style.border ='1px dashed #2275fc';
        customizeBox.style.backgroundColor ='#f8f8f8';
    } else {
        // Disable inputs
        fileInput.disabled = true; // Disable file input
        widthInput.disabled = true; // Disable width input
        heightInput.disabled = true; // Disable height input
        topInput.disabled = true; // Disable top input
        leftInput.disabled = true; // Disable left input
        customizeBox.style.border ='1px dashed #c0c0c4';
        customizeBox.style.backgroundColor='#e9ecef';
    }
}

// Optional: Update canvas size and position dynamically
document.getElementById('widthInput').addEventListener('input', function() {
    document.getElementById('canvas').style.width = this.value + '%';
});
document.getElementById('heightInput').addEventListener('input', function() {
    document.getElementById('canvas').style.height = this.value + '%';
});
document.getElementById('topInput').addEventListener('input', function() {
    document.getElementById('canvas').style.top = this.value + '%';
});
document.getElementById('leftInput').addEventListener('input', function() {
    document.getElementById('canvas').style.left = this.value + '%';
});


//For the upload of customize picture
document.addEventListener("DOMContentLoaded", function() {
    const browseLink = document.getElementById('browseLink');
    const fileInput = document.getElementById('fileInput');

    browseLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default link behavior
        fileInput.click(); // Trigger the file input click
    });
});


//From the HTML code

document.getElementById('upload-link-1').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('file-upload-1').click();
});

document.getElementById('file-upload-1').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const currentImage = document.getElementById('currentImage');
            const preview = document.getElementById('image-preview');
            const mainImage = document.getElementById('mainImagePreview');
            const deleteButton = document.getElementById('delete-button');
            const largeBox = document.getElementById('largeBox');

            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the image
            mainImage.style.display ='block';
            deleteButton.style.display = 'block'; // Show the delete button
            largeBox.style.display='none';
            currentImage.style.display='none';
            preview.style.border = '2px solid #ddd';

        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('delete-button').addEventListener('click', function(e) {
    e.preventDefault(); // Prevent the default action
    const preview = document.getElementById('image-preview');
    const deleteButton = document.getElementById('delete-button');
    const mainImage = document.getElementById('mainImagePreview');
    const largeBox = document.getElementById('largeBox');

    preview.src = '';
    preview.style.display = 'none'; // Hide the image
    deleteButton.style.display = 'none'; // Hide the delete button
    mainImage.style.display ='none';
    largeBox.style.display='flex';
    document.getElementById('file-upload-1').value = ''; // Clear the file input
});


//
document.getElementById('upload-link-2').addEventListener('click', function(e) {
e.preventDefault();
document.getElementById('file-upload-2').click();
});



document.getElementById('file-upload-2').addEventListener('change', function(event) {
const files = event.target.files;
const galleryContainer = document.getElementById('image-gallery');
const imageGallery = document.getElementById('imageGallery');

for (let i = 0; i < files.length; i++) {
const file = files[i];
const reader = new FileReader();

reader.onload = function(e) {
    // Create a new small box for each image
    const imageBox = document.createElement('div');
    imageBox.className = 'upload-box small-box';
    imageBox.style.border = '2px solid #ddd';
    imageBox.style.borderRadius = '10px';
    imageBox.style.margin = '5px';
    imageBox.style.width = '150px';
    imageBox.style.height = '150px';
    imageBox.style.display = 'flex';
    imageBox.style.alignItems = 'center';
    imageBox.style.justifyContent = 'center';
    imageBox.style.backgroundColor = '#f8f8f8';
    imageBox.style.position = 'relative';
    imageBox.style.overflow = 'hidden';

    // Create the image element
    const img = document.createElement('img');
    img.src = e.target.result;
    img.style.width = '100%';
    img.style.height = '100%';
    img.style.objectFit = 'cover'; // Cover the box
    img.style.borderRadius = '10px';

    // Create delete button
    const deleteButton = document.createElement('button');
    deleteButton.innerHTML = '&times;';
    deleteButton.style.position = 'absolute';
    deleteButton.style.top = '5px';
    deleteButton.style.right = '5px';
    deleteButton.style.background = 'red';
    deleteButton.style.color = 'white';
    deleteButton.style.border = 'none';
    deleteButton.style.borderRadius = '50%';
    deleteButton.style.width = '30px';
    deleteButton.style.height = '30px';
    deleteButton.style.cursor = 'pointer';

    // Append the image and delete button to the new box
    imageBox.appendChild(img);
    imageBox.appendChild(deleteButton);
    // Append the new box to the gallery container
    galleryContainer.appendChild(imageBox);

    // Show the gallery once an image is added
    imageGallery.style.display = 'flex';

    // Delete button functionality
    deleteButton.addEventListener('click', function() {
        galleryContainer.removeChild(imageBox); // Remove the image box

        // Check if the gallery is empty and update display style
        // if (galleryContainer.children.length === 0) {
        //     imageGallery.style.display = 'flex'; // Hide if no images left
        // }
    });
}

reader.readAsDataURL(file);
}
});


