
<ul>

  <li style=<?php echo e(Request::is('main')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('main')); ?>">Home</a></li>
  <li style=<?php echo e(Request::is('mes_conventions')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('mes_conventions')); ?>">Conventions</a></li>
  <li style=<?php echo e(Request::is('info_perso')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('info_perso')); ?>">Informations Personnelles</a></li>
  <li style=<?php echo e(Request::is('contact')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('contact')); ?>">Contact</a></li>
  <?php if(Auth::user()->travailleur !=NULL): ?>
    <?php if(Auth::user()->travailleur->job_id==8): ?>
    <li style=<?php echo e(Request::is('liste_etudiant')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('liste_etudiant')); ?>">Liste d'étudiant</a></li>
    <li style=<?php echo e(Request::is('procedures') || Request::is('creer_procedure')? 'background-color:rgb(64,154,182);' :''); ?>><a href="<?php echo e(route('procedures')); ?>">Procedures de ma faculté</a></li>
    <?php endif; ?>
  <?php endif; ?>
  

  <li class=deconnexion> <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>

                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.responsive-nav-link','data' => ['href' => route('logout'),'onclick' => 'event.preventDefault();
                                        this.closest(\'form\').submit();']]); ?>
<?php $component->withName('responsive-nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('logout')),'onclick' => 'event.preventDefault();
                                        this.closest(\'form\').submit();']); ?>
                        <?php echo e(__('Se deconnecter')); ?>

                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </form></li>
 
</ul><?php /**PATH C:\laragon\www\PPRO605\resources\views/layout/navbar.blade.php ENDPATH**/ ?>