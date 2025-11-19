<!DOCTYPE html>
<html>
<head>
    <title>Import Technical Skills For Jobs</title>
</head>
<body>
    <form action="{{ route('admin.update.technical-skills-for-jobs') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel_file">
        <button type="submit">Import</button>
    </form>
</body>
</html>
