<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Library Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
    <style>
table {
        border-collapse:none;

}
td,th
{
padding:10px;
}

</style>

</head>

<body>
 
           
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >Library Management</a>
            </div>
            <!-- Top Menu Items -->
           
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav" >
                    
                    <li>
                        <a href="book_search.php" style="color:#ffffff;"> Book Search and Availability</a>
                    </li>
                    <li>

                        <a href="add_borrower.php" style="color:#ffffff;" > Borrower Management</a>
                    </li>
                    <li>
                        <a href="checkin.php" style="color:#ffffff"> Check-In books </a>
                   
                     <li>


                        <a href="fines.php" style="color:#ffffff"> View Fines</a>
                    </li>
                    <li>
                        <a href="checkout.php" style="color:#ffffff"> Check-Out books </a>
                    </li>
                    
		 
                         

                    <li>
                        
                    


                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="background-color:    #ffffff;">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->


                
                <!-- /.row -->

            </div>
        
        
            <h2> Add Borrower </h2>
            <form method="Post" action="">
                SSN :<br/> <input type="text" name="ssn"  > </input>
            <br/>
                First Name : <br/><input type="text" name="fname"> </input>
                <br/>
                Last Name: <br/><input type="text" name="lname"></input>
                <br/>
                Email id: <br/><input type="email" name="email"></input>
                <br/>
                 Address: <br/><input type="text" name="address"></input>
                <br/>
                 City: <br/><input type="text" name="city"></input>
                <br/>
                 State: <br/><input type="text" name="state"></input>
                <br/>
                 Phone: <br/><input type="text" name="phone"></input>
                <br/>

        <br/>

                <input type="Submit" name="Submit" value="Add Borrower"> </input>
                   </form>

       <?php
        if(isset($_POST['Submit']))
        {
        $ssn=$_POST['ssn'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $phone=$_POST['phone'];
        //echo $search;
        if($ssn=="" || $fname=="" || $lname=="" || $email=="" || $address=="" || $city=="" || $state=="" || $phone=="")
        {
            echo "<h4 style='color:red;'>Please enter all the fields</h4>";
        }
        else
        {
        $con = new mysqli('localhost', 'root', 'root', 'library',3307);
        $result_ssn = mysqli_query($con,"select ssn from borrower where ssn='$ssn'");
        $rows=mysqli_num_rows($result_ssn);
        if($rows>0)
        {
            echo "<h4 style='color:red;'>Borrower already exists</h4>";
        }
        else
        {
                $result=mysqli_query($con,"insert into borrower (ssn,fname,lname,email,address,city,state,phone) values ('$ssn','$fname','$lname','$email','$address','$city','$state','$phone')");
                if($con->error)
                {
                    echo $con->error;
                }
                else
                {
                    echo "<h4 style='color:green';>Borrower successfully added</h4>";
                }
     
   }

}

        
    
    }
    
        ?>

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>
  
</body>

</html>
