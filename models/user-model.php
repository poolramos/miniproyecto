<?php 
require_once '../database/connection.php';

function test() {
  echo "Hello World";
}

function getUserById($id)
{
  $db = miniProyectoConnect();
  $sql = 'SELECT * FROM usuarios WHERE id = :id';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':id', $id, PDO::PARAM_STR);
  $stmt->execute();
  $userData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $userData;
}


function createUser($fullname, $bio, $phone, $email, $photo, $pssword)
{
  $db = miniProyectoConnect();

  $sql = 'INSERT INTO usuarios (fullname, bio, phone, email, photo, pssword)
      VALUES (:fullname, :bio, :phone, :email, :photo, :pssword)';

  $stmt = $db->prepare($sql);

  $stmt->bindValue(':fullname', $fullname, PDO::PARAM_STR);
  $stmt->bindValue(':bio', $bio, PDO::PARAM_STR);
  $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
  $stmt->bindValue(':pssword', $pssword, PDO::PARAM_STR);

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();

  $stmt->closeCursor();

  return $rowsChanged;
}

function checkExistingEmail($userEmail)
{
  $db = miniProyectoConnect();
  $sql = 'SELECT email FROM usuarios WHERE email = :userEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
  $stmt->execute();
  $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
  $stmt->closeCursor();

  if (empty($matchEmail)) {
    return 0;
  } else {
    return 1;   
  }
}

function getUserByEmail($userEmail)
{
  $db = miniProyectoConnect();
  $sql = 'SELECT id, fullname, bio, phone, email, photo, pssword FROM usuarios WHERE email = :userEmail';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':userEmail', $userEmail, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}


function updateUser($id, $fullname, $bio, $phone, $email, $photo, $pssword) {
  $db = miniProyectoConnect();

  $sql = 'UPDATE usuarios SET';

  if ( !empty($fullname)) {
    $sql .= ' fullname = :fullname,';
  }
  if ( !empty($bio)) {
    $sql .= ' bio = :bio,';
  }
  if ( !empty($phone)) {
    $sql .= ' phone = :phone,';
  }
  if ( !empty($email)) {
    // var_dump(gettype($email));
    var_dump("hello");

    $sql .= ' email = :email,';
  }
  if ( !empty($photo)) {
    $sql .= ' photo = :photo,';
  }
  if ( !empty($pssword)) {
    $sql .= ' pssword = :pssword,';
  }

  $sql = rtrim($sql, ',');

  $sql .= ' WHERE id = :id';
  
  if (strlen($sql) <= 34) {
    return 0;
  }

  $stmt = $db->prepare($sql);
  
  $stmt->bindValue(':id', $id, PDO::PARAM_STR);
  if (!empty($fullname)) {
    $stmt->bindValue(':fullname', $fullname, PDO::PARAM_STR);
  }
  if (!empty($bio)) {
    $stmt->bindValue(':bio', $bio, PDO::PARAM_STR);
  }
  if (!empty($phone)) {
    $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
  }
  if (!empty($email)) {
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  }
  if (!empty($photo)) {
    $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
  }
  if (!empty($pssword)) {
    $stmt->bindValue(':pssword', $pssword, PDO::PARAM_STR);
  }

  $stmt->execute();

  $rowsChanged = $stmt->rowCount();

  $stmt->closeCursor();

  return $rowsChanged;
}

?>