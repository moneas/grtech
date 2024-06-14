<!DOCTYPE html>
<html>
<head>
    <title>New Employee Created</title>
</head>
<body>
    <h1>New Employee Created</h1>
    <p>An employee has been created with the following details:</p>
    <p>Name: {{ $employee->first_name }} {{ $employee->last_name }}</p>
    <p>Email: {{ $employee->email }}</p>
    <p>Company: {{ $employee->company->name }}</p>
</body>
</html>
