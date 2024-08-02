<?php include __DIR__.'/../Admin/header.php'; ?>
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Purchase Bill<small></small></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo base_url(); ?>Purchasebilling" id="Purchase" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="refillCenter">Refill Center</label>
                                            <select class="form-control" id="refillCenter" name="refillCenter">
                                                <option value="">Select Refill Center</option>
                                                <?php foreach ($refillpoint as $point): ?>
                                                <option value="<?= $point->id ?>"><?= $point->Water_refill ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
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
                                            <label for="waterType">Water Type</label>
                                            <select class="form-control" id="waterType" name="waterType">
                                                <option value="">Select Water Type</option>
                                                <?php
                                                $waterTypes = array_unique(array_column($tanker, 'WaterType'));
                                                foreach ($waterTypes as $type): ?>
                                                <option value="<?= $type ?>"><?= $type ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="refillQuantity">Refill Quantity (ltr)</label>
                                            <select class="form-control" id="refillQuantity" name="refillQuantity">
                                                <option value="">Select Refill Quantity</option>
                                                <?php
                                                $uniqueSizes = [];
                                                foreach ($tanker as $tank):
                                                    if (!in_array($tank->Size, $uniqueSizes)) {
                                                        $uniqueSizes[] = $tank->Size;
                                                ?>
                                                <option value="<?= $tank->id ?>"
                                                    data-tankernumber="<?= $tank->Tankernumber ?>"
                                                    data-watertype="<?= $tank->WaterType ?>"
                                                    data-size="<?= $tank->Size ?>" data-price="<?= $tank->price ?>">
                                                    <?= $tank->Size ?> ltr
                                                </option>
                                                <?php } endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="deliveryDate">Date</label>
                                            <input type="date" class="form-control" id="deliveryDate"
                                                name="deliveryDate">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="deliveryTime">Time</label>
                                            <input type="time" class="form-control" id="deliveryTime"
                                                name="deliveryTime">
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
                                    <!-- <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input id="address" type="text" class="form-control"
                                                placeholder="Enter address " name="address" tabindex="1" required>
                                        </div>
                                    </div> -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="attachment">Attachment</label>
                                            <input type="file" class="form-control" id="attachment" name="attachment">
                                        </div>
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
            cost: {
                required: true,
            },
            waterType: {
                required: true,
            },
            refillQuantity: {
                required: true,
            },
            deliveryDate: {
                required: true,
            },
            deliveryTime: {
                required: true,
            },
            address: {
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
            cost: {
                required: 'Please insert correct ammount.',
            },
            waterType: {
                required: 'Please select a water type.',
            },
            refillQuantity: {
                required: 'Please select a refill quantity.',
            },
            deliveryDate: {
                required: 'Please select a delivery date.',
            },
            deliveryTime: {
                required: 'Please select a delivery time.',
            },
            address: {
                required: 'Please enter an address.',
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
