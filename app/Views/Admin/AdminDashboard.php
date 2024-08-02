<?php 
include __DIR__.'/../Admin/header.php'; 

// Fetch today's date
$today = date('Y-m-d');
?>

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Orders</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Name</th>
                                        <th>Contact Number</th>
                                        <th>Alternate Name</th>
                                        <th>Delivery Date</th>
                                        <th>Alternate Number</th>
                                        <th>Address</th>
                                        <th>Water Type</th>
                                        <th>Size</th>
                                        <th>Order Status</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($order)) { 
                                        $i = 1; 
                                        foreach ($order as $data) { 
                                            // Compare delivery date with today's date
                                            $order_status = '';
                                            if ($data->deliverydate < $today) {
                                                $order_status = 'Not Delivered';
                                            } else {
                                                $order_status = 'Pending';
                                            }
                                    ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $data->full_name; ?></td>
                                        <td><?= $data->mobile_no; ?></td>
                                        <td><?= $data->Alternate_name; ?></td>
                                        <td><?= $data->deliverydate; ?></td>
                                        <td><?= $data->Alternatenumber; ?></td>
                                        <td><button type="button" class="btn btn-primary" onclick="showAddressModal('<?= $data->Address; ?>')">Address</button></td>
                                        <td><?= $data->WaterType; ?></td>
                                        <td><?= $data->Size; ?>ltr</td>
                                        <td><?= $order_status; ?></td>
                                        <td><?= $data->Price; ?></td>
                                    </tr>
                                    <?php 
                                            $i++;
                                        } 
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Structure -->
<div class="modal" id="addressModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Address</h4>
                <!-- <button type="button" class="close" data-dismiss="modal">&times;"></button> -->
            </div>
            <div class="modal-body">
                <p id="modalAddressContent"></p>
            </div>
            <div class="modal-footer">
                <a id="newTabLink" href="" target="_blank" class="btn btn-primary">Map</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showAddressModal(address) {
        document.getElementById('modalAddressContent').textContent = address;
        document.getElementById('newTabLink').href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(address);
        $('#addressModal').modal('show');
    }
</script>

<?php include __DIR__.'/../Admin/footer.php'; ?>
