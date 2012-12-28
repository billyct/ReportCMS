<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>billyct</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('home_dir/css/style.css') ?>">
</head>
<body class="woodTheme">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand">billyct</a>
                <div class="nav-collapse">
                    <ul class="nav pull-right" id="menu">
                        <li class="active">
                            <a href="<?php echo base_url() ?>" data-slide="#about">关于</a>
                        </li>
                        <?php foreach ($topics as $topic) { ?>
                            <li>
                                <a href="<?php echo base_url('topic/'.$topic['id']) ?>" data-slide="#topic<?php echo $topic['id'] ?>">
                                    <?php echo $topic['name'];?>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>