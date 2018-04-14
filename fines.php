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
        
        

       <?php
       echo "<h2> View Fines </h2>";
          echo "<form method='Post' action=''>
                Card ID :<br/> <input type='text' name='card_id'  > </input>
            <br/>
               
        <br/>
                <input type='Submit' name='Submit' value='View Fines'> </input>
               <input type='Submit' name='Update' value='Update Fines'> </input>
               <br/>
               <br/>
               <input type='Submit' name='Individual' value='View Fines by book' </input>
               <input type='Submit' name='Previous' value='View Previously Paid fines'</input>
                
                   </form>";
                   function Display()
                   {
                     $con=new mysqli('localhost','root','root','library',3307);
            //echo "Normal";
             echo "<br/>";
                echo "<table border='1'>";
                echo "<tr>";
echo "<th>Card ID</th>
<th>Fine Amount </th>
</tr>";
//echo "1";
                $result_card=mysqli_query($con,"select Card_id,sum(Fine_amt) from fines group by Card_id");
                //echo "1";
                while($array=mysqli_fetch_array($result_card))
                {
                    //echo "1";
                    //echo "while loop";
                    $Card_id=$array[0];
                    $Fine=$array[1];
                    //$Paid=$array[2];
                    //echo $Paid;

// if($Paid==0)
// {
//     $paid='Fine Due';
// }
// else
// {
//     $paid='Paid';
// }

echo "<tr>
<td>$array[0]</td>
<td>$$array[1]</td>
</tr>";

            }
        }
         
            echo "</table>";

                
//                     if(isset($_POST['Pay']))
//                     {
// //echo "Pay set";
//                         $con=new mysqli('localhost','root','root','library',3307);
//                          $Card_id_new=$_POST['Pay'];
//                          echo $Card_id_new;
//                          $update_Paid=mysqli_query($con,"update fines set Paid='1' where Card_id=$Card_id_new ");
//                          $update_fine=mysqli_query($con,"update fines set Fine_amt = '0' where Card_id=$Card_id_new");

