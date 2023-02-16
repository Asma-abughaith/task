
    
    <div class="">
    
        <form action="/users/update" method="POST" class="col-xl-6 col-md-8 col-sm-12 col-xs-12 box p-2 m-auto " enctype="multipart/form-data">
        <h1 class="table-title text-center">Edit User</h1>
        <input type="hidden" name="id" value="<?= $data->user->id ?>">
            <div class="mb-3">
                <label for="display-name" class="form-label">Display Name</label>
                <input type="text" class="form-control" id="display-name" name="display_name"
                    value="<?= $data->user->display_name ?>"required>
            </div>
            <div class="mb-3">
                <label for="user-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="user-email" name="email" value="<?= $data->user->email ?>"required>
            </div>
            <div class="mb-3">
                <label for="user-username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username-email" name="username"
                    value="<?= $data->user->username ?>"required>
            </div>

            <div class="mb-3">
                <label for="user-role" class="form-label">Role</label>
                <select class="form-select" aria-label="Role" name="role" required>
                    <option value="admin">Admin</option>
                    <option value="seller">Seller</option>
                    <option value="porcurement">Porcurement</option>
                    <option value="accountant">Accountant</option>
                </select>
            </div>

            <button type="submit" class="btn btn-outline-success mt-4">Update</button>
            <a href="/user?id=<?= $data->user->id ?>" class="btn btn-outline-danger ms-3 mt-4">Cancel</a>

        </form>

        <form action="/users/image" method="POST" class="col-xl-6 col-md-8 col-sm-12 col-xs-12 py-3 box p-2 m-auto mt-2 " enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $data->user->id ?>">
            <div class="mb-3">
                <label for="item-image" class="form-label ">Image Of User</label>
                <input type="file" class="form-control" id="item-image" name="image" required>
            </div>

            <button type="submit" class="btn btn-outline-success mt-2">Update</button>
        </form>
    </div>
