@extends('layouts.app2')
<link rel="stylesheet" href="{{asset('assets/css/customize.css')}}">
    <!-- Jquery -->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <!-- Bootstrap -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> --}}
@section('contents')


<div class="row justify-content-center">
    <div id="fcol">
        <div id="container">
            <img src="{{asset('assets/images/notebook.jpg')}}" id="preview2" alt="Image Preview" style="position:absolute; width:100%; height:100%;">
            <div id="canvasContainer">
                <canvas id="canvas"></canvas>
            </div>
        </div>
    </div>




    <div class="col-md-4 m-5 customization-options">
      <h4>Classic T-shirt</h4>
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
              <li><a class="dropdown-item" href="#" data-shape="square">Square</a></li>
              <li><a class="dropdown-item" href="#" data-shape="circle">Circle</a></li>
              <li><a class="dropdown-item" href="#" data-shape="rectangle">Rectangle</a></li>
              <li><a class="dropdown-item" href="#" data-shape="triangle">Triangle</a></li>
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
    <script src="{{asset('assets/js/customize.js')}}"></script>
@endsection
