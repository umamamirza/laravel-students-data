<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student CRUD</title>
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
    <style>
        .student-image {
            width: 50px;
            height: 50px;
            transition: transform 0.3s ease-in-out;
        }
        .student-image:hover {
            transform: scale(3);
            z-index: 10;
            position: relative;
        }
    </style>
</head>
<body>
 
<div class="container mt-4">
    <h2>Student List</h2>
    <a href="{{ url('students/create') }}" class="btn btn-outline-primary mt-3">Add Student</a>
 
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>City ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentData">
        </tbody>
    </table>
</div> -->
 
<!-- <script>
  $(document).ready(function () {
     fetchStudents(); 

    $(document).on('click', '.delete-btn', function () {
        const studentId = $(this).data('id');
        if (!confirm('Are you sure you want to delete this student?')) return;
 
        $.ajax({
            url: `/students/${studentId}`,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function () {
                alert('Student deleted successfully!');
                fetchStudents();
            },
            error: function(xhr) {
                alert('Failed to delete student.');
                console.error(xhr.responseText);
            }
        });
    });
});

function fetchStudents() {

        $.ajax({
            // url: '{{ route("students.index") }}',
            url: '{{ url("/students") }}',
            type: 'GET',
            dataType: 'json',
            success: function (students) {
                let rows = '';
console.log('hello');
console.log(students);
                console.log(students);
                $.each(students, function (index, student) {
                    rows += `<tr>
                        <td>${student.id}</td>
                        <td><img src="/storage/${student.image}" width="50"/></td>
                        <td>${student.name}</td>
                        <td>${student.age}</td>
                        <td>${student.gender}</td>
                        <td>${student.city_id}</td>
                    <a href="/students/${student.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="${student.id}">Delete</button>
                    </tr>`;
                });
                $('#studentData').html(rows);
            },
            error: function (xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    }
</script> -->
<!--  
<script>
  $(document).ready(function () {
    fetchStudents();

    $(document).on('click', '.delete-btn', function () {
      const studentId = $(this).data('id');
      if (!confirm('Are you sure you want to delete this student?')) return;

      $.ajax({
        url: `/students/${studentId}`,
        type: 'DELETE',
        data: { _token: $('meta[name="csrf-token"]').attr('content') },
        success: function () {
          alert('Student deleted successfully!');
          fetchStudents();
        },
        error: function (xhr) {
          alert('Failed to delete student.');
          console.error(xhr.responseText);
        }
      });
    });
  });

  function fetchStudents() {
    $('#studentData').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');

    $.ajax({
      url: '{{ url("/students") }}',
      type: 'GET',
      dataType: 'json',
      success: function (students) {
        let rows = '';
        $.each(students, function (index, student) {
          rows += `<tr>
            <td>${student.id}</td>
            <td><img class="student-image" src="/storage/${student.image}" /></td>
            <td>${student.name}</td>
            <td>${student.age}</td>
            <td>${student.gender}</td>
            <td>${student.city_id}</td>
            <td>
              <a href="/students/${student.id}/edit" class="btn btn-warning btn-sm">Edit</a>
              <button class="btn btn-danger btn-sm delete-btn" data-id="${student.id}">Delete</button>
            </td>
          </tr>`;
        });
        $('#studentData').html(rows);
      },
      error: function (xhr) {
        console.log('Error:', xhr.responseText);
      }
    });
  }
</script>

</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student CRUD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .student-image {
            width: 50px;
            height: 50px;
            transition: transform 0.3s ease-in-out;
        }
        .student-image:hover {
            transform: scale(3);
            z-index: 10;
            position: relative;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2>Student List</h2>
    <a href="{{ url('students/create') }}" class="btn btn-outline-primary mt-3">Add Student</a>

    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>City ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentData">
        </tbody>
    </table>
</div>

<script>
$(document).ready(function () {
    // Sab AJAX requests ke liye CSRF token set karein
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Page load hone par students fetch karein
    fetchStudents();

    // Delete button click handler
    $(document).on('click', '.delete-btn', function () {
        const studentId = $(this).data('id');
        if (!confirm('Kya aap is student ko delete karna chahte hain?')) return;

        $.ajax({
            url: `/students/${studentId}`,
            type: 'DELETE',
            success: function (response) {
                alert(response.message || 'Student successfully delete ho gaya!');
                fetchStudents();
            },
            error: function (xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Student delete karne mein nakaam hua.';
                $('#error-message').text(errorMsg).show();
                console.error(xhr.responseText);
            }
        });
    });
});

function fetchStudents() {
    $.ajax({
        url: '{{ url("/students") }}', // StudentController@index se map hota hai
        type: 'GET',
        dataType: 'json',
        success: function (students) {
            let rows = '';
            $.each(students, function (index, student) {
                rows += `<tr>
                    <td>${student.id}</td>
                    <td><img src="/storage/${student.image}" class="student-image" alt="Student Image" /></td>
                    <td>${student.name}</td>
                    <td>${student.age}</td>
                    <td>${student.gender}</td>
                    <td>${student.city_id || 'N/A'}</td>
                    <td>
                        <a href="/students/${student.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${student.id}">Delete</button>
                    </td>
                </tr>`;
            });
            $('#studentData').html(rows);
            $('#error-message').hide(); // Success par error message hide karein
        },
        error: function (xhr) {
            const errorMsg = xhr.responseJSON?.message || 'Students fetch karne mein nakaam hua.';
            $('#error-message').text(errorMsg).show();
            console.error('Error:', xhr.responseText);
        }
    });
}
</script>

</body>
</html>