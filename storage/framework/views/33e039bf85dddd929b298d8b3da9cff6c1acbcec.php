<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        
        <style>
            .Image {
                max-width:300px;
                max-height:300px;
            }
            table tr td {
                position: relative;
                align: center;
            }

            div.value_input2 {
                position: absolute;
                bottom: 0;
                left: 18%;
            }
            .myButton {
                color: #494949 !important;
                text-transform: uppercase;
                text-decoration: none;
                background: #ffffff;
                padding: 5px;
                border: 2px solid #494949 !important;
                display: inline-block;
                transition: all 0.4s ease 0s;
            }
        </style>

    </head>
    <body>
        <form action="/picture">
            <input type="submit" value="Upload new picture" class="myButton"/>
        </form>

        <table width="900" align="center" border="0">
            
            <?php

            $userDirectory = 'storage/upload/'.auth()->user()->username;

            if (!file_exists($userDirectory)) {
                mkdir($userDirectory, 0777, true);
            }

            $numberOfPics = 0;

            $files = [];

            if ($handle = opendir('storage/upload/'.auth()->user()->username)) {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {
                        $files[$numberOfPics++] = $entry;
                    }
                }

                closedir($handle);
            }

            $c = 0;

            for ($x = 0; $x < 3; $x++){
                echo '<tr height="400">';
                for ($y = 0; $y < 3; $y++){

                    if ($c < $numberOfPics){
                        // Getting the description of the picture from the database
                        $currentPictureInDB = DB::table('pictures')->where('name', $files[$c])->where('username', auth()->user()->username)->first();

                        /**
                         *  New table data:
                         *  Load there the next picture
                         *  Print under it the description
                         *  Make the edit and delete buttons
                         */
                        echo 
                        '<td align="center" position="relative">
                            <img src="storage/upload/'.auth()->user()->username.'/'.$files[$c].'" class="Image">
                            <div class="value_input2">
                            <br />'.$currentPictureInDB->description.'
                            <br /> 
                            <form action="/pictureeditor/'.$files[$c].'">
                                <input type="submit" value="Szerkesztés" class="myButton"/>
                                <input type="submit" value="Törlés" formaction="/deletepicture/'.$files[$c].'" class="myButton"/>
                            </form>
                            </div>
                        </td>';
                        $c++;
                    }
                    
                }

                echo '</tr>';
            }

            

            ?>
        </table>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\proba\PROBA\resources\views/pictureViewer.blade.php ENDPATH**/ ?>