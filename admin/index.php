<?php require_once "inc/header.php"; ?>
<?php
if(isset($_GET['block'])) {
  $block_id = $_GET['block'];
  $block_update = $common->update(table: "users", data: ["status" => '0'], cond: "id = :id", params: ['id' => $block_id], modifiedColumnName: 'updated_at');
  if($block_update) {
    header("Location: ".SITE_URL."/admin");
  }
} elseif(isset($_GET['unblock'])) {
  $unblock_id = $_GET['unblock'];
  $unblock_update = $common->update(table: "`users`", data: ["status" => '1'], cond: "id = :id", params: ['id' => $unblock_id], modifiedColumnName: 'updated_at');
  if($unblock_update) {
    header("Location: ".SITE_URL."/admin");
  }
} elseif(isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $user_delete = $common->delete("`users`", "`id` = :id", ['id' => $delete_id]);
  if($user_delete) {
    header("Location: ".SITE_URL."/admin");
  }
}

  $total_users = $common->count("users");

  $active_users = $common->count("users", "status = :status", ['status' => '1']);

  $blocked_users = $common->count("`users`", "`status` = :status", ['status' => '0']);
?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3">
      <div class="projects mb-4">
        <div class="container-fluid">
        	<div class="row">
              <div class="col-sm-4 py-4">
                <div class="card bg-primary text-white">
                  <div class="card-body">
                    <i class="fa fa-users fa-3x"></i>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h4>Total Users</h4>
                        <h3><?= $total_users; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 py-4">
                <div class="card bg-success text-white">
                  <div class="card-body">
                    <i class="fa fa-users fa-3x"></i>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h4>Active Users</h4>
                        <h3><?= $active_users; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 py-4">
                <div class="card bg-danger text-white">
                  <div class="card-body">
                    <i class="fa fa-users fa-3x"></i>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <h4>Blocked Users</h4>
                        <h3><?= $blocked_users; ?></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </main>
    
<?php require_once "inc/footer.php"; ?>