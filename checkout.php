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
<th>Borrow</th>
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
        echo "<td><form action='' method='Post'>
        <input type=hidden name=title value= '$row[1]'></input>
        <button type ='submit' name='borrow' value=$row[0]>Check-Out</button>

      
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


    
    }
    
        
        
        if(isset($_POST['borrow']))
               {
                echo "<br/>";
               $title=$_POST['title'];
                $isbn=$_POST['borrow'];
                 $con = new mysqli('localhost', 'root', 'root', 'library',3307);
                 $result_set=mysqli_query($con,"select * from book where Isbn='$isbn'");
                        $array=mysqli_fetch_array($result_set);
                            $avail=$array[2];
                           // echo $avail;
                 if($avail=="Not Available")
                            {
                              echo "<h4 style='color:red;'>Book not Available</h4>";   
                            }
               
                
                           
                            else
                            {
                                 echo "<br/>";
                echo "Selected book:";
                  echo "<h4>$title</h4>";
                  echo "ISBN:";
                echo "<h4>$isbn</h4>";
                echo "<form action='' method='Post' >
                Enter borrower card number: <input type='text' name='card_number'> </input>
                <br/>
                <br/>
                <input type=hidden name=isbn value='$isbn'></input>
                <input type='submit' name='issue' value='Issue'></input>
                </form>";
                             }  //echo "SET";
               }

               if(isset($_POST['issue']))
               {
                echo "<br/>";
                $card_number=$_POST['card_number'];
                $isbn=$_POST['isbn'];
                 $timestamp = date("Y-m-d");
                 $due_date= date('Y-m-d', strtotime($timestamp. ' + 14 days'));
                 //$due_date=date($timestamp,strtotime("+14 days"));
                 //echo $due_date;
                    $con = new mysqli('localhost', 'root', 'root', 'library',3307);
                                   
                            
        $result=mysqli_query($con,"select * from book_loans where card_id='$card_number' and date_in='0000-00-00' group by card_id having count(*)>=3");
        $rows=mysqli_num_rows($result);
       // echo $rows;
        if($rows>0)
        {
            echo "<h4 style='color:red;'>User already has 3 books</h4>";
        }
          else
        {
            // $result_set=mysqli_query($con,"select * from book where Isbn='$isbn'");
            
            // $array=mysqli_fetch_array($result_set);
            //                 $avail=$array[2];

            //                 if($avail=="Available")
            //                 {
            
         $result=mysqli_query($con,"insert into book_loans(Isbn,Card_id,Date_out,Due_date,Date_in) values('$isbn','$card_number','$timestamp','$due_date','NULL') "); 
         $result1=mysqli_query($con,"update book set Availability='Not Available' where Isbn='$isbn' "); 
         echo "<h4 style='color:green;'>Book Succesfully issued</h4>";
         $result2=mysqli_query($con,"select Loan_id from book_loans where Isbn='$isbn' and Card_id='$card_number' and Date_out='$timestamp' and date_in='0000-00-00'");
         $array=mysqli_fetch_array($result2);
         $loanid= $array[0];
         $result_new=mysqli_query($con,"insert into fines(Loan_id,Card_id) values ('$loanid','$card_number')");
         
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
