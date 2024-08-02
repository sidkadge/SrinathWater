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
                            <form id="addstaff">
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
                                                <?php foreach ($tanker as $tank): ?>
                                                <option value="<?= $tank->id ?>"
                                                    data-tankernumber="<?= $tank->Tankernumber ?>"
                                                    data-watertype="<?= $tank->WaterType ?>"
                                                    data-size="<?= $tank->Size ?>" data-price="<?= $tank->price ?>">
                                                    <?= $tank->Size ?> ltr
                                                </option>
                                                <?php endforeach; ?>
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
                                            <input type="text" class="form-control" id="cost" name="cost" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input id="address" type="tel" class="form-control"
                                                placeholder="Enter address " name="address" tabindex="1" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="attachment">Attachment</label>
                                            <input type="file" class="form-control" id="attachment" name="attachment">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                        <label for="attachment">Export</label><br>
                                            <button type="submit" class="btn btn-primary">Export</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
    $('#addstaff').validate({
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

    // Update cost based on selected tanker, water type, and refill quantity
    $('#tankerNumber, #waterType, #refillQuantity').change(function() {
        var tankerNumber = $('#tankerNumber').val();
        var waterType = $('#waterType').val();
        var refillQuantityId = $('#refillQuantity').val();

        if (tankerNumber && waterType && refillQuantityId) {
            var selectedOption = $('#refillQuantity option:selected');
            var selectedTankerNumber = selectedOption.data('tankernumber');
            var selectedWaterType = selectedOption.data('watertype');
            var selectedSize = selectedOption.data('size');
            var selectedPrice = selectedOption.data('price');

            if (selectedTankerNumber === tankerNumber && selectedWaterType === waterType) {
                $('#cost').val(selectedPrice);
            } else {
                $('#cost').val('');
            }
        } else {
            $('#cost').val('');
        }
    });
});
</script>

<style>
.form-group label {
    color: black;
    font-size: 15px;
    padding-left: 4px;
}
</style>