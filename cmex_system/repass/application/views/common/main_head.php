<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" <?php if($system=="f") echo "style='margin-left:0px !important'"; ?> >
  <?php //echo "system : ".$system; ?>
  <?php //echo "method : ".$method; ?>
  <?php //echo "session : ".$session_username; ?>
  
    <!--  Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2"><br><br>
          <div class="col-12">
            <div class="row">
              <div class="col-6"><h1 class="m-0 text-dark"><?php echo $head_title; ?></h1></div>
              <div class="col-6" style="text-align: right;">
                <?php if($system=="f"){ ?>
                  <?php if($method=="view"){ ?>
                  <a href="<?php echo base_url(); ?>Login"> <span class="badge badge-pill badge-info"><i class="nav-icon fas fa-user"></i> Login</span></a>
                  <!-- <button type="button" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-user"></i> Login</button> -->
                <?php }} ?>
              </div>
            </div>
          </div><br><br><!-- /.col -->
          <div class="col-12">
            <?php echo $breadcrumb; ?>
            <!--<ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>-->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->