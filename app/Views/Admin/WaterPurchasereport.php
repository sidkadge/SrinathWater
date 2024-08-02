<?php include __DIR__.'/../Admin/header.php'; ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Water Purchase Records</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (empty($waterreport)): ?>
                                    <p>No orders Delivered.</p>
                                <?php else: ?>
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Refill Center</th>
                                                <th>Tanker Number</th>
                                                <th>Water Type</th>
                                                <th>Refill Quantity (ltr)</th>
                                                <th>Size</th>
                                                <th>Purchase Date</th>
                                                <th>Purchase Time</th>
                                                <th>Cost</th>
                                               
                                                <th>Attachment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $rowNumber = 1;
                                                foreach ($waterreport as $row): 
                                            ?>
                                            <tr>
                                                <td><?php echo $rowNumber++; ?></td>
                                                <td><?php echo $row->Water_refill; ?></td> <!-- Displaying the Water_refill -->
                                                <td><?php echo $row->tankerNumber; ?></td>
                                                <td><?php echo $row->waterType; ?></td>
                                                <td><?php echo $row->refillQuantity; ?></td>
                                                <td><?php echo $row->Size; ?></td>
                                                <td><?php echo $row->deliveryDate; ?></td>
                                                <td><?php echo $row->deliveryTime; ?></td>
                                                <td><?php echo $row->cost; ?></td>
                                               
                                                <td>
                                                    <a href="<?php echo base_url('public/uploads/purchasebill/' . $row->attachment); ?>" target="_blank">
                                                        <button class="btn btn-primary btn-sm">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </a>
                                                </td>
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
