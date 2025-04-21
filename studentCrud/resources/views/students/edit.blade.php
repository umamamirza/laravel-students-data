
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="card p-4">
            <h2>Edit Student</h2>
            <form id="editStudentForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="student_id" name="student_id" value="{{ $student->id }}">
                <label for="image">Choose New Image:</label>
                <div class="mb-3">
                    @if ($student->image)
                        <img id="previewImage" src="{{ asset('storage/' . $student->image) }}" width="100" height="100" alt="Student Image">
                    @else
                        <p>No Image</p>
                        <img id="previewImage" width="100" height="100" style="display: none;">
                    @endif
                </div>

                <input type="file" id="image" name="image" accept="image/*" class="form-control mb-3">
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control mb-3" value="{{ $student->name }}" required>

                <label for="age">Age:</label>
                <input type="number" id="age" name="age" class="form-control mb-3" value="{{ $student->age }}" required>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" class="form-control mb-3" required>
                    <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
                </select>

                <label for="city_id">City ID:</label>
                <input type="text" id="city_id" name="city_id" class="form-control mb-3" value="{{ $student->city_id }}" required>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="/students" class="btn btn-outline-dark">Back</a>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    $("#image").change(function () {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#previewImage").attr("src", e.target.result).show();
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#editStudentForm").on("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append("_method", "PUT");

        let studentId = $("#student_id").val();

        $.ajax({
            url: `/students/${studentId}`,
            type: "POST",  
            data: formData,
            processData: false,  
            contentType: false,  
            success: function (response) {
                alert("Student updated successfully!");
                window.location.href = "/students"; 
            },
            error: function (xhr) {
                console.error("Error updating student:", xhr.responseText);
                alert("Failed to update student.");
            }
        });
    });
});
</script>

</body>
</html>
