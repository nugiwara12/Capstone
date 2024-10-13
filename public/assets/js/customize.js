let canvas;
let textObjects = [];
let shapeObjects = [];
let activeTextIndex = -1;

const element = document.getElementById('canvasContainer');
const parent = element.parentElement;
parent.style.backgroundImage = "url(notebook.jpg)";

// Set element dimensions (can be fetched from DB)
const newLeft = 21, newTop = 6;
element.style.left = `${newLeft}%`;
element.style.top = `${newTop}%`;
const canWidth = 60 * parent.clientWidth / 100;
const canHeight = 86 * parent.clientHeight / 100;

$(document).ready(function() {
    canvas = new fabric.Canvas("canvas");
    setCanvasSize(canWidth, canHeight); // Set canvas size

    // Add Text to Canvas
    $('#addTextBtn').click(() => addTextToCanvas());

    // Delete Active Object
    $('#deleteBtn').click(() => deleteActiveObject());

    // Add Image to Canvas
    $('#addImgBtn').click(() => addImageToCanvas());

    // Shape selection from dropdown
    $('.dropdown-item').click(function(event) {
        event.preventDefault(); // Prevent default anchor behavior
        const selectedShape = $(this).data('shape');
        const color = $('#shapeColorPicker').val(); // Get the current color from the shape color picker
        addShapeToCanvas(selectedShape, color); // Pass the color to the function
    });

    // Bind download function to button
    $('#downloadBtn').click(downloadCanvas);

    // Show color picker for text when the text color changes
    $('#textColorPicker').on('input', function() {
        const selectedColor = $(this).val();
        const activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'textbox') {
            activeObject.set('fill', selectedColor); // Change the fill color of the active text object
            canvas.renderAll(); // Refresh the canvas
        }
    });

    // Show color picker when the eyedropper button is clicked
    $('#eyedropperBtn').on('click', function(event) {
        $('#textColorPicker').show(); // Show the text color picker

        // Position the color picker
        const buttonOffset = $(this).offset();
        const buttonHeight = $(this).outerHeight();

        $('#textColorPicker').css({
            top: buttonOffset.top + buttonHeight + 5,
            left: buttonOffset.left
        });

        // Focus the text color picker for immediate selection
        $('#textColorPicker').focus().trigger('click');

        event.preventDefault();
    });

    // Canvas background color change
    $('#backgroundColorPicker').on('input', function() {
        canvas.setBackgroundColor($(this).val(), canvas.renderAll.bind(canvas));
    });

    // Show/hide text editor and delete button
    canvas.on('object:selected', handleObjectSelected);
    canvas.on('selection:cleared', clearSelection);

    // Initially hide the color picker input
    $('#textColorPicker').hide();
});

// Set canvas size dynamically
function setCanvasSize(width, height) {
    $("#canvasContainer").css({ width, height });
    $("#canvas").attr({ width, height });
    canvas.setWidth(width);
    canvas.setHeight(height);
}

// Add Text Object to Canvas
function addTextToCanvas() {
    const text = new fabric.Textbox("Add Your Text", {
        left: canvas.width / 2,
        top: canvas.height / 2,
        fontSize: parseInt($('#fontSize').val(), 10), // Get font size from dropdown
        fontFamily: $('#fontFamily').val(), // Get font family from dropdown
        fill: $('#textColorPicker').val(), // Initial text color
        textAlign: "center",
        editable: true,
    });

    textObjects.push(text);
    canvas.add(text).setActiveObject(text);
    activeTextIndex = textObjects.length - 1;
    updateTextEditorValues(text);
}

// Update text editor with current text properties
function updateTextEditorValues(text) {
    $("#textColorPicker").val(text.fill);
    $("#fontSize").val(text.fontSize);
    $("#fontFamily").val(text.fontFamily);
}

// Set up text property listeners
$('#fontSize').on('input', function() {
    const activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.type === 'textbox') {
        activeObject.set('fontSize', parseInt($(this).val(), 10));
        canvas.renderAll();
    }
});

$('#fontFamily').on('change', function() {
    const activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.type === 'textbox') {
        activeObject.set('fontFamily', $(this).val());
        canvas.renderAll();
    }
});

