<div class="modal fade" id="modify<?=$list['pcid']?>" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
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
                <label>Name</label>
                <input type="text" name="name" placeholder="enter product name" class="form-control">
                <label>description</label>
                <input type="text" name="description" class="form-control">
                <label>Category</label>

                <select class="form-select" name="category">
                  <option value="Pasta">Pasta</option>
                  <option value="Pizza">Pizza</option>
                </select>
                <label>Picture</label>
                <input type="file" name="picture" class="form-control">
                <label>Price</label>
                <input type="number" name="price" class="form-control">
                <br>
                <button type="button" name="button" class="btn btn-primary">Save</button>
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
