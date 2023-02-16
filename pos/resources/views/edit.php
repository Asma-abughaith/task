
    
    <div class="">
        <form action="/update" method="POST" class="col-xl-6 col-md-12 col-sm-12 col-xs-12 box p-5 m-auto" enctype="multipart/form-data">
        <h1 class="table-title">Edit Your Profile</h1> 
        <input type="hidden" name="id" value="<?= $data->user->id ?>">
            <div class="mb-3">
                <label for="display-name" class="form-label">Display Name</label>
                <input type="text" class="form-control" id="display-name" name="display_name"
                    value="<?= $data->user->display_name ?>">
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user-email" name="email" value="<?= $data->user->email ?>" required>
            </div>
            <div class="mb-3">
                <label for="user-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username-email" name="username"
                    value="<?= $data->user->username ?>"required>
            </div>

            <button type="submit" class="btn btn-outline-success mt-4">Update</button>
            <a href="../"class="btn btn-outline-danger mt-4">Cancel</a>

        </form>

        <form action="/image" method="POST" class="col-xl-6 col-md-12 col-sm-12 col-xs-12 box p-5 mt-2 m-auto" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->user->id ?>">
            <div class="mb-3">
                <label for="item-image" class="form-label">Image Of User</label>
                <input type="file" class="form-control" id="item-image" name="image" required>
            </div>

            <button type="submit" class="btn btn-outline-success mt-4">Update</button>
        </form>
    </div>
