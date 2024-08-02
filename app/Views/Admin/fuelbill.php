<?php include __DIR__.'/../Admin/header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Fuel Bill<small></small></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>fuelbilling" id="Purchase" method="post" enctype="multipart/form-data">
                                <div class="row">
                                   
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="tankerNumber">Tanker Number</label>
                                            <select class="form-control" id="tankerNumber" name="tankerNumber">
                                                <option value="">Select Tanker Number</option>
                                                <?php
                                                $uniqueTankers = [];
                                                foreach ($tanker as $tank):
                                                    if (!in_array($tank->Tankernumber, $uniqueTankers)) {
                                                        $uniqueTankers[] = $tank->Tankernumber;
                                                ?>
                                                <option value="<?= $tank->Tankernumber ?>"><?= $tank->Tankernumber ?>
                                                </option>
                                                <?php } endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="refillDate">Date</label>
                                            <input type="date" class="form-control" id="refillDate"
                                                name="refillDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="refillTime">Time</label>
                                            <input type="time" class="form-control" id="refillTime"
                                                name="refillTime">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="cost">Cost</label>
                                            <input type="text" class="form-control" id="cost" name="cost">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="Fual">Fuel(ltr)</label>
                                            <input id="Fual" type="text" class="form-control"
                                                placeholder="Enter fuel leters " name="Fual" tabindex="1" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="attachment">Attachment(Fuel receipt)</label>
                                            <input type="file" class="form-control" id="attachment" name="attachment">
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <!-- <div class="form-group">
                                            <label for="attachment">Attachment(Fuel receipt)</label>
                                            <input type="file" class="form-control" id="attachment" name="attachment">
                                        </div> -->
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                        <label for="attachment">Submit</label><br>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6"></div>
        </div>
</div>
</section>
</div>

<?php include __DIR__.'/../Admin/footer.php'; ?>

<script>
$(document).ready(function() {
    $('#Purchase').validate({
        rules: {
            refillCenter: {
                required: true,
            },
            tankerNumber: {
                required: true,
            },
            waterType: {
                required: true,
            },
            cost: {
                required: true,
            },
            refillQuantity: {
                required: true,
            },
            refillDate: {
                required: true,
            },
            refillTime: {
                required: true,
            },
            Fual: {
                required: true,
            },
            attachment: {
                required: true,
            }
        },
        messages: {
            refillCenter: {
                required: 'Please select a refill center.',
            },
            tankerNumber: {
                required: 'Please select a tanker number.',
            },
            waterType: {
                required: 'Please select a water type.',
            },
            cost: {
                required: 'Please insert correct ammount.',
            },
            refillQuantity: {
                required: 'Please select a refill quantity.',
            },
            refillDate: {
                required: 'Please select a delivery date.',
            },
            refillTime: {
                required: 'Please select a delivery time.',
            },
            Fual: {
                required: 'Please enter an fuel In Leters.',
            },
            attachment: {
                required: 'Please attach a file.',
            }
        }
    });
});
</script>

<style>
.form-group span {
    color: red;
    font-size: 15px;
    padding-left: 4px;
}
</style>
