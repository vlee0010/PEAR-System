<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
<!--    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">-->
<!--    <link rel="icon" type="image/png" href="../assets/img/favicon.png">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        PEAR Monash
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet" type="text/css"/>

    <!-- CSS Files -->
<!--    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />-->

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


    <?php echo $this->Html->css('material-pro/material-dashboard.css')?>

    <?php echo $this->Html->script('material-pro/core/jquery.min.js');?>

    <?php echo $this->Html->script('material-pro/plugins/moment.min.js');?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.21/moment-timezone-with-data-2012-2022.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<!--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />-->
    <?php echo $this->Html->script('material-pro/plugins/bootstrap-datetimepicker.min.js');?>








</head>


<body class="">
<div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" >
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div style="text-align: center" class="logo">
            <a href="" class="simple-text logo-normal">
                Pear Monash
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item" id="dashboard">
                    <a class="nav-link" href=<?php echo $this->Url->build(
                        [
                            "controller" => "admins",
                            "action" => "index",
                        ]
                    );?>>
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li id="create-unit" class="nav-item">
                    <a id="unit-link" class="nav-link" data-toggle="collapse" href="#unitExpand">
                        <i class="material-icons">queue</i>
                        <p>Units
                        <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="unitExpand">
                        <ul class="nav">
                            <li id="crt" class="nav-item">
                                <?php echo $this->Html->link(
                                    'Create Units',
                                    '/admins/create',
                                    ['class' => 'nav-link']
                                );?>
                            </li>


                            <li id="va" class="nav-item">
                                <?php echo $this->Html->link(
                                    'View All Units',
                                    '/units',
                                    ['class' => 'nav-link']
                                );?>
                            </li>

                        </ul>
                    </div>


                </li>

                <li class="nav-item " id="pr">
                    <a class="nav-link" href=<?php echo $this->Url->build(
                        [
                            "controller" => "admins",
                            "action" => "createPeerReview",
                        ]
                    );?>>
                        <i class="material-icons">content_paste</i>
                        <p>Create Peer Reviews</p>
                    </a>
                </li>


                <li id="assignstafftounit" class="nav-item ">
                    <a class="nav-link" href=<?php echo $this->Url->build(
                        [
                            "controller" => "admins",
                            "action" => "assignStaffToUnit",
                        ]
                    );?>>
                        <i class="material-icons">assignment_ind</i>
                        <p>Assign staff to unit</p>
                    </a>
                </li>

                <li id="cc" class="nav-item ">
                    <a class="nav-link" href=<?php echo $this->Url->build(
                        [
                            "controller" => "admins",
                            "action" => "createClasses",
                        ]
                    );?>>
                        <i class="material-icons">alarm_add</i>
                        <p>Create Classes</p>
                    </a>
                </li>

                <li id="cnq" class="nav-item ">
                    <a class="nav-link" href=<?php echo $this->Url->build(
                        [
                            "controller" => "admins",
                            "action" => "addQuestions",
                        ]
                    );?>>
                        <i class="material-icons">bubble_chart</i>
                        <p>Create Question</p>
                    </a>
                </li>

<!--                <li class="nav-item ">-->
<!--                    <a class="nav-link" href="./typography.html">-->
<!--                        <i class="material-icons">library_books</i>-->
<!--                        <p>Assign To Groups</p>-->
<!--                    </a>-->
<!--                </li>-->

<!--                <li class="nav-item ">-->
<!--                    <a class="nav-link" href="./map.html">-->
<!--                        <i class="material-icons">location_ons</i>-->
<!--                        <p>Maps</p>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item ">-->
<!--                    <a class="nav-link" href="./notifications.html">-->
<!--                        <i class="material-icons">notifications</i>-->
<!--                        <p>Notifications</p>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="nav-item ">-->
<!--                    <a class="nav-link" href="./rtl.html">-->
<!--                        <i class="material-icons">language</i>-->
<!--                        <p>RTL Support</p>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="nav-item active-pro ">
                    <a class="nav-link" href=<?=$this->Url->build(['controller'=>'users','action'=>'logout'])?>>
                        <i class="material-icons">call_received</i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
<!--                    <a class="navbar-brand" href="#pablo">Dashboard</a>-->
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                                <i class="tim-icons icon-single-02"></i><?= "Hello, " . $this->request->session()->read('Auth.User.firstname');?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
<!--                                <a class="dropdown-item" href="#">Profile</a>-->
<!--                                <a class="dropdown-item" href="#">Settings</a>-->
<!--                                <div class="dropdown-divider"></div>-->
                                <a class="dropdown-item" href=<?=$this->Url->build(['controller'=>'users','action'=>'logout'])?>>Log out</a>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="content">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
        <footer class="footer">

        </footer>
    </div>
</div>


<?php echo $this->Html->script('material-pro/core/popper.min.js');?>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js" defer></script>
<!--<script src="../assets/js/core/bootstrap-material-design.min.js"></script>-->
<?php echo $this->Html->script('material-pro/core/bootstrap-material-design.min.js');?>
<!--<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/perfect-scrollbar.jquery.min.js');?>
<!-- Plugin for the momentJs  -->
<!--<script src="../assets/js/plugins/moment.min.js"></script>-->

<!--  Plugin for Sweet Alert -->
<!--<script src="../assets/js/plugins/sweetalert2.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/sweetalert2.js');?>
<!-- Forms Validations Plugin -->
<!--<script src="../assets/js/plugins/jquery.validate.min.js"></script>-->
<?php //echo $this->Html->script('material-pro/plugins/jquery.validate.min.js');?>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard-->
<!--<script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>-->

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<!--<script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/bootstrap-selectpicker.js');?>
<?php echo $this->Html->script('material-pro/plugins/jquery.bootstrap-wizard.js');?>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<!--<script src="../assets/js/plugins/jquery.dataTables.min.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/jquery.dataTables.min.js');?>


<?php echo $this->Html->script('material-pro/plugins/jasny-bootstrap.min.js');?>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<!--<script src="../assets/js/plugins/fullcalendar.min.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/fullcalendar.min.js');?>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>


<!-- Library for adding dinamically elements -->
<!--<script src="../assets/js/plugins/arrive.min.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/arrive.min.js');?>
<!-- Chartist JS -->
<!--<script src="../assets/js/plugins/chartist.min.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/chartist.min.js');?>
<!--  Notifications Plugin    -->
<!--<script src="../assets/js/plugins/bootstrap-notify.js"></script>-->
<?php echo $this->Html->script('material-pro/plugins/bootstrap-notify.js');?>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<!--<script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>-->
<?php echo $this->Html->script('material-pro/material-dashboard.js?v=2.1.1');?>
<script>
    $(document).ready(function() {
        $().ready(function() {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function() {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function() {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });
</script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>


<!--datatable-->


</body>

</html>