// Add shape to canvas
function addShapeToCanvas(selectedShape, color) {
    let shape;

    switch (selectedShape) {
        case 'circle':
            shape = new fabric.Circle({
                radius: 30,
                fill: color,
                left: canvas.width / 2,
                top: canvas.height / 2
            });
            break;
        case 'rectangle':
            shape = new fabric.Rect({
                width: 60,
                height: 40,
                fill: color,
                left: canvas.width / 2,
                top: canvas.height / 2
            });
            break;
        case 'triangle':
            shape = new fabric.Triangle({
                width: 60,
                height: 60,
                fill: color,
                left: canvas.width / 2,
                top: canvas.height / 2
            });
            break;
        case 'square':
            shape = new fabric.Rect({
                width: 50,
                height: 50,
                fill: color,
                left: canvas.width / 2,
                top: canvas.height / 2
            });
            break;
        default:
            return; // Exit if no shape is selected
    }

    canvas.add(shape).setActiveObject(shape);
    $('#shapeColorLabel, #shapeColorPicker').show(); // Show color options if applicable
    canvas.renderAll();
}

// Add image to canvas
function addImageToCanvas() {
    const fileInput = $('<input type="file" accept="image/*" style="display:none;">');

    fileInput.on('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = new Image();
                imgElement.src = e.target.result;
                imgElement.onload = () => addImageToCanvasFromSrc(imgElement);
            };
            reader.readAsDataURL(file);
        }
    });

    fileInput.appendTo('body').trigger('click');
}

// Add image to canvas from img element
function addImageToCanvasFromSrc(imgElement) {
    const scale = Math.min(canvas.width / imgElement.width, canvas.height / imgElement.height);
    const imgInstance = new fabric.Image(imgElement, {
        left: (canvas.width - imgElement.width * scale) / 2,
        top: (canvas.height - imgElement.height * scale) / 2,
        scaleX: scale,
        scaleY: scale,
    });

    canvas.add(imgInstance).setActiveObject(imgInstance);
    canvas.renderAll();
}

// Delete active object (text, shape, or image)
function deleteActiveObject() {
    const activeObject = canvas.getActiveObject();
    if (activeObject) {
        canvas.remove(activeObject);
        if (activeObject.type === 'textbox') {
            textObjects.splice(activeTextIndex, 1);
            activeTextIndex = -1;
        }
        $('#textEditor, #deleteBtn').hide();
        canvas.renderAll();
    }
}

// Handle selection events for canvas objects
// Handle selection events for canvas objects
function handleObjectSelected(e) {
    const activeObject = e.target;
    if (activeObject.type === 'textbox') {
        updateTextEditorValues(activeObject);
        $('#textEditor').show(); // Show the text editor
        $('#shapeColor').hide(); // Hide shape color button
        $('#shapeColorPicker').hide(); // Hide shape color picker
    } else if (['circle', 'rect', 'triangle', 'square'].includes(activeObject.type)) {
        $('#shapeColor').show(); // Show the shape color button
        $('#shapeColorPicker').show(); // Show the shape color picker
        $('#textEditor').hide(); // Hide the text editor
    }
    $('#deleteBtn').show();
}

// Change the color of the shape when the shape color picker changes
$('#shapeColorPicker').on('input', function() {
    const selectedColor = $(this).val();
    const activeObject = canvas.getActiveObject();
    if (activeObject && ['circle', 'rect', 'triangle', 'square'].includes(activeObject.type)) {
        activeObject.set('fill', selectedColor);
        canvas.renderAll();
    }
});


// Clear selection and hide editors
function clearSelection() {
    $('#textEditor, #deleteBtn').hide(); // Hide text editor and delete button
    $('#shapeColor, #shapeColorPicker').hide(); // Hide shape color button and picker
}

// Event listener for transparent background toggle
    $('#transparentBgToggle').click(function() {
        canvas.setBackgroundColor('rgba(0,0,0,0)', canvas.renderAll.bind(canvas)); // Set background to transparent
    });

// Download canvas content as PNG
function downloadCanvas() {
    const dataURL = canvas.toDataURL({ format: 'png', quality: 1 });
    const link = document.createElement('a');
    link.href = dataURL;
    link.download = 'my_design.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
