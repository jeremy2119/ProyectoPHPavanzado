<?php
    // Incluir archivo de conexión
    include_once("config.php");
    // Check if form is submitted for user update, then redirect to homepage after update
    if(isset($_POST['update']))
        {
            $id = $_POST['id'];
            $nombre_producto=$_POST['nombre_producto'];
            $descripcion=$_POST['descripcion'];
            // Actualizar datos
            $result = mysqli_query($mysqli, "UPDATE productos SET
            nombre_producto='$nombre_producto',descripcion='$descripcion' WHERE id=$id");
            // Redireccionar a inicio
            header("Location: admin.php");
        }
?>
<?php
    include_once("config.php");
    // Desplegar usuarios por el id seleccionado
    // Getting id from url
    $id = $_GET['id'];
    // Guardar datos en array
    $result = mysqli_query($mysqli, "SELECT * FROM productos WHERE id=$id");
    while($user_data = mysqli_fetch_array($result))
        {
            $nombre_producto = $user_data['nombre_producto'];
            $descripcion = $user_data['descripcion'];
        }
?>
<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
	print "<script>alert(\"Acceso invalido!\");window.location='login.php';</script>";
}

?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editar Producto</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #435d7d;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}

        .padding {
                padding: 30px;

        }
    </style></head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CAFE AU LAIT: ADMIN</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="Index.php">Inventario <span class="sr-only">(current)</span></a></li>
        <li><a href="usuarios.php">Usuarios</a></li>
          <li><a href="resenas.php">Reseñas</a></li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Cerrar Sesión</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Editar <b>Productos</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="admin.php" class="btn btn-success"><span>Volver a Inicio</span></a>
                </div>
            </div>
        </div>

<div class="container">
    <div class="col-sm-11">
        <div class="container-fluid padding">
            <div class="form-row">
                <form name="update_user" method="post" action="edit.php">
                    <div class="form-group">
                        <label>Titulo del Producto</label>
                        <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value=<?php echo $nombre_producto;?>>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" rows="3" name="descripcion" value=<?php echo $descripcion;?>>
                        </div>
                        <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                        <div class="form-group"><button type="submit" class="btn btn-primary" name="update" value="Update">Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
            
            
</body>

</html>
    