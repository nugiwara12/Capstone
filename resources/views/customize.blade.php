@extends('layouts.app2')
<link rel="stylesheet" href="{{asset('assets/css/customize.css')}}">

@section('contents')


<div class="row justify-content-center">
    <div id="fcol">
    <div id="container" style="display: flex; align-items: center; justify-content: center; background-color: transparent; position: relative;">
    <img src="{{ asset('images/' . $product->customizing_image) }}" id="preview2" alt="Image Preview" style="display: block; position: absolute; max-width: 100%; max-height: 100%; background-color: transparent;">
    <div id="canvasContainer">
        <canvas id="canvas"></canvas>
    </div>
</div>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary mt-10" data-bs-toggle="modal" data-bs-target="#benchmarkModal">
    Open Benchmark
</button>

<!-- Benchmark Modal -->
<div class="modal fade" id="benchmarkModal" tabindex="-1" aria-labelledby="benchmarkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-md">
                    <label for="customText" class="block text-xl font-semibold mb-4">Benchmark</label>
                    <p class="text-gray-700 mb-4">
                        Text Charge (5 Php per letter); minimum of 10 letters. Additional charges apply for any letters beyond this limit:
                    </p>
                    <div id="textCharge" class="mt-2 p-2 bg-gray-100 border border-gray-300 rounded">No additional charge</div>
                    
                    <label for="imageCharge" class="mt-6 block text-gray-700">
                        Image Charge (Minimum of 1 photo; additional charges of 15 Php apply for any photos beyond this limit):
                    </label>
                    <div id="imageCharge" class="mt-2 p-2 bg-gray-100 border border-gray-300 rounded">No additional charge</div>
                    
                    <div id="totalCharge" class="mt-6 font-bold text-lg text-blue-600">Total Charge: 0 Php</div>
                </div>
            </div>
        </div>
    </div>
</div>
 

    </div>

    <div class="col-md-4 m-5 customization-options">
      <h4>{{$product->title}}</h4>
      <button id="addImgBtn" class="btn btn-primary w-100 mb-3 mt-3 rounded-pill"> PHOTO <i class="bi bi-image"></i></button>
      <button id="addTextBtn" class="btn btn-primary w-100 mb-3 rounded-pill"> TEXT <i class="bi bi-fonts"></i></button>

      <div class="editing align-items-center justify-content-start mb-3 p-3 rounded" style="display:flex;">
        <button id="deleteBtn" style="display:none; font-size:20px;"> <i class="bi bi-trash text-danger"></i></button>
          <button class="btn" id="shapeColor" style="display:none; font-size:23px;">
            <i class="bi bi-paint-bucket"></i>
          </button>
         <input type="color" id="shapeColorPicker" value="#000000" style="display:none;">
    </div>

    <div id="textEditor" style="display:none;">
        <div class="title"> <h6 class="mb-2">Edit Text</h6></div>

        <div class="edit-text align-items-center d-flex justify-content-start mb-3 p-3 rounded" >
        <button id="eyedropperBtn" class="btn"><b>A</b><i class="bi bi-eyedropper"></i></button>
        <input type="color" id="textColorPicker" value="#000000" style="display:none;">
        <select id="fontFamily" class="form-select mx-3" style="width:100px;">
            <option selected value="Arial">Arial</option>
            <option value="Courier New">Courier New</option>
            <option value="Georgia">Georgia</option>
            <option value="Times New Roman">Times New Roman</option>
            <option value="Verdana">Verdana</option>
            <option value="Helvetica">Helvetica</option> <!-- Added -->
            <option value="Tahoma">Tahoma</option> <!-- Added -->
            <option value="Trebuchet MS">Trebuchet MS</option> <!-- Added -->
            <option value="Impact">Impact</option> <!-- Added -->
            <option value="Comic Sans MS">Comic Sans MS</option> <!-- Added -->
            <option value="Lucida Console">Lucida Console</option> <!-- Added -->
            <option value="Palatino Linotype">Palatino Linotype</option> <!-- Added -->
            <option value="Garamond">Garamond</option> <!-- Added -->
            <option value="Segoe UI">Segoe UI</option> <!-- Added -->
            <option value="Montserrat">Montserrat</option> <!-- Added -->
            <option value="Open Sans">Open Sans</option> <!-- Added -->
            <option value="Lato">Lato</option> <!-- Added -->
        </select>
        <select id="fontSize" class="form-select" style="width:100px;" title="Text Size">
            <option value="8">8 pt</option>
            <option value="10">10 pt</option>
            <option value="12">12 pt</option>
            <option value="14">14 pt</option>
            <option value="16">16 pt</option>
            <option value="18">18 pt</option>
            <option selected value="20">20 pt</option>
            <option value="24">24 pt</option>
            <option value="30">30 pt</option>
            <option value="36">36 pt</option>
            <option value="48">48 pt</option>
            <option value="60">60 pt</option>
            <option value="72">72 pt</option>
        </select>
        </div>
    </div>

      <h6>Shapes</h6>
        <div class="shapes-and-graphics d-flex justify-content-start mb-3 p-2 rounded">
          <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="shapeDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-square" style="font-size: 15px;"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="shapeDropdownBtn">
              <li><a class="dropdown-item" href=javascript:void(0) data-shape="square">Square</a></li>
              <li><a class="dropdown-item" href=javascript:void(0) data-shape="circle">Circle</a></li>
              <li><a class="dropdown-item" href=javascript:void(0) data-shape="rectangle">Rectangle</a></li>
              <li><a class="dropdown-item" href=javascript:void(0) data-shape="triangle">Triangle</a></li>
            </ul>
          </div>
        </div>


        <h6>Printable Area Background</h6>
