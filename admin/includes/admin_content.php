<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Blank Page
            <small>Subheading</small>
        </h1>
        <?php 
        
            $res_set =User::find_all_users();

            while($row = mysqli_fetch_array($res_set)) {
                echo $row['username'] . '<br>';
            }

            $res_id = User::find_user_id(1);

            $user = User::instantiation($res_id);

            echo $user->username;
           
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