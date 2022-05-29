<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<title> Accueil </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo asset('css/navbar.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo asset('css/liste_etudiant.css')?>" type="text/css">

    </head>

    <body>
        
        <?php echo $__env->make('layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class=content>
 <table>
    <tr>
        <th scope="col">Prenom</th>
        <th scope="col">Nom</th>
        <th scope="col">Adresse Mail</th>
        <th scope="col">Numéro étudiant</th>
        <th scope="col">Année d'étude</th>
    </tr>
   
    <?php $__currentLoopData = $etudiants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $etudiant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($etudiant->prenom); ?></td>
        <td><?php echo e($etudiant->nom); ?></td>
        <td><?php echo e($etudiant->email); ?></td>
        <td><?php echo e($info_etudiants[$loop->iteration-1]->num_etudiant); ?></td>
        <td><?php echo e($info_etudiants[$loop->iteration-1]->annee); ?></td>

    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

     <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               					 <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <form method="post" action="<?php echo e(route('ajout_etudiants_csv')); ?>" enctype="multipart/form-data" class="form_add">
        <?php echo csrf_field(); ?>
      
    <div class="depot">
            
    <label for="file" class="label-file">Choisir un fichier csv <?php echo $__env->make('svg.dl', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></label>
    </div>
    <input id="file" class="input-file" type="file" name="file" accept=".csv" required>

    <button type="submit" class="import_button"> Valider </button>
    </form>


</div>

    </body>

</html><?php /**PATH C:\laragon\www\PPRO605\resources\views/liste_etudiant.blade.php ENDPATH**/ ?>