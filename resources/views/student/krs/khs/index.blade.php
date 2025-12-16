@extends('layouts.app')
@section('title','KHS')
@section('content')
<h1 class="text-xl font-bold mb-4">KHS</h1>

<form method="GET" class="mb-4">
  <label>Semester:</label>
  <select name="semester_id" class="border p-2">
    @foreach(\App\Models\Semester::orderByDesc('year')->get() as $s)
      <option value="{{ $s->id }}" @selected($semesterId==$s->id)>{{ $s->name }}</option>
    @endforeach
  </select>
  <button class="bg-gray-700 text-white px-3 py-2">Lihat</button>
</form>

<table class="w-full bg-white">
  <thead><tr><th>MK</th><th>SKS</th><th>Nilai Akhir</th></tr></thead>
  <tbody>
  @foreach($enrollments as $en)
    <tr>
      <td>{{ $en->classOffering->course->name }}</td>
      <td>{{ $en->classOffering->course->credits }}</td>
      <td>{{ $en->grade?->final_grade ?? '-' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection