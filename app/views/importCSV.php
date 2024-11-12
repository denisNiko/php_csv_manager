<h2>Upload CSV File</h2>
<form action="/php_csv_managment/?action=upload" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <input type="file" name="csv_file" accept=".csv" required class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Upload and Display</button>
</form>