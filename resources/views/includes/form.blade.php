<!-- ######## MODAL 1: ADD DONOR MODAL ######## -->
<div class="modal modal-top fade" id="checkdonor" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" action="" method="GET">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-5">

                <label for="nameSlideTop" class="col-sm-10 col-form-label">Please Insert Phone Number</label>
                <div class="col-sm-12">
                    <input type="search" name="phone" id="basic-default-phone" class="form-control" required />
                </div>

            </div>
        </form>
    </div>
</div>
<!-- ########### END ############ -->


<!-- ######## MODAL 2 : CANCEL RECEIPT MODAL ######## -->
<div class="modal modal-top fade" id="CancelResit" tabindex="-1">
    <div class="modal-dialog">

        <form class="modal-content" action="" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">Cancel Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body mb-3">
                <div class="row">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Receipt Number</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="basic-default-name" name="receipt" />
                    </div>
                </div>

                <div class="row mt-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Receipt Book Batch</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="basic-default-name" name="batch" />
                    </div>
                </div>

                <div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="basic-default-name" name="staff"
                            value="" hidden />
                    </div>
                </div>

                <div>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="basic-default-name" name="status" value="2"
                            hidden />
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button type="submit" name="AddNewDonor" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
<!-- ########### END ############ -->

<!-- ########### MODAL 3 : FOR IMAGE DISPLAY ############ -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <img id="popup-img" src="" alt="image">
        </div>
    </div>
</div>

<!-- ########### END ############ -->


<div class="modal modal-top fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Donor Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="donor-id"></span></p>
                <p><strong>Name:</strong> <span id="donor-name"></span></p>
                <p><strong>Phone Number:</strong> <span id="donor-phone"></span></p>
            </div>
        </div>
    </div>
</div>