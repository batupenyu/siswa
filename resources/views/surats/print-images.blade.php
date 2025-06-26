<!DOCTYPE html>
<html>
<head>
    <title>Print Images</title>
    <style>
        body { margin: 0; padding: 10px; }
        .print-page { display: flex; flex-wrap: wrap; gap: 10px; }
        .print-img { width: 200px; height: auto; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="print-page">
        @foreach($surat->images as $image)
            <img class="print-img" src="{{ asset('storage/' . $image->path) }}" alt="Image">
        @endforeach
    </div>
    <script>
        window.onload = () => {
            window.print();
        };
    </script>
</body>
</html>