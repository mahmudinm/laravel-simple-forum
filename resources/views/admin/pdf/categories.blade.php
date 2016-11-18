<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/app.css">
</head>
<body style="background-color:#fff;">
<h1>List Categories</h1>
  <table class="table table-striped">
    <thead>
      <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Forum</td>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td>{{ $category->forum->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>