<form action="{{ route('surats.uploadImages', $surat->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="images[]" multiple>
    <button type="submit" class="btn btn-info btn-sm">Upload Images</button>
</form>