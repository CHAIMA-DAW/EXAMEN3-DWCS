<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('contenido'); ?>
    <?php if(isset($mensaje)): ?>
        <div class="alert alert-success h-100 mt-3">
            <p><?php echo e($mensaje); ?></p>
        </div>
    <?php endif; ?>
    <a href='fcrear.php' class='btn btn-success mt-2 mb-2'><i class='fa fa-plus'></i> Nuevo Jugador</a>
    <table class="table table-striped table-dark">
        <thead>
        <tr class="text-center" style="font-width: bold; font-size:1.1rem">
            <th scope="col">Nombre Completo</th>
            <th scope="col">Posición</th>
            <th scope="col">Dorsal</th>
            <th scope="col">Código de Barras</th>
        </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $jugadores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <th scope="row"><?php echo e($item->apellidos.", ".$item->nombre); ?></th>
                
                    <td>
                        <a href="jugadores.php?pos=<?php echo e(urlencode($item->posicion)); ?>">
                            <?php echo e($item->posicion); ?>

                        </a>
                    </td>
                <?php if(isset($item->dorsal)): ?>
                    <td><?php echo e($item->dorsal); ?></td>
                <?php else: ?>
                    <td>Sin Asignar</td>
                <?php endif; ?>
                <td class="d-flex justify-content-center"><?php echo $d->getBarcodeHTML($item->barcode, 'EAN13',2,33, 'white') ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
        <?php if(isset($listaPosicion) && is_array($listaPosicion)): ?>
        <div class="alert alert-info mt-4">
            <?php if($posSeleccionada): ?>
                <h5>Jugadores en la posición: <?php echo e($posSeleccionada); ?></h5>
            <?php endif; ?>

            <?php if(count($listaPosicion) > 0): ?>
                <ul>
                    <?php $__currentLoopData = $listaPosicion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nombreCompleto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($nombreCompleto); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php else: ?>
                <p>No hay jugadores con esa posición.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantilla1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>