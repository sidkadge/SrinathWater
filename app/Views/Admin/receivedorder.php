<?php include __DIR__.'/../Admin/header.php'; ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Received Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (empty($orders)): ?>
                                <p>No orders booked.</p>
                                <?php else: ?>
                                <table class="table table-striped table-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Customer Name</th>
                                            <th>Water Type</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Delivery Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                                $rowNumber = 1;
                                                // Sort orders by delivery date in descending order
                                               
                                                foreach ($orders as $row): 
                                            ?>
                                        <tr>
                                            <td><?php echo $rowNumber++; ?></td>
                                            <td><?php echo $row->full_name; ?></td>
                                            <td><?php echo $row->WaterType; ?></td>
                                            <td><?php echo $row->Size; ?>ltr</td>
                                            <td><?php echo $row->Price; ?></td>
                                            <td><?php echo $row->deliverydate; ?></td>



                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include __DIR__.'/../Admin/footer.php'; ?>