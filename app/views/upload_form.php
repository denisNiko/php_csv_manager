<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload CSV</title>
</head>
<body>
    <h2>Upload CSV File</h2>
    <form action="/php_csv_managment/?action=upload" method="POST" enctype="multipart/form-data">
        <input type="file" name="csv_file" accept=".csv" required>
        <button type="submit">Upload and Display</button>
    </form>
</body>
</html>