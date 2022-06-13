<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PMS-PROJECT_MANAGEMENT_SYSTEM</title>

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
      
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('system/css/style.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <app-component></app-component>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/app.js"></script> -->
    <script src="js/app.js"></script>
    <script src="{{ asset('system/js/jquery-3.6.0.min.js') }}"></script>
        <script type="text/javascript" src="https://unpkg.com/popper.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('system/js/scripts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="{{ asset('system/js/datatables-simple-demo.js') }}"></script>
        <script src="{{ asset('system/plugin/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('system/plugin/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- <link rel="stylesheet" href="{{ asset('system/css/login.css') }}"> -->
        <script>

        function load_modal(heading,content,width=false,height=false,close_previous =false,keep_window_object = false,close_callback = false){

        $('.common_modal').removeClass('last_opened_modal');
        $('.common_modal').removeClass('current_opened_modal');
        $('.common_modal').first().next('.common_modal').addClass('last_opened_modal');

        var modal_clone_id = 'common_modal_'+ heading.replace(/[#|_|;\\/:*?\"<>|&'()~]/g,'').replace(/ /g, '_').toLowerCase();
        already_exist = false;

        if($('#'+ modal_clone_id).length > 0){
          already_exist = true;
        }

        if(already_exist){
          var clone_modal = $('#'+ modal_clone_id);
        }else{
          var clone_modal = $('#common_modal').clone();
          $(clone_modal).attr('id',modal_clone_id);
          $('#common_modal').after(clone_modal);
        }

        if(width){
          $('#' + modal_clone_id + ' .modal-dialog').css('min-width', width);
        }
        if(height){
          $('#' + modal_clone_id + ' .modal-dialog').css('height', height);
        }

        $('#'+ modal_clone_id).on('hidden.bs.modal',function(){
          if($('.common_modal').not(":hidden").length > 0){
            $('body').addClass('modal-open');
          }

          if(!keep_window_object){
            $('#'+ modal_clone_id).remove();
          }
          if(close_callback){
            if(typeof close_callback === "function"){
              close_callback();
            }
          }
        });

        if(close_previous && !already_exist){
          $('.last_opened_modal').remove();
        }

        if(!already_exist){
          var tmp_keep_window_object = false;
        }else{
          var tmp_keep_window_object = keep_window_object;
        }
        if(!tmp_keep_window_object){
          $('#'+ modal_clone_id + ' .modal-title').html('');
          $('#'+ modal_clone_id + ' .modal-body').html('');

          $('#'+ modal_clone_id + ' .modal-title').html("<div class='modal-heading'>" + heading + "</div>");
          $('#'+ modal_clone_id + ' .modal-body').html(content);
        }

        $('#'+ modal_clone_id).addClass('current_opened_modal');
        $('#'+ modal_clone_id).css('z-index', 10000 + $('.common_modal').length);
        $('#'+ modal_clone_id).modal('show');

        return modal_clone_id;
        }

        function hide_modal(element){
        $(element).closest('.modal').modal('toggle');
        }

        </script>

</body>
</html>
