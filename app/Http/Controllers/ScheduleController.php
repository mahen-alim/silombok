<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::latest()->get();
        return view('schedule.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Validasi input
        $request->validate([
            'days' => 'required|array',
            'days.*' => 'string|max:10',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:60',
        ]);

        // Menyimpan jadwal ke dalam database
        Schedule::create([
            'days' => json_encode($request->days), // Mengubah array 'days' menjadi JSON
            'time' => $request->time,
            'duration' => $request->duration,
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
        ]);

        // Menyimpan status alert ke session
        session()->flash('scheduleAlert', true);

        // Redirect ke halaman index jadwal
        return redirect()->route('schedule.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'days' => 'required|array',
            'time' => 'required',
            'duration' => 'required|integer|min:1|max:60',
        ]);

        // Temukan jadwal yang akan diupdate
        $schedule = Schedule::findOrFail($id);

        // Update data jadwal
        $schedule->days = json_encode($request->input('days')); // Mengonversi array hari ke format JSON
        $schedule->time = $request->input('time');
        $schedule->duration = $request->input('duration');

        // Simpan perubahan
        $schedule->save();

        // Menyimpan status alert ke session
        session()->flash('editScheduleAlert', true);
        
        // Redirect dengan pesan sukses
        return redirect()->route('schedule.index');
    }
    
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan jadwal berdasarkan ID
        $schedule = Schedule::findOrFail($id);
        
        // Hapus jadwal dari database
        $schedule->delete();

        // Menyimpan status alert ke session
        session()->flash('deleteScheduleAlert', true);
        
        // Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->route('schedule.index');
    }
}
