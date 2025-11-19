<!DOCTYPE html>
<html>
<head>
    <title>Import Skills</title>
</head>
<body>
    <form action="{{ route('admin.update.technical-skills') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file">
        <input type="number" name="sheet_index" placeholder="Sheet Index" required>
        <button type="submit">Import</button>
    </form>
</body>
</html>
