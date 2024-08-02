<?php include __DIR__.'/../Admin/header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Water refill  Point <small></small></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?php echo base_url(); ?>addwaterreffilpoint" method="post" id="Water_reffil">
                            <div class="row card-body">
                                <input type="hidden" name="id" class="form-control" id="id" value="<?php if(!empty($single_data)){ echo $single_data->id;} ?>">

                                <div class="col-lg-12 col-md-3 col-12 form-group">
                                    <label for="Water_refill">Enter Water refill Point</label>
                                    <input type="text" name="Water_refill" class="form-control" id="Water_refill" placeholder="Enter Water refill Point" value="<?php if(!empty($single_data)){ echo $single_data->menu_name; } ?>">
                                </div>
                                <div class="col-lg-12 col-md-3 col-12 form-group">
                                    <label for="Google_location">Google Location</label>
                                    <input type="text" name="Google_location" class="form-control" id="Google_location" placeholder="Enter Google location" value="<?php if(!empty($single_data)){ echo $single_data->url_location; } ?>">
                                    <span id="menu_nameError" style="color: red;"></span>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer text-right">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary submitButton"><?php if(!empty($single_data)){ echo 'Update'; }else{ echo 'Submit';} ?></button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__.'/../Admin/footer.php'; ?>
