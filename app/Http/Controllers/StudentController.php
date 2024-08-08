<?php



namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function fetch()
    {
        $students = Student::with('teacher')->paginate(10);

        $teachers = Teacher::all();
        return view('fetch', compact('students', 'teachers'));
 
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'class_teacher_id' => 'required|exists:teachers,id',
            'class' => 'required|string|max:255',
            'admission_date' => 'required|date',
            'yearly_fees' => 'required|numeric',
        ]);

        Student::create($request->all());
        return redirect()->route('fetch');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'student_name' => 'sometimes|required|string|max:255',
            'class_teacher_id' => 'sometimes|required|exists:teachers,id',
            'class' => 'sometimes|required|string|max:255',
            'admission_date' => 'sometimes|required|date',
            'yearly_fees' => 'sometimes|required|numeric',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);
        return redirect()->route('fetch')->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('fetch')->with('success', 'Student deleted successfully.');
    }
}

