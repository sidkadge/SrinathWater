<?php
// Include header
include __DIR__.'/../Admin/header.php';

// Extract unique WaterTypes
$uniqueWaterTypes = array_unique(array_map(function($tanker) {
    return $tanker->WaterType;
}, $tankers));
?>

<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Order</h3>
                        </div>
                        <div class="card-body">
                            <form id="ordertanker" method="post" action="<?= base_url(); ?>ordertanker">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="first_name">Society/Bulding/Bangalow Name</label>
                                        <input id="first_name" type="text" class="form-control" name="full_name"
                                            autofocus>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="phonenumber">Phone Number</label>
                                        <input id="phonenumber" type="tel" class="form-control" name="mobile_no">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                        <div class="invalid-feedback"></div>
                                    </div> -->

                                </div>
                                <label for="Alternate_name">Contact Person Details</label>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="Alternate_name">Contact Person Name</label>
                                        <input id="Alternate_name" type="text" class="form-control"
                                            name="Alternate_name">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="Alternatenumber">Contact Person Phone Number</label>
                                        <input id="Alternatenumber" type="tel" class="form-control"
                                            name="Alternatenumber">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="Zone">Zone (Area)*</label>
                                        <select id="Zone" class="form-control" name="Zone">
                                            <option value="">Select Zone</option>
                                            <?php foreach ($zones as $zone) : ?>
                                            <option value="<?= $zone->id; ?>"><?= $zone->zone; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="Societyname">Society Name</label>
                                        <select id="Societyname" class="form-control" name="Societyname">
                                            <option value="">Select Society</option>
                                            <!-- Societies will be loaded here based on selected Zone -->
                                            <option value="Other">Other</option>
                                        </select>
                                        <input type="text" id="OtherSocietyname" class="form-control"
                                            name="OtherSocietyname" style="display:none;"
                                            placeholder="Enter Society Name">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="Buildingname">Building Name</label>
                                        <select id="Buildingname" class="form-control" name="Buildingname">
                                            <option value="">Select Building</option>
                                            <!-- Buildings will be loaded here based on selected Society -->
                                            <option value="Other">Other</option>
                                        </select>
                                        <input type="text" id="OtherBuildingname" class="form-control"
                                            name="OtherBuildingname" style="display:none;"
                                            placeholder="Enter Building Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="Address">Address</label>
                                        <input id="Address" type="text" class="form-control" name="Address">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="Delivery_Location">Delivery Location</label>
                                        <input id="Delivery_Location" type="text" class="form-control"
                                            name="Delivery_Location" autofocus>
                                    </div>
                                </div>
                                <!-- New Fields -->
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="WaterType">Water Type</label>
                                        <select id="WaterType" class="form-control" name="WaterType">
                                            <option value="">Select Water Type</option>
                                            <?php foreach ($uniqueWaterTypes as $waterType): ?>
                                            <option value="<?= $waterType ?>"><?= $waterType ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="Size">Size</label>
                                        <select id="Size" class="form-control" name="Size">
                                            <option value="">Select Size</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="Price">Price</label>
                                        <input id="Price" type="text" class="form-control" name="Price" readonly>
                                    </div>


                                    <?php 
                                      $today = date('Y-m-d'); // Get today's date in the format YYYY-MM-DD
?>

                                    <div class="form-group col-6">
                                        <label for="deliverydate">Delivery Date</label>
                                        <input id="deliverydate" type="date" class="form-control" name="deliverydate"
                                            min="<?= $today; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include __DIR__.'/../Admin/footer.php'; ?>

