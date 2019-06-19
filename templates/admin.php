<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        <?php
        include '../db_connection.php';

        if (empty($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            session_abort();
            exit('Klaida: Prieiga negalima');
        } else {
            include '../layouts/navbar.php';
            $conn = OpenConnection();

            $getAllClaims = "SELECT claim.id, claim.date, claim.text, users.username FROM claim LEFT JOIN users ON claim.fk_user = users.id ORDER BY date DESC";
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
                echo '<h5 align="center">Pretenzijų sąrašas</h5>';
                foreach ($temp_row as $row) {
                    echo '<div class="container">
                        <div class="card text-white bg-dark mb-3" value="' . $row["id"] . 'id="claim_card">
                            <div class="card-header">' . $row["date"] . ' </div>
                                <div class="card-body">
                                  <h5 class="card-title">' . $row["username"] . '</h5>
                                  <p class="card-text">' . $row["text"] . '</p>
                                </div>';

                    $date = $row["date"];
                    date_default_timezone_set('Europe/Vilnius');
                    $d1 = date("Y-m-d", strtotime($date));
                    $date1 = new DateTime('today');
                    $date1->modify('-2 weekday');
                    $d = $date1->format('Y-m-d');
  
                    if (($d1 >= $d) && ($d1 <= date('Y-m-d'))) {
                        echo '<div class="card-footer"><a href=reply.php?id=' . $row["id"] . '>Atsakyti</a></div></div></div>';
                    } else {
                        echo '<div class="card-footer"></div></div></div>';
                    }

                    foreach ($temp_rowReplies as $rowReplies) {
                        if ($row["id"] === $rowReplies["fk_claim"]) {
                            echo '<div class="container">
                                 <div class="card text-white bg-secondary mb-3" value="' . $row["id"] . '" style="margin-left: 50px;">
                                   <div class="card-header">' . $rowReplies["date"] . '</div>
                                   <div class="card-body">
                                       <p class="card-text">' . $rowReplies["text"] . '</p>
                                   </div>
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
<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>