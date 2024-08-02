<?php include __DIR__.'/../Admin/header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Tankers</h3>
                            
                        </div>
                        <div class="col-lg-12 text-right">
                                    <button type="button" id="add-row" class="btn btn-success">Add Row</button>
                                </div>
                        <form action="<?php echo base_url(); ?>add_tankersbyadmin" id="add_product" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div id="product-rows">
                                    <div class="row product-row">
                                        <input type="hidden" name="id[]" class="form-control" value="<?php if(!empty($single_data)){ echo $single_data->id;} ?>">
                                        <div class="col-lg-3">
                                            <label for="Tankernumber">Tanker Number</label>
                                            <input type="text" name="Tankernumber[]" class="form-control" placeholder="Enter Tanker number" value="<?php if(!empty($single_data)){ echo $single_data->Tankernumber; } ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="WaterType">Water Type</label>
                                            <div class="input-group">
                                                <select class="form-control" name="WaterType[]">
                                                    <option value="Drinking">Drinking</option>
                                                    <option value="Washing Water">Washing </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="Size">Litter</label>
                                            <input type="text" name="Size[]" class="form-control" placeholder="Size" value="<?php if(!empty($single_data)){ echo $single_data->Size; } ?>">
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="quantity">Quantity</label>
                                            <div class="input-group">
                                                <select class="form-control" name="unit[]">
                                               
                                                    <option value="ltr">ltr</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="price">Price per Tanker</label>
                                            <input type="text" name="price[]" class="form-control" placeholder="Enter Price" value="<?php if(!empty($single_data)){ echo $single_data->price; } ?>">
                                        </div>
                                        <div class="col-lg-1 mt-2">
                                            <button type="button" class="btn btn-danger remove-row mt-4">X</button>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary submitButton">
                                    <?php if(!empty($single_data)){ echo 'Update'; } else { echo 'Submit'; } ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include __DIR__.'/../Admin/footer.php'; ?>

<script>
    $(document).ready(function() {
        $('#add_product').validate({
            rules: {
                'Tankernumber[]': { required: true },
                'Size[]': { required: true },
                'WaterType[]': { required: true },
                'unit[]': { required: true },
                'price[]': { required: true, number: true },
            },
            messages: {
                'Tankernumber[]': { required: 'Please enter the Tanker number.' },
                'Size[]': { required: 'Please enter litter.' },
                'WaterType[]': { required: 'Please select water Type.' },
                'unit[]': { required: 'Select a unit.' },
                'price[]': { required: 'Please enter the price.', number: 'Please enter a valid number.' },
            }
        });

        // Add new row
        $('#add-row').click(function() {
            var newRow = $('.product-row:first').clone();
            newRow.find('input').val('');
            $('#product-rows').append(newRow);
        });

        // Remove row
        $(document).on('click', '.remove-row', function() {
            if ($('.product-row').length > 1) {
                $(this).closest('.product-row').remove();
            } else {
                alert("At least one row is required.");
            }
        });
    });
</script>
