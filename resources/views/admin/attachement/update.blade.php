<?php require_once("inc/_header.php"); ?>
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Upload New File</h2>
                </div>
            </div>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="divider text-success">
                <div class="divider-text text-danger">
                    <i class="bx bx-star"></i>
                    <i class="bx bx-star"></i>
                    <i class="bx bx-star"></i>
                </div>
            </div>
            <div class="col-md-4 offset-md-4">
                <div class="card mb-4">
                    <div class="card-body">

                        <form action="../app/fileUpload.php" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label for="uploadfile">File Title & Keywords</label>
                                <input type="text" class="form-control" name="fileTitle_Keyword" maxlength="55" placeholder="Enter File Title and Keyqords" required>
                            </div>
                            <div class="form-group">
                                <label for="uploadfile">Upload File</label>
                                <input type="file" class="form-control" name="fileUpload" id="fileUpload">
                            </div>
                            <div class="text-end">
                                <button type="submit" name="fileUploadBtn" class="btn btn-primary mt-3">Upload File</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 offset-md-2">
                <div class="card md-4">
                    <img id="uploadImg" class="rounded" src="" alt="">
                </div>
            </div>
        </div>
        <?php require_once("inc/_footer.php"); ?>