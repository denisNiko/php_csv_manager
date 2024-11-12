<h2>Export Customers to CSV</h2>
<form action="/php_csv_managment/?action=export" method="post">
    <div class="form-group">
        <label for="filename">Enter file name:</label>
        <input type="text" id="filename" name="filename" placeholder="customers.csv" required class="form-control">
    </div>

    <div class="form-group">
        <label for="limit">Number of rows (optional):</label>
        <input type="number" id="limit" name="limit" placeholder="Default is all rows" class="form-control">
    </div>

    <div class="form-group">
        <label for="offset">Starting row (optional):</label>
        <input type="number" id="offset" name="offset" placeholder="Default is 0" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Export CSV</button>
</form>