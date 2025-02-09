<!-- begin modal -->
<div class="modal fade w-100" id="mypan" tabindex="-1" role="dialog" aria-labelledby="mypan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (isset($_SESSION['matricule'])) {
                    $current_user = $_SESSION['matricule'];
                    $query = "SELECT user_name FROM users_stock WHERE matricule=?";
                    $stmt = mysqli_prepare($link_db, $query);
                    mysqli_stmt_bind_param($stmt, "s", $current_user);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $user_data = mysqli_fetch_assoc($result);
                    $user_name = $user_data ? $user_data['user_name'] : 'Utilisateur';
                ?>
                <div class="text-center w-100 user_panier">
                    <i class="fas fa-shopping-cart"></i>
                    <b><?php echo " " . htmlspecialchars($user_name); ?></b>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script src="/assets/js/jquery.min.js"></script> <!-- Mise à jour du chemin -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script> <!-- Mise à jour du chemin -->
<script src="/assets/js/chart.min.js"></script> <!-- Mise à jour du chemin -->
<script src="/assets/js/bs-init.js"></script> <!-- Mise à jour du chemin -->
</body>
</html>