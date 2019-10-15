<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <style>
            .Image {
                display: block;
                margin-left: auto;
                margin-right: auto;
                max-width:600px;
                max-height:600px;
            }
        </style>

    </head>
    <body>
       <?php
            echo '<img src="/storage/upload/'.auth()->user()->username.'/'.$picname.'" class="Image"/>';

            $currentPictureInDB = DB::table('pictures')->where('name', $picname)->where('username', auth()->user()->username)->first();
        ?>

        <br/>

        

        <form align="center" method="post" action="/updateDesc/<?php echo $picname;?>">
             {{ csrf_field() }}
            <input tpye="text" name="newdesc"value="<?php 
            $currentPictureInDB = DB::table('pictures')->where('name', $picname)->where('username', auth()->user()->username)->first();
            echo $currentPictureInDB->description; ?>" >
            <button type="submit" class="btn btn-primary">Leírás frissítése</button>

        </form>

        <br />

         <div class="container" align="center">

            <div class="row">

                Kép lecserélése:
            
                <form action="/replacepicture/<?php echo $picname; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="file" name="picture">

                    <input type="submit" class="btn btn-info" value="Csere" method="post">

                    <br/>

                    Leírás: <input type="text" name="desc">

                </form>

            </div>

        </div>
    </body>
</html>
