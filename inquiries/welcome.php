<?php
include('../config.php');

// Create connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT  DISTINCT agent_location AS value,agent_location AS label FROM agent ORDER BY agent_location ASC";
$result = $conn->query($sql);
$conn->close();
$location = null;
$platform = null;
if (!empty($_REQUEST['location'])) {
  $location = strtolower($_REQUEST['location']);
}

if (!empty($_REQUEST['platform'])) {
  $platform = strtolower($_REQUEST['platform']);
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome to WonderSpace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="styles.css">
</head>

<body class="page-wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
          <a class="navbar-brand" href="https://www.wonderfest.my/">
            <img class="img-responsive" src="images/WS_logo.png">
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
       
        <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
             <li class="nav-item">
              <a class="nav-link " aria-current="page" href="https://leads.gfgproperty.com/home">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="https://leads.gfgproperty.com/agent">Agent</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Inquiry</a>
            </li>
           
          </ul>
          
        </div> -->
      </div>
    </nav> 

  <div class="container">
    
    <div class="row main_row">
      <div class="col-sm-2 col-lg-2"></div>
      <div class="col-sm-12 col-lg-12">
        <p><h3>Hi please fill this WhatsApp form <br> and our WonderTeam will be in touch .</h3></p>
        <!-- <form method="post" action="http://localhost/shah/leads/join.wonderspace.asia/inquiry/add"> -->
          <form method="post" action="https://join.wonderspace.asia/inquiry/add">
          <input type="hidden" name="platform" value="<?php echo $platform?>">
          <div>
            <div class="mb-3 row">
              <label for="prospect_name" class="col-sm-2 col-md-2 col-form-label">Your Name:</label>
              <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" id="prospect_name" name="prospect_name" value="" required>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="prospect_phone" class="col-sm-2 col-md-2 col-form-label">Contact Number:</label>
              <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" id="prospect_phone" name="prospect_phone" required>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="prospect_name" class="col-sm-2 col-md-2 col-form-label">Event Date:</label>
              <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" id="event_date" name="event_date" value="" required>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="prospect_name" class="col-sm-2 col-md-2 col-form-label">Event Venue:</label>
              <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" id="event_venue" name="event_venue" value="" required>
              </div>
            </div>


              <div class="mb-3 row">
              <label for="prospect_name" class="col-sm-2 col-md-2 col-form-label">Number of Pax:</label>
              <div class="col-sm-4 col-md-4">
                <input type="text" class="form-control" id="total_pax" name="total_pax" value="" required>
              </div>
            </div>

          <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-2 col-md-2 col-form-label">Event Space:</label>
              <div class="col-sm-4 col-md-4">
                <select required="" class="form-select" aria-label="Default select example" name="event_type" id="event_type">
                  <option value="G Glass House @ Klang">G Glass House @ Klang</option>
                  <option value="Lena Hall @ Kajang">Lena Hall @ Kajang</option>
                  <option value="Lilla Rainforest Retreat @ Hulu Langat">Lilla Rainforest Retreat @ Hulu Langat</option>
                </select>
              </div>
            </div>


            <!-- <div class="mb-3 row">
              <label for="inputPassword" class="col-sm-2 col-md-2 col-form-label">Your Budget:</label>
              <div class="col-sm-4 col-md-4" data-tip="min spending Rm2999">
                 <input type="text" title="min spending Rm2999" class="form-control" id="budget" name="budget" placeholder="min spending Rm2999" value="" required>
              </div>
            </div> -->



            <div class="mb-2 row">
              <label for="inputPassword" class="col-sm-2 col-md-2 col-form-label"></label>
              <div class="col-sm-4"><button type="submit" class="btn btn-primary">Submit</button>

              </div>
            </div>
          </div>

          <input id="ctrl-datetime" value="<?php echo date("Y-m-d H:i:s") ?>" type="hidden" placeholder="Enter Datetime" required="" name="datetime" class="form-control " />
          <input id="ctrl-assign_agent_name" value="" type="hidden" placeholder="Enter Assign Agent Name" name="assign_agent_name" class="form-control " />
          <input id="ctrl-assign_agent_phone" value="" type="hidden" placeholder="Enter Assign Agent Phone" name="assign_agent_phone" class="form-control " />


        </form><br>
         <p class=""><b>Thank you and awesomeness is on your way!</b></p>
      </div>

      <div class="mobile_img">
        <img src="./images/GFG_Lead_Portal_mobile_bg.jpg" alt="">
      </div>

    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <!--   <script src="main.js"></script> -->
</body>
 

</html>
