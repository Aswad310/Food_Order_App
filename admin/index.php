<?php include('partials/menu.php'); ?>

        <!-- Main Content Section starts  -->
        <section class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1> <br>

                <?php
                    if(isset($_SESSION['login'])){  
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); 
                    }
                ?>
                
                <br>
                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Category
                </div>

                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Category
                </div>
                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Category
                </div>
                
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Category
                </div>

            </div>  
            <div class="clearfix"></div>
            
        </section>
        <!-- Main Content Section ends  -->

<?php include('partials/footer.php'); ?>