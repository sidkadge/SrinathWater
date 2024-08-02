<?php include __DIR__.'/../Admin/header.php'; ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Fuel Purchase Records</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (empty($fuelbill)): ?>
                                    <p>No fuel bills found.</p>
                                <?php else: ?>
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanker Number</th>
                                                <th>Refill Date</th>
                                                <th>Refill Time</th>
                                                <th>Cost</th>
                                                <th>Fuel Quantity</th>
                                                <th>Attachment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $rowNumber = 1;
                                                foreach ($fuelbill as $row): 
                                            ?>
                                            <tr>
                                                <td><?php echo $rowNumber++; ?></td>
                                                <td><?php echo $row->tankerNumber; ?></td>
                                                <td><?php echo $row->refillDate; ?></td>
                                                <td><?php echo $row->refillTime; ?></td>
                                                <td><?php echo $row->cost; ?></td>
                                                <td><?php echo $row->Fual; ?></td>
                                                
                                                <td>
                                                    <a href="<?php echo base_url('public/uploads/fuelbill/' . $row->attachment); ?>" target="_blank">
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
