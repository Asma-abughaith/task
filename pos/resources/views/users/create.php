<div class="">


<form action="/users/store" method="POST" class="col-xl-6 col-md-12 col-sm-12 col-xs-12 box p-4 m-auto" enctype="multipart/form-data">
<h1 class="table-title">Create User</h1>
<div class="mb-3">
        <label for="display-name" class="form-label">Display Name</label>
        <input type="text" class="form-control" id="display-name" name="display_name" required>
    </div>
    <div class="mb-3">
        <label for="user-email" class="form-label">Email</label>
        <input type="email" class="form-control" id="user-email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="user-username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username-email" name="username" required>
    </div>
    <div class="mb-3">
        <label for="user-password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password-email" name="password" required>
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
    <div class="mb-3">
        <label for="item-image" class="form-label"> user's Image </label>
        <input type="file" class="form-control" id="item-image" name="image" >
    </div>
    
    <button type="submit" class="btn btn-outline-success mt-4">Create</button>
    <a href="/users" class="btn btn-outline-danger ms-3 mt-4">Cancel</a>
</form>
</div >