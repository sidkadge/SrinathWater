<?php include __DIR__.'/../Admin/header.php'; ?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Allot Partner</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php if (empty($order)): ?>
                                    <p>No orders booked.</p>
                                <?php else: ?>
                                    <table class="table table-striped table-hover" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Customer Name</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Address</th>
                                                <th>Tankers</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $rowNumber = 1;
                                                foreach ($order as $row): 
                                            ?>
                                            <tr>
                                                <td><?php echo $rowNumber++; ?></td>
                                                <td><?php echo $row->full_name; ?></td>
                                                <td><?php echo $row->WaterType; ?></td>
                                                <td><?php echo $row->Size; ?></td>
                                                <td><?php echo $row->Price; ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary view-address" data-address="<?php echo $row->Address; ?>" data-toggle="modal" data-target="#addressModal">
                                                        View Address
                                                    </button>
                                                </td>
                                                <td>
                                                    <select class="form-control">
                                                        <?php if (!empty($row->tankers)): ?>
                                                            <?php foreach ($row->tankers as $tanker): ?>
                                                                
                                                                <option value="<?php echo $tanker->Tankernumber; ?>"><?php echo $tanker->Tankernumber; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <option>No tankers available</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </td>
                                                <td> <button type="button" class="btn btn-primary">
                                                       submit
                                                    </button></td>
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

<!-- Modal Structure -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalAddress"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__.'/../Admin/footer.php'; ?>

<script>
$(document).ready(function() {
    $('.view-address').on('click', function() {
        var address = $(this).data('address');
        $('#modalAddress').text(address);
    });
});
</script>
