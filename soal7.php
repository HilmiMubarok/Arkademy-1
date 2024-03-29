<?php
  error_reporting( E_ALL );
  Class conn
  {
    public function __construct()
    {
      $this->conn = new mysqli('localhost', 'root', '', 'produk');
    }
    public function Tampil($select, $from)
    {
      $query = $this->conn->query('SELECT '.$select.' FROM '.$from);
      return $query;
    }
    public function Insert($value)
    {
      $query = $this->conn->query("INSERT product(name, category_id) VALUE($value)");
      return $query;
    }
    public function Edit($id, $set)
    {
      $query = $this->conn->query("UPDATE product SET $set WHERE id = '$id'");
      return $query;
    }
    public function Delete($value)
    {
      $query = $this->conn->query("DELETE FROM product WHERE id = '$value' ");
      return $query;
    }
    public function notif($msg)
    {
      echo "<script>alert('$msg');</script>";
    }
    public function load()
    {
      $url = $_SERVER['REQUEST_URI'];
      echo "<script>document.location.href='$url';</script>";
    }
  }
  
  $conn = new conn;
  if (isset($_POST['save'])) {
    extract($_POST);
    $save = $conn->insert("'$name','$category'");
    if ($save) {
      $conn->notif("Data Saved!");
    } else {
      $conn->notif("Gagal!");
    }
  }
  if (isset($_POST['edit'])) {
    extract($_POST);
    $save = $conn->edit($id,"name='$name',category_id='$category'");
    if ($save) {
      $conn->notif("Data Edited!");
    } else {
      $conn->notif("Gagal!");
    }
  }
  if (isset($_POST['delete'])) {
    extract($_POST);
    $save = $conn->delete($id);
    if ($save) {
      $conn->notif("Data Deleted!");
    } else {
      $conn->notif("Gagal!");
    }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Mateial Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Aplikasi Sederhana</title>
  </head>
  <body>
    <div class="container" style="padding:50px">
      <div class="row justify-content-md-center">
        <h2><em>Aplikasi Sederhana</em></h2>
        <div class="col-md-10">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <caption>List of products</caption>
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Category</th>
                  <th scope="col">ACT</th>
                </tr>
              </thead>
              <tbody>
                <form class='form-horizontal' role='form' method='POST'>
                  <?php
                    $data = $conn->Tampil('product.id as id, product.name as name, product_categories.name as category, product.category_id', 'product INNER JOIN product_categories ON product.category_id = product_categories.id');
                    while($baris = $data->fetch_array()){
                    echo  "<tr>
                            <th scope='row'><input type='text' readonly name='id' value='".$baris[0]."' style='border:none;background:transparent;width:100%;width:10px'></th>
                            <td><input type='text' name='name' value='".$baris[1]."' style='border:none;background:transparent;width:100%;'></td>
                            <td>
                              <select class='custom-select custom-select-sm' name='category'>
                                <option value='1' ".($baris[3] == 1 ? "selected" : "").">Peralatan Mandi</option>
                                <option value='2' ".($baris[3] == 2 ? "selected" : "").">Minuman Kemasan</option>
                                <option value='3' ".($baris[3] == 3 ? "selected" : "").">Produk Susu</option>
                              </select>
                            </td>
                            <td>
                              <center>
                                <div class='btn-group' role='group' aria-label='Basic example'>
                                  <button type='submit' name='edit' class='btn btn-info btn-sm'>EDIT</button>
                                  <button type='submit' name='delete' class='btn btn-danger btn-sm'>DELETE</button>
                                </div>
                              </center>
                            </td>
                          </tr>";
                    }
                  ?>
                </form>
                <tr class="bg-light">
                  <form class='form-horizontal' role='form' method='POST'>
                    <td>#</td>
                    <td>
                      <div class="form-group">
                        <input type="text" class="form-control form-control-sm" name="name">
                      </div>
                    </td>
                    <td>
                      <select class="custom-select custom-select-sm" name="category">
                        <option selected>Open this select menu</option>
                        <option value="1">Peralatan Mandi</option>
                        <option value="2">Minuman Kemasan</option>
                        <option value="3">Produk Susu</option>
                      </select>
                    </td>
                    <td><button type='submit' name='save' class='btn btn-primary btn-block'><i class='fa fa-save fa-sm'></i></button></td>
                  </form>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>