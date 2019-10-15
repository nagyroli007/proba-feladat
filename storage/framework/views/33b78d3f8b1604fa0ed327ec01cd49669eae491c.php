<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>Upload Picture</title>

    </head>

    <body>

        <div class="container">

            <div class="row">
            
                <form action="<?php echo e(route('upload.picture')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

                    <?php echo e(csrf_field()); ?>


                    <input type="file" name="picture">

                    <input type="submit" class="btn btn-info">

                    <br/>

                    Leírás: <input type="text" size="34" name="desc">

                </form>

            </div>

        </div>

    </body>
</html><?php /**PATH C:\xampp\htdocs\proba\PROBA\resources\views/upload.blade.php ENDPATH**/ ?>