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

        <div id="page-wrapper" style="background-color:    #ffffff; ">

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
                Search : <input type="text" name="Search"  > </input>
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
        $result=mysqli_query($con,"select bl.Loan_id,bl.Isbn,bl.Card_id,book.title,borrower.fname,borrower.lname,bl.Due_date,bl.Date_in from book_loans bl,book,borrower where bl.Card_id=borrower.card_no and bl.Isbn=book.Isbn and (bl.Loan_id ='$search' or bl.Isbn like '%$search%' or bl.Card_id = '$search' or book.title like '%$search%' or borrower.fname like '%$search%' or borrower.lname like '%$search%') and date_in='0000-00-00' ");
        // $result= mysqli_query($con,"select * from book_loans");
      if($result)
      
    {
        $rows=mysqli_num_rows($result);
        if($rows>0)
        {

        echo "<table border='1'>
<tr>
<th>Loan ID</th>
<th>ISBN</th>
<th>Card ID</th>
<th>Title</th>
<th>First Name</th>
<th>Last Name </th>
<th>Check-In</th>
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
        echo "<td>$row[4]</td>";
        echo "<td>$row[5]</td>";
        echo "<td><form action='' method='Post'>
        <input type=hidden name=isbn value= '$row[1]'></input>
        <input type=hidden name=duedate value='$row[6]'></input>
        <input type=hidden name=card_id value='$row[2]'</input>
                <button type ='submit' name='check_in' value=$row[0]>Check-In</button>

      
         </form></td>";

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
      
      else{
        echo "<h4 style='color:red'; >No records found</h4>";
      } 

}
    
    }
    
        
        
        if(isset($_POST['check_in']))
               {
                echo "<br/>";
               $isbn=$_POST['isbn'];
                $loan_id=$_POST['check_in'];
                $duedate=$_POST['duedate'];
$card_id=$_POST['card_id'];
               // $datein=$_POST['datein'];
                echo $duedate."<br/>";
                //echo $datein;
$date_in=date('Y-m-d');
// $totaldays= $duedate->diff($date_in);
// echo $totaldays->d;
$duedate_days = strtotime($duedate); // or your date as well
$date_in_days = strtotime($date_in);
$datediff = floor(($date_in_days - $duedate_days)/(24*60*60));
//echo $datediff;
if($datediff>0)
{
    $fine_amt= ($datediff)*0.25;
}
else
{
    $fine_amt=0;
}

// floor($datediff / (60 * 60 * 24));
//echo $date_in;
            $con = new mysqli('localhost', 'root', 'root', 'library',3307);
              $result=mysqli_query($con,"update book_loans set Date_in = '$date_in' where Loan_id='$loan_id' ");
              $result1=mysqli_query($con,"update book set Availability='Available' where Isbn='$isbn'");
              $result2=mysqli_query($con,"update fines set Fine_amt='$fine_amt' where Loan_id='$loan_id'");
      // $rows1=mysql_affected_rows($result);
      // echo $rows1;
      // $rows2=mysql_affected_rows($result1);
      if($result and $result1 and $result2)
      {
        echo "<h4 style='color:green'; >Check-In successful</h4>";
     }
     else
     {
        echo "<h4 style='color:red;'>Check-In not successful</h4>";
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
