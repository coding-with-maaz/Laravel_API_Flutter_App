

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Products CRUD</h2>
                </div>
                <div class="card-body">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(isset($editProduct) ? route('products.update', $editProduct->id) : route('products.store')); ?>" class="row g-3 align-items-end">
                        <?php echo csrf_field(); ?>
                        <?php if(isset($editProduct)): ?>
                            <?php echo method_field('PUT'); ?>
                        <?php endif; ?>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $editProduct->name ?? '')); ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo e(old('price', $editProduct->price ?? '')); ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="<?php echo e(old('description', $editProduct->description ?? '')); ?>">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success me-2"><?php echo e(isset($editProduct) ? 'Update' : 'Add'); ?> Product</button>
                            <?php if(isset($editProduct)): ?>
                                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-secondary">Cancel</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h4 class="mb-0">Product List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($product->id); ?></td>
                                    <td><?php echo e($product->name); ?></td>
                                    <td>$<?php echo e(number_format($product->price, 2)); ?></td>
                                    <td><?php echo e($product->description); ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo e(route('products.edit', $product->id)); ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                        <form action="<?php echo e(route('products.destroy', $product->id)); ?>" method="POST" style="display:inline-block;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No products found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\k\Desktop\LaravelScraping\laravel_apis\laravel_api\resources\views/products.blade.php ENDPATH**/ ?>