//                                       }
//                                   }

     if(isset($_POST['Update']))
     {
    $con=new mysqli('localhost','root','root','library',3307);

    // echo "Update clicked";
        if($con->error)
        {
            echo $con->error;
        }
        else
        {
            $result_update=mysqli_query($con,"select * from book_loans where Date_in='0000-00-00'");
            while($array=mysqli_fetch_array($result_update))
            {
                //echo "while loop";
                 //echo $array[0];
                $loanid=$array[0];
                $cardid=$array[2];
                $duedate=$array[4];
                $today=date('Y-m-d');
                //echo $today;
                //echo "<br/>";
                //echo $duedate;
                //echo "<br/>";
                $duedatetime=strtotime($duedate);
                $todaytime=strtotime($today);
                //echo $duedatetime;
                $daysdiff=floor(($todaytime-$duedatetime)/(24*60*60));
                if($daysdiff>0)
                {
                    $fine_amt= $daysdiff*0.25;
                    $update=mysqli_query($con,"update fines set Fine_amt='$fine_amt' where Loan_id='$loanid' and Card_id='$cardid'");
                }
                //echo $daysdiff;
                // echo "<br/>";
                // echo $array[1];
                // echo "<br/>";
            }
        }
        Display();
     }
     else if(isset($_POST['Previous']))
     {
        $card_id=$_POST['card_id'];
         if($card_id!="")
         {
            //echo $card_id;
            $con=new mysqli('localhost','root','root','library',3307);
            if($con->error)
            {
                echo $con->error;
            }
            else
            {
                $result_individual=mysqli_query($con,"select * from fines where Card_id='$card_id' and Paid='1' ");
                $row_count=mysqli_num_rows($result_individual);
                if($row_count>0)
                {
                    echo "<br/>";
                    echo "<table border='1'>";
                    echo "<tr>
                    <th>Loan ID</th>
                    <th>Card ID</th>
                    <th>Fine Amount</th>
                    <th>Status</th>
                    </tr>";
                    //$array=mysqli_fetch_array($result_individual);
                while($array=mysqli_fetch_array($result_individual))
                {
                    $loanid_indi=$array[0];
                    $cardid_indi=$array[1];
                    $fine_amt_indi=$array[2];
                    //$Paid_indi='Paid';
                    echo "<td>$loanid_indi</td>
                    <td>$cardid_indi</td>
                    <td>$$fine_amt_indi</td>
                    <td>Paid</td>";
                     echo "</tr>";

        }
     }
     else
     {
        echo "<h4 style='color:red;'>No records found</h4>";
     }
 }
}
else
{
    echo "<h4 style='color:red;'>Enter a card number</h4>";
}
}

     else if(isset($_POST['Individual']))
     {
         $card_id=$_POST['card_id'];
         if($card_id!="")
         {
            //echo $card_id;
            $con=new mysqli('localhost','root','root','library',3307);
            if($con->error)
            {
                echo $con->error;
            }
            else
            {
                $result_individual=mysqli_query($con,"select * from fines where Card_id='$card_id' ");
                $row_count=mysqli_num_rows($result_individual);
                if($row_count>0)
                {
                    echo "<br/>";
                    echo "<table border='1'>";
                    echo "<tr>
                    <th>Loan ID</th>
                    <th>Card ID</th>
                    <th>Fine Amount</th>
                    <th>Status</th>
                    <th>Pay</th>
                    </tr>";
                    //$array=mysqli_fetch_array($result_individual);
                while($array=mysqli_fetch_array($result_individual))
                {
                    $loanid_indi=$array[0];
                    $cardid_indi=$array[1];
                    $fine_amt_indi=$array[2];
                    $Paid_indi=$array[3];
                    if($Paid_indi==0)
                    {
                        $paid_indi='Fine Due';
                        // while($array)
                        // {
                        //     echo "<tr>";
                        if($fine_amt_indi==0)
                        {
  echo "<td>$loanid_indi</td>
                    <td>$cardid_indi</td>
                    <td>$$fine_amt_indi</td>
                    <td>$paid_indi</td>";
                   echo "<td>No fine</td>
                    </tr>";
                        }
                        else
                        {
                    echo "<td>$loanid_indi</td>
                    <td>$cardid_indi</td>
                    <td>$$fine_amt_indi</td>
                    <td>$paid_indi</td>";
                   echo  "<form action='' method='Post'>";
                    echo "<td><button type='submit' name='pay' value=$array[0]>Pay</button></td>
                    </form>
                    </tr>"; 
                }
                        }
                    
                    else
                    {
                        $paid_indi='Paid';
                        // while($array)
                        // {
                                     echo "<tr>";
                    echo "<td>$loanid_indi</td>
                    <td>$cardid_indi</td>
                    <td>$$fine_amt_indi</td>
                    <td>$paid_indi</td>";
                   echo  "<td>Paid</td>";
                    echo "</tr>"; 
                        //}
                    }
                   



                }
                                echo "</table>";

            }
            else
            {
                echo "<h4 style='color:red;'>No records found</h4>";
            }
        }
    }
            else
            {
                echo "<h4 style='color:red;'>Enter a card number</h4>";
            }
     }
 
       else if(isset($_POST['Submit']))
        {
            //echo "1";
            $card_id=$_POST['card_id'];
            //echo $card_id;
            $con=new mysqli('localhost','root','root','library',3307);
            if($con->error)
            {
                echo $con->error;
            }
            else
            {
                  $con=new mysqli('localhost','root','root','library',3307);
            //echo "Normal";
             
//echo "1";
                $result_card=mysqli_query($con,"select Card_id,sum(Fine_amt) from fines where Card_id='$card_id' group by Card_id ");
                //echo "1";
                $row_count=mysqli_num_rows($result_card);
                if($row_count>0)
                {
                    echo "<br/>";
                echo "<table border='1'>";
                echo "<tr>";
echo "<th>Card ID</th>
<th>Fine Amount </th>
</tr>";
                while($array=mysqli_fetch_array($result_card))
                {
                    //echo "1";
                    //echo "while loop";
                    $Card_id=$array[0];
                    $Fine=$array[1];
                    //$Paid=$array[2];
// if($Paid==0)
// {
//     $paid='Fine Due';
// }
// else
// {
//     $paid='Paid';
// }

echo "<tr>
<td>$array[0]</td>
<td>$$array[1]</td>
</tr>";

            }

            
            echo "</table>";
             //Display();
            }
            
            else
            {
              echo "<h4 style='color:red;'>No record found</h4>";  
              echo "<br/>"; 
              echo "<h4>Displaying all records:</h4>";
              Display();
            }
        }
    }
                        else if(isset($_POST['pay']))
                                {
                                    //echo "Paid button";
                                    $loanid_new=$_POST['pay'];
                                    //echo $loanid_new;
                                    $con=new mysqli("localhost","root","root","library",3307);
                                    $result_pay=mysqli_query($con,"select Date_in from book_loans where Loan_id='$loanid_new'");
                                    $array=mysqli_fetch_array($result_pay);
                                    $date_in_pay=$array[0];
                                    if($date_in_pay=='0000-00-00')
                                    {
                                        echo "<h4 style='color:red;'>Fine cannot be paid for the books that are not yet returned</h4>";
                                    }
                                    else
                                    {
                                        $resultpay=mysqli_query($con,"update fines set Fine_amt='0' where Loan_id='$loanid_new'");
                                        $resultpay_new=mysqli_query($con,"update fines set Paid='1' where Loan_id='$loanid_new'");
                                        if($resultpay && $resultpay_new)
                                        {
                                            echo "<h4 style='color:green;'>Fine payment done</h4>";
                                        }
                                        else
                                        {
                                            echo "<h4 style='color:red;'>Error in fine payment</h4>";
                                        }
                                    }

                                }
          else
        {
     
         Display();
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
