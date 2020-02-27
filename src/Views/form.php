<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="file">Please Select A File</label>
        <input type="file" class="form-control-file" name="csvFile" accept="text/csv">
        <input type="hidden" name="action" value="uploadCsv">
    </div>
    <div class="form-group">
        <input type="submit" class="form-control">
    </div>
</form>