<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   <style>
       .controls-top{
           text-align: center;
       }
       
   </style>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container my-5">
  
       <button></button>
    
      <hr class="my-5">
    
      <!--Carousel Wrapper-->
      <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
    
        <!--Controls-->
        <div class="controls-top">
            <a class="btn btn-primary" href="#multi-item-example" data-slide="prev" ><i class='bx bx-left-arrow-alt'></i></a>
            <a class="btn btn-primary" href="#multi-item-example" data-slide="next" ><i class='bx bx-right-arrow-alt'></i></a>
         
        </div>
        <!--/.Controls-->
    
        <!--Indicators-->
        <ol class="carousel-indicators">
          <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
          <li data-target="#multi-item-example" data-slide-to="1"></li>
          <li data-target="#multi-item-example" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->
    
        <!--Slides-->
        <div class="carousel-inner" role="listbox">
    
          <!--First slide-->
          <?php
			    include 'index.php';
			    require_once('authentication.php');
			    error_reporting(0);
			    if(! ($_SESSION['username'])){
			       header('Location : index.html');
			    }
			    $username = $_SESSION['username'];
			    $output;
                    while ($row = mysqli_fetch_assoc($result)){             
                        
                        $sql = "select type from type where typeId = '$row[playertype]'";
                        $typeresult = mysqli_query($con,$sql);
                        while($id = mysqli_fetch_assoc($typeresult)){
                            $typename = $id['type'];
                        }
                        $sql = "select countryname from country where countryId = '$row[playercountry]'";
                        $countryresult = mysqli_query($con,$sql);
                        while($country = mysqli_fetch_assoc($countryresult)){
                            $countryname = $country['countryname'];
                        }
                        
                        $output = "
                            <div class='card mb-2'>
                                <img class='card-img-top' src='https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(34).jpg'
                                alt='Card image cap'>
                                <div class='card-body'>
                                <h3 class='mt-2'>.$row[playername].</h3>
                                <span class='mt-1 clearfix'> .$typename.</span>
                                <span class='mt-1 clearfix'> .$countryname.</span>
                                <div class='row mt-3 mb-3'>
                                    <div class='col-md-4'>
                                        <h5>Cost</h5>
                                        <span class='num'> $row[playercost]</span>
                                    </div>
                                    <div class='col-md-4'>
                                        <h5>Rating</h5>
                                        <span class='num'> $row[playerrating]</span>
                                    </div>
                                    <div class='col-md-4'>
                                        <h5>Score</h5>
                                        <span class='num'> $row[playerscore]</span>
                                    </div>
                                </div>
                                <a class='btn btn-primary' id='buy-btn'>Buy Player</a>
                            </div>
                        ";
                        return ($ouput);        
                    }    
                //$countryname = 'Default';
			    ?>
            
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <?php echo make_slides() ?>                    </div>
                </div>
        </div>
        <!--/.Slides-->
    
      </div>
      <!--/.Carousel Wrapper-->
    
    
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>


<!--
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(18).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Nature/4-col/img%20(35).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
          /.First slide-->
    
          <!--Second slide
          <div class="carousel-item">
    
            <div class="row">
              <div class="col-md-4">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(60).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(47).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/City/4-col/img%20(48).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
          </.Second slide
    
          Third slide
          <div class="carousel-item">
    
            <div class="row">
              <div class="col-md-4">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(53).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(45).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 clearfix d-none d-md-block">
                <div class="card mb-2">
                  <img class="card-img-top" src="https://mdbootstrap.com/img/Photos/Horizontal/Food/4-col/img%20(51).jpg"
                       alt="Card image cap">
                  <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                      card's content.</p>
                    <a class="btn btn-primary">Button</a>
                  </div>
                </div>
              </div>
            </div>
    
          </div>
          !--/.Third slide-->
        