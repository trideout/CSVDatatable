<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    </head>
    <body>
    <div class="container">
        <?php if(isset($_SESSION['errors'])){ ?>
        <div class="row">
            <div class="col">
                <div class="alert alert-danger">
                    <?php
                        echo $_SESSION['errors'];
                        unset($_SESSION['errors']);
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    <div class="row">
        <div class="col">
            <h1 class="display-5">
                Datatable with Formula functionality
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <ul>
                <?php if(isset($_SESSION['spreadsheet'])){ ?>
                <li>
                    <a href="#" data-toggle="modal" data-target="#columnModal">Add Column</a>
                </li>
                <li>
                    <a href="/index.php?action=restart">Restart</a>
                </li>
                <?php } ?>
                <li>
                    <a href="#" data-toggle="modal" data-target="#helpModal">Help</a>
                </li>
            </ul>
        </div>
        <div class="col">