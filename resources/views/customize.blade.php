@extends('layouts.app3')
<link rel="stylesheet" href="{{asset('assets/css/customize.css')}}">

@section('contents')


<div class="row justify-content-center">
    <div id="fcol">
        <div id="container" style="display: flex; align-items:center; justify-content:center;">
            <img src="{{ asset('images/' . $product->customizing_image) }}" id="preview2" alt="Image Preview" style="display:block; :absolute; max-width:100%; max-height:100%;">
            <div id="canvasContainer">
                <canvas id="canvas"></canvas>
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
        <img class="rounded-circle" id="transparentBgToggle" src="{{asset('assets/images/transparent.png')}}" style="width: 25px; height: 25px; cursor: pointer;" alt="Transparent Background">
         <input type="color" id="backgroundColorPicker" class="form-control form-control-color mx-2" value="#ffffff"
       style="width: 25px; height: 25px; padding: 0; border: 2px solid black; border-radius: 50%; -webkit-appearance: none;">

      </div>

      <div class="mt-4">
        <button id="downloadBtn" class="btn btn-success w-100">ORDER</button>
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
    <script>
        let canvas;
        let textObjects = [];
        let shapeObjects = [];
        let activeTextIndex = -1;

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

    </script>
@endsection
