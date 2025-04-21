<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Fetch all students
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    public function loadStudents()
    {
        $students = Student::all();
        return $students; 
    }


    // Show create form
    public function create()
    {
        $cities = \App\Models\City::all();
        return view('students.create', compact('cities'));
    }

    // Store new student
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'city_id' => 'nullable|integer|exists:cities,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('uploads', 'public');
        }

        $student = Student::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Student created successfully.',
            'student' => $student,
        ]);
    }

    // Show single student
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // Show edit form
    public function edit($id)
    {
        $student = Student::find($id);
        $cities = \App\Models\City::all();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return view('students.edit', compact('student', 'cities'));
    }

    // Update existing student
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|string',
            'city_id' => 'nullable|integer|exists:cities,id', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            if ($student->image) {
                Storage::delete('public/' . $student->image);
            }
            $validatedData['image'] = $request->file('image')->store('uploads', 'public');
        }

        $student->update($validatedData);

        return response()->json(['message' => 'Student updated successfully']);
    }

    // Delete student
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        if ($student->image) {
            Storage::delete('public/' . $student->image);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}