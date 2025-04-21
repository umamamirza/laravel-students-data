$(document).ready(function(){
    $("#studentForm").submit(function(e){
        e.preventDefault();

        let formData = {
            // name: $("#name").val(),
            // age: $("#age").val(),
            // gender: $("#gender").val(),
            // city_id: $("#city_id").val(),
            // _token: $('meta[name="csrf-token"]').attr("content") 
            name: $("input[name='name']").val(),
            age: $("input[name='age']").val(),
            gender: $("select[name='gender']").val(),
            city_id: parseInt($("input[name='city_id']").val()),
        }

        

        $.ajax({
            url: "/students",
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    alert("Data Saved Successfully!");
                }
            },
            error: function(xhr) {
                alert("Something went wrong!");
            }
        });
    });
});
