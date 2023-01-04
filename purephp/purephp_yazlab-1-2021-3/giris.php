<?php
include "Includes/header.php";

include "DB.php";
$db = new DB();

//$users = $db->select("users", array("rank", "password"), array(1, 0), "ID ASC", "5");
//$users = $db->select("users");

//$db->pr($users);
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="Requests/login-post.php" method="post">
                    <div class="card mt-5">
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="Username"
                                       name="username">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        Username
                                    </div>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       placeholder="Password"
                                       name="password">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        Password
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                <div class="col-12">
                                    <button type="submit" name="login"
                                            class="btn btn-primary btn-warning w-100">
                                        Giriş Yap
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include "Includes/footer.php";