<script>
$(document).ready(function() {
    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter letters only.");

    $.validator.addMethod("mobile", function(value, element) {
        return this.optional(element) || /^\d{10}$/.test(value);
    }, "Please enter a 10 digit mobile number.");

    $.validator.addMethod('customPassword', function(value, element) {
            return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[a-zA-Z\d!@#$%^&*]{8,}$/.test(value);
        },
        'Password must contain at least one uppercase letter, one lowercase letter, one number, and one symbol (!@#$%^&*) and be at least 8 characters long'
    );

    $('#ordertanker').validate({
        rules: {
            full_name: {
                required: true,
                lettersOnly: true
            },
            last_name: {
                required: true,
                lettersOnly: true
            },
            email: {
                required: true,
                email: true
            },
            mobile_no: {
                required: true,
                mobile: true
            },
            Flat: {
                required: true
            },
            Floor: {
                required: true
            },
            Address: {
                required: true
            },
            Delivery_Location: {
                required: true
            },
            password: {
                required: true,
                customPassword: true
            },
            confirm_pass: {
                required: true,
                equalTo: '#password'
            },
            Zone: {
                required: true
            },
            Societyname: {
                required: true
            },
            OtherSocietyname: {
                required: function() {
                    return $('#Societyname').val() === 'Other';
                }
            },
            Buildingname: {
                required: true
            },
            OtherBuildingname: {
                required: function() {
                    return $('#Buildingname').val() === 'Other';
                }
            },
            deliverydate: {
                required: true,
                equalTo: true
            }
        },
        messages: {
            full_name: {
                required: 'Please enter your name.',
                lettersOnly: 'Please enter letters only.'
            },
            last_name: {
                required: 'Please enter your last name.',
                lettersOnly: 'Please enter letters only.'
            },
            email: {
                required: 'Please enter your email address.',
                email: 'Please enter a valid email address.'
            },
            mobile_no: {
                required: 'Please enter your mobile number.',
                mobile: 'Please enter a 10 digit mobile number.'
            },
            Flat: {
                required: 'Please enter your flat number.'
            },
            Floor: {
                required: 'Please enter your floor number.'
            },
            Address: {
                required: 'Please enter your address.'
            },
            Zone: "Please select a zone",
            Societyname: "Please select or enter a society name",
            OtherSocietyname: "Please enter your society name",
            Buildingname: "Please select or enter a building name",
            OtherBuildingname: "Please enter your building name",
            Delivery_Location: {
                required: 'Please enter your google location.'
            },
            password: {
                required: "Password is required.",
                customPassword: "Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long."
            },
            confirm_pass: {
                required: 'Please confirm your password.',
                equalTo: 'Passwords do not match.'
            },
            
            deliverydate: {
                required: 'Please select the date.',
                required: 'select date please.'
            }
        },
        success: function(label, element) {
            $(element).siblings('label.error').hide();
        }
    });

    var tankers = <?= json_encode($tankers) ?>;

    $('#WaterType').change(function() {
        var waterType = $(this).val();
        var sizes = tankers.filter(tanker => tanker.WaterType === waterType);
        var sizeOptions = '<option value="">Select Size</option>';

        sizes.forEach(function(size) {
            sizeOptions += `<option value="${size.Size}">${size.Size} ${size.unit}</option>`;
        });

        $('#Size').html(sizeOptions);
        $('#Price').val('');
    });

    $('#Size').change(function() {
        var waterType = $('#WaterType').val();
        var size = $(this).val();
        var selectedTanker = tankers.find(tanker => tanker.WaterType === waterType && tanker.Size ==
            size);

        if (selectedTanker) {
            $('#Price').val(selectedTanker.price);
        } else {
            $('#Price').val('');
        }
    });
    $(document).ready(function() {
        $('#Zone').change(function() {
            var zoneId = $(this).val();
            if (zoneId) {
                $.ajax({
                    url: '<?= base_url(); ?>getSocietiesByZone',
                    type: 'POST',
                    data: {
                        zone_id: zoneId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#Societyname').html(
                            '<option value="">Select Society</option>');
                        $.each(data, function(key, value) {
                            $('#Societyname').append('<option value="' +
                                value.id + '">' + value.Societyname +
                                '</option>');
                        });
                        $('#Societyname').append(
                            '<option value="Other">Other</option>'
                            ); // Always add "Other" option
                    }
                });
            } else {
                $('#Societyname').html('<option value="">Select Society</option>');
                $('#Societyname').append(
                '<option value="Other">Other</option>'); // Always add "Other" option
            }
        });

        $('#Societyname').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Other') {
                $(this).hide();
                $('#OtherSocietyname').show().attr('required', true);
            } else {
                $('#OtherSocietyname').hide().removeAttr('required');
            }

            var societyId = $(this).val();
            var zoneId = $('#Zone').val();
            if (societyId && zoneId) {
                $.ajax({
                    url: '<?= base_url(); ?>getBuildingsBySociety',
                    type: 'POST',
                    data: {
                        zone_id: zoneId,
                        society_id: societyId
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#Buildingname').html(
                            '<option value="">Select Building</option>');
                        $.each(data, function(key, value) {
                            $('#Buildingname').append('<option value="' +
                                value.id + '">' + value.Buildingname +
                                '</option>');
                        });
                        $('#Buildingname').append(
                            '<option value="Other">Other</option>'
                            ); // Always add "Other" option
                    }
                });
            } else {
                $('#Buildingname').html('<option value="">Select Building</option>');
                $('#Buildingname').append(
                '<option value="Other">Other</option>'); // Always add "Other" option
            }
        });

        $('#Buildingname').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'Other') {
                $(this).hide();
                $('#OtherBuildingname').show().attr('required', true);
            } else {
                $('#OtherBuildingname').hide().removeAttr('required');
            }
        });
    });
});
</script>