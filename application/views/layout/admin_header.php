<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>问卷调查管理平台</title>
    <link href="<?php echo base_url('admin_dir/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('admin_dir/css/style.css')?>" rel="stylesheet">
  </head>
  <body>
    
<div id="loading-block"></div>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <div class="nav-collapse">
        <?php if ($this->session->userdata('auth') != null) { ?>
          <ul class="nav pull-right">
            <li><a href="<?php echo base_url() ?>">返回首页</a></li>
            <li><a href="<?php echo base_url('admin/logout') ?>">退出</a></li>

          </ul>
        <?php } ?>
        <form class="navbar-search pull-right form-search">
          <div class="input-append">
            <input type="text" class="span2 search-query" id="input_search" placeholder="搜索关键字">
            <button type="submit" class="btn">搜索</button>
          </div>
        </form>

        

        <ul class="nav">
          <li class="active current_link"><a href="<?php echo base_url('admin') ?>">@问卷调查管理平台</a></li>
        </ul>

      </div>
    </div>
  </div>
</div>