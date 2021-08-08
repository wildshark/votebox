<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v5.2.0, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v5.2.0, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo5.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title><?=$template["header"]?></title>
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/socicon/css/styles.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/dist/sweetalert2.all.min.js"></script>
</head>
<body>
  
  <section class="team1 cid-sE0oMEIuzD" id="team1-1">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2">
                    <strong><?=$label['title']?></strong></h3>
                
            </div>
              <?php
                  foreach ($presidential_candidate as $r){
                    $photo = $r['photo'];
                    $name = $r['presidential_name'];
                    $candidate =$r['presidential_id'];
                    $election = $r['election_id'];
                    $model = uniqid();
                    $post = array(
                      "election" =>$election,
                      "candidate_hold"=>$candidate,
                      "voter_hold"=>$GLOBALS['voter_id']
                    );

                    $url = http_build_query($post);

                    echo "
                      <div class='col-sm-6 col-lg-4'>
                        <div class='card-wrap'>
                            <div class='image-wrap'>
                              <a href='#' id='my{$model}'>  
                                <img src='{$photo}' style='width:499px;height:499px;'>
                              </a>  
                            </div>
                            <div class='content-wrap'>
                                <h5 class='mbr-section-title card-title mbr-fonts-style align-center m-0 display-5'>
                                    <strong>{$name}</strong>
                                </h5>
                                <h6 class='mbr-role mbr-fonts-style align-center mb-3 display-4'>
                                    <!--strong>Programmer</strong-->
                                </h6>
                            </div>
                        </div>
                    </div>
      
                      <script>
                        $('#my{$model}').on('click',function(){
                          Swal.fire({
                              title: 'Are you sure?',
                              text: 'Do you want to vote for {$name}',
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonText: 'Yes, Vote!',
                              cancelButtonText: 'No, Cancel vote'
                            }).then((result) => {
                              if (result.isConfirmed) {
                                location.replace('?_vote=cast-vote&{$url}')
                                // For more information about handling dismissals please visit
                                // https://sweetalert2.github.io/#handling-dismissals
                              } else if (result.dismiss === Swal.DismissReason.cancel) {
                                exit;
                              }
                          })
                        })
                    </script>
                    ";
                  }
              
              ?>           
        </div>  
    </div>
</section>
<section style="background-color: #fff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Helvetica Neue', Arial, sans-serif; color:#aaa; font-size:12px; padding: 0; align-items: center; display: flex;"><a href="https://mobirise.site/a" style="flex: 1 1; height: 3rem; padding-left: 1rem;"></a><p style="flex: 0 0 auto; margin:0; padding-right:1rem;">Designed with Mobirise - <a href="https://mobirise.site/l" style="color:#aaa;">Click for more</a></p></section>
  <script src="assets/web/assets/jquery/jquery.min.js"></script>  
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script> 
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>  
  <script src="assets/smoothscroll/smooth-scroll.js"></script>  
  <script src="assets/theme/js/script.js"></script>
</body>
</html>


