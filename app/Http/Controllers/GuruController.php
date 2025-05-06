use App\Models\Guru;
use App\Models\Subject;
use Illuminate\Http\Request;

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:gurus,email',
        'subjects' => 'required|array|min:3|max:3',
        'subjects.*' => 'required|string|max:255',
    ]);

    $guru = Guru::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    foreach ($validated['subjects'] as $subjectName) {
        $guru->subjects()->create(['name' => $subjectName]);
    }

    return redirect()->back()->with('success', 'Guru dan mata pelajaran berhasil disimpan.');
}
