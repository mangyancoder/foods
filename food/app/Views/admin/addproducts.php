<div class="modal fade" id="AddProducts" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="exampleModalFullscreenLabel">Add New Menu/Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-sm-12 col-lg-6">
            <div class="card">
              <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                  <h4 class="card-title">Details</h4>
                </div>
              </div>
              <div class="card-body">
                <form action="<?=base_url('admin/addproduct')?>" method="POST" enctype="multipart/form-data">
                <label>Name</label>
                <input type="text" name="name" placeholder="enter product name" class="form-control">
                <label>description</label>
                <input type="text" name="description" class="form-control">
                <label>Category</label>

                <select class="form-select" name="category">
                <?php foreach ($category as $cat): ?>
                  <option value="<?= $cat['cid'] ?>"><?= $cat['name'] ?></option>
                <?php endforeach; ?>
                </select>
                <label>Picture</label>
                <input type="file" name="file" class="form-control">
                <label>Price</label>
                <input type="number" name="price" class="form-control">
                <br>
                <button type="submit" name="create" class="btn btn-primary">Save</button>
              </form>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
