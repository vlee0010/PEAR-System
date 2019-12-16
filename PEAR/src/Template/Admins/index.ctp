<?php
$this->layout = 'default-staff';
//$this->layout = false;
?>



<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-12">

        <div class="card card-stats">

            <div class="card-header card-header-warning card-header-icon">

                <div class="card-icon">

                    <i class="material-icons">accessibility</i>

                </div>

                <p class="card-category">Number of Users</p>

                <h3 class="card-title"><?= $userCount;?></h3>

            </div>

            <div class="card-footer">

                <div class="stats">

                    <i class="material-icons text-gray">refresh</i>

                    <a href="#pablo" class="text-gray">Last update <?= date('H:m:s');?></a>

                </div>

            </div>

        </div>

    </div>

<!--    2nd card-->
    <div class="col-lg-6 col-md-6 col-sm-12">

        <div class="card card-stats">

            <div class="card-header card-header-icon card-header-success">

                <div class="card-icon">

                    <i class="material-icons">insert_drive_file</i>
                </div>

                <p class="card-category">Number of Peer Review</p>

                <h3 class="card-title"><?= $peerCount;?></h3>

            </div>

            <div class="card-footer">

                <div class="stats">

                    <i class="material-icons text-gray">refresh</i>

                    <a href="#pablo" class="text-gray">Last update <?= date('H:m:s');?></a>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const dashboardTab = document.querySelector('#dashboard');
    dashboardTab.classList.add('active');
</script>
