    <form method="POST" action="{{ route('attendance.store', $enrollment->id) }}" class="flex gap-2">
        @csrf
        <input type="hidden" name="date" value="{{ now()->toDateString() }}">
        <button name="status" value="Hadir" class="px-3 py-2 bg-green-600 text-white">Hadir</button>
        <button name="status" value="Izin" class="px-3 py-2 bg-yellow-600 text-white">Izin</button>
        <button name="status" value="Tidak Hadir" class="px-3 py-2 bg-red-600 text-white">Tidak Hadir</button>
    </form>