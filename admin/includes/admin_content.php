<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
        </h1>
        <?php 

            // $user_result = User::find_user_by_id(1);
            
            // echo $user_result->username;

            // $user = new User();

            // $user -> username = "example";
            // $user -> password = "example1";
            // $user -> first_name = "example2";
            // $user -> last_name = "example3";

            // $user -> create();

            // $user = User::find_user_by_id(2);
           

            // $user -> delete();

            
            $user = User::find_user_by_id(4);
           
            $user -> username = "updated";
            $user -> password = "updated";
            $user -> first_name = "updated";
            $user -> last_name = "updated";
            $user -> save();

            // $user = new User();
           
            // $user -> username = "benn";
            // $user -> password = "123";
            // $user -> first_name = "yeye";
            // $user -> last_name = "creaated";
            // $user -> save();
           
        ?>
       
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->