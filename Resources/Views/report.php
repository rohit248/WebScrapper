<?php
    require('Components/header.php');
?>


<main class="px-3">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <form action="/domain/submit" method="POST">
                <p class="lead">
                        <input type="url" class="form-control" id="url" name="url" aria-describedby="urlHelp" required>
                        <div id="urlHelp" class="form-text text-danger">
                        </div>
                    <button type="submit" href="#" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Scrap Now</button>
                </p>
            </form>
        </div>
    </div>
   
</main>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="col-12 mt-4">
            <div class="card rounded">
                <div class="card-header custom-btn-color text-black text-left">
                    <h3><?php echo "Report of URL ".$report_details['domain']; ?></h3>
                </div>
                <div class="card-body text-black">
                    <div class="row mb-4 text-align-left">
                        <h6>DOMAIN INFO</h6>
                        <hr>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-thin fa-at"></i> Domain : <b><?php echo $report_details['domain'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-brands fa-codepen"></i> HTML Tag Count :<b><?php echo $report_details['domain_data']['html_tag_count'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-shield-halved"></i> Scheme : <b><?php echo $report_details['domain_data']['info']['scheme'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-globe"></i> Local IP : <b><?php echo $report_details['domain_data']['info']['local_ip'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-globe"></i> Primary IP : <b><?php echo $report_details['domain_data']['info']['primary_ip'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-globe"></i> Local Port : <b><?php echo $report_details['domain_data']['info']['local_port'];?></b>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-scale-balanced"></i> Size Downloaded : <b><?php echo $report_details['domain_data']['info']['size_download'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-scale-balanced"></i> Header Size : <b><?php echo $report_details['domain_data']['info']['header_size'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-scale-balanced"></i> Request Size : <b><?php echo $report_details['domain_data']['info']['request_size'];?></b>
                        </div>
                    </div>
                    <div class="row mb-3 text-align-left">
                        <h6>REQUEST INFO</h6>
                        <hr>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-thin fa-at"></i> Content Type : <b><?php echo $report_details['domain_data']['info']['content_type'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-scale-balanced"></i> Header Size :<b><?php echo $report_details['domain_data']['info']['header_size'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-shield-halved"></i> HTTP Code : <b><?php echo $report_details['domain_data']['info']['http_code'];?></b>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-shield-halved"></i> HTTP Version : <b><?php echo $report_details['domain_data']['info']['http_version'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-shield-halved"></i> Protocol : <b><?php echo $report_details['domain_data']['info']['protocol'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-globe"></i> Primary Port : <b><?php echo $report_details['domain_data']['info']['primary_port'];?></b>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-stopwatch"></i> Total Time :<b><?php echo $report_details['domain_data']['info']['total_time'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-stopwatch"></i> Connect Time : <b><?php echo $report_details['domain_data']['info']['connect_time'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-stopwatch"></i> Pretransfer Time :<b><?php echo $report_details['domain_data']['info']['pretransfer_time'];?></b>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-stopwatch"></i> Namelookup Time : <b><?php echo $report_details['domain_data']['info']['namelookup_time'];?></b>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <i class="fa-solid fa-stopwatch"></i> Start Transfer Time : <b><?php echo $report_details['domain_data']['info']['starttransfer_time'];?></b>
                        </div>
                    </div>
                    <div class="row mb-4 text-align-left">
                        <h6>RESPONSE HEADERS</h6>
                        <hr>
                        <?php
                            foreach ($report_details['domain_data']['header'] as $key => $value) {
                                $htmlStaring  = '<div class="col-md-4 col-sm-12">';
                                $htmlStaring .= '<i class="fa-solid fa-circle-info"></i> '.$key.' : <b>'.$value.'</b></div>';
                                echo $htmlStaring;
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require('Components/footer.php');
?>         