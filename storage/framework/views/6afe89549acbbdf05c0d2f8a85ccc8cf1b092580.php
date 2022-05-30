
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
        <link rel="stylesheet" href="<?php echo asset('css/info_perso.css')?>" type="text/css">

    
	</head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">

$(document).ready(function(){
    var x = 1; //Initial field counter is 1
    var max=15;
   var array=[];
   var selector='';
   <?php $__currentLoopData = $etape_modeles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     array.push({description : '<?php echo e($etape->description); ?>',id:'<?php echo e($etape->id); ?>'});
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   
  

   for(let i=0;i<array.length;i++){
       console.log(array[i])
       selector=selector+'<option value='+array[i].id+'>'+array[i].description+'</option>'
   }
    selector=selector+' </select> <a href="javascript:void(0);" class="remove_button" style="color:red">Supprimer</a></div> ';
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    
    //Once add button is clicked
    $(addButton).click(function(){
        if(x<max){
           var debut='<div><select name=select'+x+' id="selection" required><option value="">--Choisissez une étape--</option>'
           var message=debut+selector;
            x++; //Increment field counter
            $(wrapper).append(message); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

	<body>
        <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>

 
<form method="post" action="<?php echo e(route('ajout_procedure')); ?>" class="form_add">
<?php echo csrf_field(); ?>
<div class=container>
    <div>
        <label for="name" style="color:white;">Nom de la procédure</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div class="field_wrapper" style="padding:30px;"> 
    </div> 

        <div class="add_button" style="color:white;padding:30px;">
              <a href="javascript:void(0);"  style="color:white;"title="Add field">Ajouter</a>
        </div>
    <button type="submit"> Créer </button>
</div>

    
   
</form>

</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/creer_procedure.blade.php ENDPATH**/ ?>