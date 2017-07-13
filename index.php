<!DOCTYPE html>
<html lang="en">
<head>
  <title>Aspect Ratio with Preview Pane | Jcrop Demo</title>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8" />

<script src="js/jquery.min.js"></script>
<script src="js/jquery.Jcrop.js"></script>


<link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
<style type="text/css">
  /* Apply these styles only when #preview-pane has
     been placed within the Jcrop widget */
  .jcrop-holder #preview-pane {
    display: block;
    position: absolute;
    z-index: 2000;
    top: 10px;
    right: -280px;
    padding: 6px;
    border: 1px rgba(0,0,0,.4) solid;
    background-color: white;

    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;

    -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  }
  .bg_crop{
    width: 300px !important;
    height: 300px !important;
    /*object-fit: contain;*/
  }

  /* The Javascript code will set the aspect ratio of the crop
     area based on the size of the thumbnail preview,
     specified here */
  #preview-pane .preview-container {
    width: 250px;
    height: 170px;
    overflow: hidden;
  }
  
</style>

</head>
<body>
  
  <div class="preview-pane" style="margin-bottom: 20px">

  </div>
  <form action="" id="foto">
    <input type="file" name="foto">
  </form>
    <img id="img" class="contenedor" style="display: none;">
    <div class="old" img=""></div>
  <div class="croped">
    
  </div>
  <script>
    function readURL(input) {

      if (input.files && input.files[0]) {
          var reader = new FileReader();
          var img  = new Image();
          reader.onload = function (e) {
            var check = true;
            $('#img').attr('src', e.target.result);
            if ($('.old').attr('img') != '') {
              console.log($('.old').attr('img'));
                  $.post("borrarFoto.php",{img: $('.old').attr('img'),borrar: ''},
                  function(data){
                    if (data.status == 0) {
                      check = false;
                    }
                  });
            }
            if (check) {
              var formData = new FormData(document.getElementById("foto"));
              $.ajax({
                type: "POST",
                url: "crop2.php",
                data: formData,
                cache: false,
                      contentType: false,
                      processData: false,
                success: function(data){
                  //CODE HERE!!!

                  $('.preview-pane').empty().append(data);
                  setTimeout(function() {crop()}, 10);


                }
              });
            }
          }
          
          // img.src = _URL.createObjectURL(input.files[0]);
          reader.readAsDataURL(input.files[0]);
      }
    }

    $('#foto').on('change','input[type="file"]',function(){
        // var contenedor= $(this).parent().parent().parent();
        readURL(this);
    });


    $('.enviar_foto').click(function(){
    });
    function crop(){
      jQuery(function($){
        $(document).ready(function(){
          var bg = $('#original');


        });
    // Create variables (in this scope) to hold the API and image size
        var jcrop_api,boundx,boundy;

            // Grab some information about the preview pane
            $preview = $('#preview-pane');
            $pcnt = $('#preview-pane .preview-container');
            $pimg = $('#preview-pane .preview-container img');

            xsize = $pcnt.width();
            ysize = $pcnt.height();
        
        // console.log('init',[xsize,ysize]);
        $('.old').attr('img',$('#target').attr('src'));

        $('#target').Jcrop({
          onChange: updatePreview,
          onSelect: updatePreview,
          aspectRatio: false,
          trueSize: [$('#img').width(),$('#img').height()] // aqui se debe colocar un contenedor con la imagen en su tamanio original 
        },function(){
          // Use the API to get the real image size
          var bounds = this.getBounds(); // estas propiedades de bounds "supongo" que estan enlazadas a elemento que se envia en trueSize

          boundx = bounds[0];
          boundy = bounds[1];
          // Store the API in the jcrop_api variable
          jcrop_api = this;

          // Move the preview into the jcrop container for css positioning
          $preview.appendTo(jcrop_api.ui.holder);
        });

        function updatePreview(c)
        {
          console.log(c.w);
          if (parseInt(c.w) > 0)
          {
            var rx = xsize / c.w;
            var ry = ysize / c.h;

            $pimg.css({
              width: Math.round(rx * boundx) + 'px',
              height: Math.round(ry * boundy) + 'px',
              marginLeft: '-' + Math.round(rx * c.x) + 'px',
              marginTop: '-' + Math.round(ry * c.y) + 'px'
            });
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
          }
        };
      });
      function checkCoords()
      {
        if (parseInt($('#w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
      };
    }
  </script>
  <script>
    $(document).on('click','#cropit',function(){
      var img = $('#original').attr('src');
      var x = $('#x').val();
      var y = $('#y').val();
      var w = $('#w').val();
      var h = $('#h').val();
      console.log(img);
      $.post("cropper.php",{img: img,x: x, y: y, w: w, h: h, croperar: ''},
      function(data){
        // CODE HERE!!!

        // location.reload();
      });
    });
  </script>
</body>
</html>

