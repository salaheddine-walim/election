<?php
session_start();

include 'dbh.php';
if(isset($_SESSION["id"])) {
        //    $sql = "select nom, prenom, text_presentation from candidat" ;
        $sql = "select *from candidat" ;
        $stmt = $pdo->query($sql);
        $candidats = $stmt->fetchAll(PDO::FETCH_OBJ);
  if($_SERVER['REQUEST_METHOD']== 'POST'){
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $text_presentation=$_POST['text_presentation'];
    $query="INSERT INTO `candidat` (`id`, `nom`, `prenom`, `text_presentation`) VALUES (NULL, '$nom', '$prenom', '$text_presentation');";
    $stmt2 = $pdo->query($query);
    header('Location:adminDashboard.php');
  }
    
        
    } else {
        header("Location:adminLogin.php");
    }
        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank</title>
    <link rel="stylesheet" href="style.css">    
</head>
<body>
    <header>
        <div><h3>Election</h3></div>
        <div>
        <a class='logout' href="logout.php">Deconnecter</a>
        </div>
    </header>
    <div class="container">
  <table class="responsive-table" style="margin-top:20px;">
    <caption>Tous les candidats</caption>
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Prenom candidat</th>
        <th scope="col">Nom condidat</th>
      </tr>
    </thead>
    <tbody>
        <?php 
                $i="1";
                foreach ($candidats as $candidat) {
                    echo "      <tr>
                        <td>".$i."</td>
                        <td>$candidat->prenom</td>
                        <td>$candidat->nom</td>      
                    </tr>";
                    $i++;
                }
        
?>
    </tbody>
  </table>
  <div >
    <h3>Ajouter un candidat</h3>
    <form method="post" action="" name="regisrationForm">
            <table>
              <tr>
                <td><label>Nom:</label></td>
                <td>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="prenom" placeholder="Prenom" />
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                <label>Prenom:</label>
                </td>
                <td>
                  <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                    <input type="text" name="nom" placeholder="Nom" required />
                  </div>
                </td>
              </tr>
              <tr>
                <td><label>Text de presentation:</label></td>
                <td>
                  <textarea name="text_presentation" rows="4" cols="50"></textarea>
                </td>
              </tr>
            </table>

            <input class="button" type="submit" value="Register" />
          </form>
  </div>
</div>


                        


</body>
</html>