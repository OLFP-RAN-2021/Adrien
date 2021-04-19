<footer>

        <div class="title"> Boilley Adrien </div>

        <div class="frow">

            <?php 
                $list = glob('assets/html/widgets/*.html');
                foreach($list as $path){
                    include $path;
                }
            
            
            ?>
        </div>
    </footer>