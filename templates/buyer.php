<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <title></title>
    </head>
    <body>
        <?php
        include '../controllers/claim.php';
        if (empty($_SESSION['user']) || $_SESSION['user']['role'] != 'buyer') {
            session_abort();
            exit('Klaida: Prieiga negalima');
        } else {
            include '../layouts/navbar.php';
            echo '<div class="container">
            <div class="row">
                <div class="col mt-4 mb-4">
                    <form action="buyer.php" method="POST">
                        Pretenzija: <input type="text" name="text">
                        <input type="submit" name="claim-btn" value="siųsti" class="btn btn-secondary">
                    </form>
                </div>
            </div>';

            $conn = OpenConnection();

            $userId = $_SESSION['user']['id'];
            $getAllClaims = "SELECT * FROM claim WHERE fk_user='$userId' ORDER BY date DESC";
            $resultClaims = selectFromDatabase($conn, $getAllClaims);

            $getAllReplies = "SELECT * FROM reply ORDER BY date DESC";
            $resultReplies = selectFromDatabase($conn, $getAllReplies);

            if (mysqli_num_rows($resultClaims) > 0 || mysqli_num_rows($resultReplies) > 0) {
                while ($row = mysqli_fetch_assoc($resultClaims)) {
                    $temp_row[] = $row;
                }
                while ($rowReplies = mysqli_fetch_assoc($resultReplies)) {
                    $temp_rowReplies[] = $rowReplies;
                }
                foreach ($temp_row as $row) {
                    echo '<div class="card text-white bg-dark mb-3" value="' . $row["id"] . '" id="claim_card">
                                  <div class="card-header">' . $row["date"] . '</div>
                                  <div class="card-body">
                                      <p class="card-text">' . $row["text"] . '</p>
                                  </div>
                                </div>';
                    foreach ($temp_rowReplies as $rowReplies) {
                        if ($row["id"] === $rowReplies["fk_claim"]) {
                            echo '<div class="card text-white bg-secondary mb-3" value="' . $row["id"] . '" style="margin-left: 50px;">
                                   <div class="card-header">' . $rowReplies["date"] . '</div>
                                   <div class="card-body">
                                       <p class="card-text">' . $rowReplies["text"] . '</p>
                                   </div>
                                 </div>';
                        }
                    }
                }
            } else {
                echo 'Nėra pretenzijų';
            }
            CloseConnection($conn);
        }
        ?>
    </div>
</div>
</body>
</html>