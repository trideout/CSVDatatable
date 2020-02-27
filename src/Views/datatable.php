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

    <div class="modal" tabindex="-1" role="dialog" id="columnModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method=GET id="columnForm">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Add Column
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        <div class="form-group">
                            <input type="hidden" name="action" value="addColumn">
                            <label for="name">Column Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="rule">Column Rule</label>
                            <input type="text" class="form-control" name="rule">
                        </div>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="$('#columnForm').submit()">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#columnModal">Add Column</button>