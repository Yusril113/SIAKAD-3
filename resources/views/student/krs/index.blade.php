@extends('layouts.app')
@section('title','KRS')
@section('content')
<h1 class="text-xl font-bold mb-4">KRS Semester {{ $currentSemester?->name }}</h1>

<div class="grid grid-cols-2 gap-6">
  <div>
    <h2 class="font-semibold mb-2">Pilihan Kelas</h2>
    <form method="POST" action="{{ route('krs.store') }}">
      @csrf
      <select name="class_offering_id" class="border p-2 w-full mb-2">
        @foreach($offerings as $o)
          <option value="{{ $o->id }}">
            {{ $o->course->code }} - {{ $o->course->name }} ({{ $o->section }}) - Dosen: {{ $o->lecturer->user->name }}
          </option>
        @endforeach
      </select>
      <button class="bg-blue-600 text-white px-4 py-2">Tambah KRS</button>
    </form>
  </div>
  <div>
    <h2 class="font-semibold mb-2">KRS Saya</h2>
    <ul class="list-disc ml-5">
      @foreach($myEnrolls as $en)
        <li>{{ $en->classOffering->course->name }} ({{ $en->classOffering->section }})</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection