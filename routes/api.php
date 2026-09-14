<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Event; // Pastikan import model Event

// B (Browse): Menampilkan seluruh data event
Route::get('/event', function() {
    $events = Event::all();

    return response()->json([
        'message' => "Berhasil mengambil seluruh data event",
        'data' => $events
    ], 200);
});

// R (Read): Menampilkan detail event berdasarkan ID
Route::get('/event/{id}', function($id) {
    $event = Event::find($id);

    if (!$event) {
        return response()->json([
            'message' => 'Event tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'message' => "Detail event berhasil ditemukan",
        'data' => $event
    ], 200);
});

// A (Add): Menambahkan event baru
Route::post('/event', function(Request $request) {
    $namaEvent = $request->input('nama_event');
    $penyelenggara = $request->input('penyelenggara');
    $lokasi = $request->input('lokasi');
    $hargaTiket = $request->input('harga_tiket');

    if (!$namaEvent || !$penyelenggara || !$lokasi || !$hargaTiket) {
        return response()->json([
            'message' => 'Semua field (nama_event, penyelenggara, lokasi, harga_tiket) wajib diisi!'
        ], 400);
    }

    $event = Event::create([
        'nama_event' => $namaEvent,
        'penyelenggara' => $penyelenggara,
        'lokasi' => $lokasi,
        'harga_tiket' => $hargaTiket
    ]);

    return response()->json([
        'message' => "Event berhasil ditambahkan",
        'data' => $event
    ], 201);
});

// E (Edit): Mengubah data event berdasarkan ID
Route::put('/event/{id}', function(Request $request, $id) {
    $event = Event::find($id);

    if (!$event) {
        return response()->json([
            'message' => 'Event tidak ditemukan'
        ], 404);
    }

    $event->update([
        'nama_event' => $request->input('nama_event', $event->nama_event),
        'penyelenggara' => $request->input('penyelenggara', $event->penyelenggara),
        'lokasi' => $request->input('lokasi', $event->lokasi),
        'harga_tiket' => $request->input('harga_tiket', $event->harga_tiket)
    ]);

    return response()->json([
        'message' => "Event berhasil diubah",
        'data' => $event
    ], 200);
});

// D (Delete): Menghapus event berdasarkan ID
Route::delete('/event/{id}', function($id) {
    $event = Event::find($id);

    if (!$event) {
        return response()->json([
            'message' => 'Event tidak ditemukan'
        ], 404);
    }

    $event->delete();

    return response()->json([
        'message' => "Event berhasil dihapus"
    ], 200);
});