<div class="d-flex shapes-and-graphics align-items-center justify-content-start mb-3 p-3 rounded">
    <img class="rounded-circle" id="transparentBgToggle" src="{{ asset('assets/images/transparent.png') }}" style="width: 25px; height: 25px; cursor: pointer;" alt="Transparent Background">
    <input type="color" id="backgroundColorPicker" class="form-control form-control-color mx-2" value="#ffffff" style="width: 25px; height: 25px; padding: 0; border: 2px solid black; border-radius: 50%; -webkit-appearance: none;">
    <select id="backgroundColorDropdown" class="form-select mx-2" style="width: 100px; height: 35px; padding: 5px; border: 2px solid black; border-radius: 10px;">
        <option value="#ffffff" selected>White</option>
        <option value="#f28b82">Light Red</option>
        <option value="#fbbc04">Yellow</option>
        <option value="#34a853">Green</option>
        <option value="#4285f4">Blue</option>
        <option value="#aa00ff">Purple</option>
        <option value="#000000">Black</option>
    </select>
</div>

<div class="mt-4">
        <button type="button" onclick="downloadCanvas()" class="btn btn-success w-100">Download Design</button>

</div>

</div>




<!-- Fabric -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.2/fabric.min.js"></script>
<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Jquery Ui -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- FileSaver -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    // Get the elements
    const container = document.getElementById('container');
    const colorPicker = document.getElementById('backgroundColorPicker');
    const colorDropdown = document.getElementById('backgroundColorDropdown');
    const transparentBgToggle = document.getElementById('transparentBgToggle');

    let canvas;
    let textObjects = [];
    let shapeObjects = [];
    let activeTextIndex = -1;
    let imageCount = 0; 
    let totalTextCharge = 0; // Initialize total text charge
    let totalImageCharge = 0; // Initialize total image charge


    function updateTotalCharge() {
        const totalCharge = totalTextCharge + totalImageCharge;
        $('#totalCharge').text(`Total Charge: ₱${totalCharge}`); // Update the total charge display
    }


    const element = document.getElementById('canvasContainer');
    const parent = element.parentElement;
    // parent.style.backgroundImage = "url('{{ asset('images/' . $product->customizing_image) }}')";


    // Set element dimensions (can be fetched from DB)
    const newLeft = {{$product->canvas_left}}, newTop = {{$product->canvas_top}};
    element.style.left = `${newLeft}%`;
    element.style.top = `${newTop}%`;
    const canWidth = {{$product->canvas_width}} * parent.clientWidth / 100;
    const canHeight = {{$product->canvas_height}} * parent.clientHeight / 100;

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

        // Function to change background color
        function changeBackgroundColor(color) {
            container.style.backgroundColor = color;
        }

        // Event listener for color picker
        colorPicker.addEventListener('input', function() {
            changeBackgroundColor(this.value);
        });

        // Event listener for dropdown
        colorDropdown.addEventListener('change', function() {
            changeBackgroundColor(this.value);
        });

        // Event listener for transparent background toggle
        transparentBgToggle.addEventListener('click', function() {
            container.style.backgroundColor = 'transparent'; // Reset to transparent
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

        // Add input event to track text changes and update benchmark charge
        text.on('changed', function() {
            updateTextCharge(text.text);
        });
    }

    function updateTextEditorValues(text) {
        $("#textColorPicker").val(text.fill);
        $("#fontSize").val(text.fontSize);
        $("#fontFamily").val(text.fontFamily);
        updateTextCharge(text.text); // Update charge when text is added
    }

    // Function to calculate and display the additional charge
    function updateTextCharge(text) {
        const filteredText = text.replace(/[0-9\s]/g, ''); // Remove digits and spaces
        const length = filteredText.length; // Calculate length of filtered text

        // Minimum character benchmark
        const benchmark = 10;
        let charge = 0;

        if (length > benchmark) {
            // Calculate additional charge for characters beyond the benchmark
            charge = (length - benchmark) * 5; // 5 pesos for each character beyond 10
        }
        totalTextCharge = charge;
        // Update the text charge display
        if (charge > 0) {
            $('#textCharge').text(`₱${charge}`); // Display additional charge
        } else {
            $('#textCharge').text('No additional charge'); // No charge if within benchmark
        }

        updateTotalCharge(); // Call to update the total charge display

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
                    imgElement.onload = () => {
                        addImageToCanvasFromSrc(imgElement);
                        imageCount++; // Increment the image count
                        updateImageCharge(); // Update the charge for images
                    };
                };
                reader.readAsDataURL(file);
            }
        });

        fileInput.appendTo('body').trigger('click');
    }
    function updateImageCharge() {
        if (imageCount > 1) {
            totalImageCharge = (imageCount - 1) * 15; // 15 pesos for each additional image beyond the first
            $('#imageCharge').text(`₱${totalImageCharge}`);
        } else {
            totalImageCharge = 0; // No charge for the first image
            $('#imageCharge').text('No additional charge'); // No charge for the first image
        }

        updateTotalCharge(); // Call to update the total charge display

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
            } else if (activeObject.type === 'image') {
                imageCount--; // Decrement the image count if an image is deleted
                updateImageCharge(); // Update the charge after deleting the image
            }
            $('#textEditor, #deleteBtn').hide();
            canvas.renderAll();
        }
    }



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

    // Function to download the #container content (image + canvas) as a PNG
        // function downloadCanvas() {
        //     // Select the container div to capture (image + canvas)
        //     const container = document.getElementById('container');
            
        //     // Use html2canvas to take a screenshot of the container div
        //     html2canvas(container, {
        //         allowTaint: true,
        //         useCORS: true,
        //         scale: 2 // Increase resolution of the output image
        //     }).then(canvas => {
        //         // Convert the captured screenshot to a PNG data URL
        //         const dataURL = canvas.toDataURL('image/png');
                
        //         // Create a download link
        //         const link = document.createElement('a');
        //         link.href = dataURL;
        //         link.download = 'my_design.png'; // Set the downloaded file name
                
        //         // Trigger the download
        //         document.body.appendChild(link);
        //         link.click();
        //         document.body.removeChild(link);
        //     });
        // }
        function downloadCanvas() {
    const container = document.getElementById('container');

    html2canvas(container, {
        allowTaint: true,
        useCORS: true,
        scale: 2
    }).then(canvas => {
        const dataURL = canvas.toDataURL('image/png');

        // Create a download link for the image
        const link = document.createElement('a');
        link.href = dataURL;
        link.download = 'my_design.png';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Get the product code from the form
        const productCode = document.getElementById('product_code').value;

        // Set the image data to the hidden input field
        document.getElementById('image_data').value = dataURL;

        // Submit the form
        document.getElementById('designForm').submit();
    });
}

</script>
@endsection
