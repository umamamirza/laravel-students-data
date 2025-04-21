<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="card">
            <h2>Add New Student</h2>

<form method="POST" action="{{ route('students.store') }}" id="createStudentForm" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="image">Choose Image:</label>
        <input type="file" id="image" name="image" accept="image/*" class="form-control">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Age:</label>
        <input type="number" id="age" name="age" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gender:</label>
        <select id="gender" name="gender" class="form-control" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>
    
    <div class="mb-3">
    <label for="city_id" class="form-label">City:</label>
    <input type="text" id="city_id" name="city_id" class="form-control" placeholder="Enter City ID or Name">
</div>


    <div class="mb-3">
        <button type="submit" id="saveData" class="btn btn-outline-primary">Save</button>
        <a href="{{ route('students.index') }}" class="btn btn-outline-dark">Back</a>
    </div>
</form>

        </div>
    </div>
</div>

<script>


$(document).ready(function () {
   
    $("#createStudentForm").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this); 
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "/students", 
            type: "POST",
            data: formData,
            processData: false, 
            contentType: false, 
            success: function (response) {
                alert("Student Added Successfully!");
                window.location.href = "/students"; 
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
                alert("Error! Unable to add student.");
            }
        });
    });

    // FETCH DATS
    $.ajax({
        url: "/students", 
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log(response); 
            if (Array.isArray(response)) {
                response.forEach(student => {
                    console.log("Student Name:", student.name);
                    
                });
            } else {
                console.error("Response is not an array:", response);
            }
        },
        error: function(xhr) {
            console.error("Error fetching student data:", xhr.responseText);
        }
    });
});

    //  $(document).ready(function () {
    //      $("#createStudentForm").submit(function (e) {
    //          e.preventDefault();

    //          let formData = new FormData(this); 
    //          formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    //          $.ajax({
    //              url: "{{ route('students.store') }}", 
    //              type: "POST",
    //              data: formData,
    //              processData: false,  
    //              contentType: false, 
    //              success: function (response) {
    //                  alert("Student Added Successfully!");
    //                  window.location.href = "/students";
    //              },
    //              error: function (xhr) {
    //                  console.error("Error:", xhr.responseText);
    //                  alert("Error! Unable to add student.");
    //              }
    //          });
    //      });

    // //     // Fetch all
    //      $.ajax({
    //          url: "{{ route('students.index') }}",
    //          type: "GET",
    //          dataType: "json",
    //          success: function(response) {
    //              console.log(response); 
    //              if (Array.isArray(response)) {
    //                  response.forEach(student => {
    //                      console.log("Student Name:", student.name);
    //                  });
    //              } else {
    //                  console.error("Response is not an array:", response);
    //              }
    //          },
    //          error: function(xhr) {
    //              console.error("Error fetching student data:", xhr.responseText);
    //          }
    //      });
    //  });
</script>

</body>
</html>