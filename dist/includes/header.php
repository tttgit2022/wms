<?php
//session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
date_default_timezone_set("Asia/Manila"); 
?>
<?php
include('../dist/includes/dbcon.php');

$branch=$_SESSION['branch'];
$query=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error($con));
  $row=mysqli_fetch_array($query);
           $branch_name=$row['branch_name'];
?>

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header" style="padding-left:20px">
              <a href="home.php" class="navbar-brand"><b><i class="glyphicon glyphicon-home"></i> <?php echo $branch_name;?> </b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
				  

                  <!-- Tasks Menu -->
				   <!-- Tasks Menu -->
				   <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="stockin.php">
                      <i class="glyphicon glyphicon-list text-green"></i> Inbound
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                      </li>
               </ul>
                  </li>
                  
                  <!-- Tasks Menu -->
				   <!-- Tasks Menu -->
				   <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="stockout.php">
                      <i class="glyphicon glyphicon-list text-green"></i> Outbound
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                      </li>
               </ul>
                  </li>
                  
                  
                  <li class="">
                
                    <a href="index_pod.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-list-alt"></i>
                      Return / POD
                    </a>
                  </li>
                  
                  <!-- Tasks Menu -->
				   <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-stats text-red"></i> Report
                     
                    </a>
                    <ul class="dropdown-menu">
                     <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                        
                          <li><!-- start notification -->
                            <a href="inventory.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Stock Report
                            </a>
                          </li><!-- end notification -->
						            <li><!-- start notification -->
                         <a href="inward.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Inward Report
                            </a>
                          </li><!-- end notification -->

								<li><!-- start notification -->
                         <a href="outward.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Outward Report
                            </a>
                          </li><!-- end notification -->

					    <li><!-- start notification -->
                         <a href="recieptgrn.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>G.R.N
                            </a>
                          </li><!-- end notification -->
						  <li><!-- start notification -->
                         <a href="recieptgdn.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>G.D.N
                            </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                         <a href="purchase_request.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Purchase Request
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                    </ul>
                  </li>
                  
                  <!-- Tasks Menu -->
				   <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-stats text-red"></i> Lists
                     
                    </a>
                    <ul class="dropdown-menu">
                     <li>
                        <!-- Inner Menu: contains the notifications -->
                        <ul class="menu">
                        
                          <li><!-- start notification -->
                            <a href="index_product.php">
                              <i class="glyphicon glyphicon-ok text-green"></i>Product List
                            </a>
                          </li><!-- end notification -->
						            <li><!-- start notification -->
                         <a href="index_dealer.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Dealer List
                            </a>
                          </li><!-- end notification -->

								<li><!-- start notification -->
                         <a href="index_transporter.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Transporter List
                            </a>
                          </li><!-- end notification -->

					    <li><!-- start notification -->
                         <a href="recieptgrn.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>G.R.N
                            </a>
                          </li><!-- end notification -->
						  <li><!-- start notification -->
                         <a href="recieptgdn.php">
                              <i class="glyphicon glyphicon-th-list text-redr"></i>G.D.N
                            </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                         <a href="purchase_request.php">
                              <i class="glyphicon glyphicon-usd text-blue"></i>Purchase Request
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- Tasks Menu -->
				  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="profile.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-cog text-orange"></i>
                      <?php echo $_SESSION['name'];?>
                    </a>
                  </li>
                  <li class="">
                    <!-- Menu Toggle Button -->
                    <a href="logout.php" class="dropdown-toggle">
                      <i class="glyphicon glyphicon-off text-red"></i> Logout 
                      
                    </a>
                  </li>
                  
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>