<form method="POST" enctype="multipart/form-data" action="{{ route('...') }}">
  @csrf
  <input type="file" name="file" class="border p-2">
  <button class="bg-blue-600 text-white px-4 py-2">Upload</button>
</form>