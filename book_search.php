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
        
        
            <h2> Book Search </h2>
            <form method="Post" action="">
                Search a book : <input type="text" name="Search"  > </input>
            <br/>
        <br/>
                <input type="Submit" name="Submit" value="Search"> </input>
                   </form>

       <?php
        if(isset($_POST['Submit']))
        {
        $search=$_POST['Search'];
        //echo $search;
        $con = new mysqli('localhost', 'root', 'root', 'library',3307);
        $result=mysqli_query($con,"select b.isbn, b.title, GROUP_CONCAT(a.fullname),b.Availability from book b, book_authors ba, authors a where b.isbn = ba.isbn and ba.author_id = a.author_id and (b.title like '%$search%' or b.isbn like '%$search%' or a.fullname like'%$search%')   group by b.isbn");
      if($result)
      
    {
        echo "<table border='1'>
<tr>
<th>ISBN</th>
<th>TITLE</th>
<th>FULLNAME</th>
<th>AVAILABILITY</th>
</tr>";
         while($row=mysqli_fetch_array($result))
         {
            echo "<tr>";
        echo "<td>";
        echo $row[0];
        echo "</td>";
        echo "<td>$row[1]</td>";
        echo "<td>$row[2]</td>";
        echo "<td>$row[3]</td>";
        echo "</tr>";
         
            // echo $row[0];
            // echo "--";
            // echo $row[1];
            // echo "--";
            // echo $row[3];
            // echo $row[4];
            // echo "<br/>";
       
               }
        echo "</table>";
      }  

    // if($con->connect_error) {
    //  echo  $con->connect_error;
    // } else {
    //  echo "Connected successfully<br>";
    // }
//      $result=mysqli_query($con, "SELECT * FROM book where title like '%$search%'");

//         if($result)
//         {

//             // echo "Entered";
//        while($row=mysqli_fetch_array($result))
//   {
// $isbn=$row[0];
//  $result_new=mysqli_query($con, "SELECT * FROM book_authors where isbn = $isbn ");
//  if(result_new)
//  {

//  while($row_new=mysqli_fetch_array($result_new))
//  {
//  //       echo $row[0];
//  //    echo " --- ";
//  //  echo $row[1];
 
//  //   echo " --- ";
//  //  echo $row_new[1];

//  // echo " --- ";
//     $author_id=$row_new[1];
//     $result_new1=mysqli_query($con, "SELECT * FROM authors where author_id = $author_id ");
//           if(result_new1)
//      {
//          while($row_new1=mysqli_fetch_array($result_new1))
//          {
//  //           echo $row[0];
//  //    echo " --- ";
//  //  echo $row[1];
 
//  //   echo " --- ";
//  //  echo $row_new[1];

//  // echo " --- ";
//   echo $row_new1[1];
//    echo "<br/>";

//          }
//      }
   
//      }
//   }
//  }
    
// }

//        $result1=mysqli_query($con,"SELECT * FROM authors  where fullname like '%$search%'");
// if($result1)
// {
//     while($row=mysqli_fetch_array($result1))
//   {
//     echo $row[0];
//     echo " --- ";
//   echo $row[1];
// echo "<br/>";
// }   
// }
// $result2=mysqli_query($con,"SELECT * FROM book,authors ");
// if($result2)
// {
//     while($row=mysqli_fetch_array($result2))
//     {

//         echo $row[0];
//         echo "--";
//         echo $row[2];
//         echo "--";
//         echo $row[1];
//     }
// }



        
    
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
