<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <title>Upload Picture</title>

    </head>

    <body>

        <div class="container">

            <div class="row">
            
                <form action="{{ route('upload.picture')}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="file" name="picture">

                    <input type="submit" class="btn btn-info">

                    <br/>

                    Leírás: <input type="text" size="34" name="desc">

                </form>

            </div>

        </div>

    </body>
</html>