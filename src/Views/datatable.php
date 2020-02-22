<div class="container-md">
    <table id="datatable" class="display">
        <thead>
        <?php
        foreach($_SESSION['spreadsheet']->getHeaders() as $header)
        {
            echo '<th>'.$header.'</th>';
        }
        ?>
        </thead>
        <tbody>
        <?php
        foreach($_SESSION['spreadsheet']->getValues() as $row)
        {
            echo '<tr>';
            foreach($row as $value)
            {
                echo '<td>'.$value.'</td>';
            }
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</div>