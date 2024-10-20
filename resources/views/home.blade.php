<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>URL Shortener</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100 flex min-h-screen items-center justify-center">
    <div class="w-96 rounded-lg bg-white p-8 shadow-md">
      <h1 class="mb-4 text-2xl font-bold">URL Shortener</h1>
      <form id="urlForm" class="mb-4">
        <input
          type="url"
          id="urlInput"
          placeholder="Enter URL to shorten"
          required
          class="mb-2 w-full rounded border p-2"
        />
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 w-full rounded p-2 text-white">
          Shorten URL
        </button>
      </form>
      <div id="result" class="hidden">
        <p>Shortened URL: <a id="shortUrl" href="#" target="_blank" class="text-blue-500"></a></p>
      </div>
    </div>

    <script>
      document.getElementById('urlForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const url = document.getElementById('urlInput').value;
        const response = await fetch('/shorten', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
          },
          body: JSON.stringify({ url }),
        });
        const data = await response.json();
        document.getElementById('shortUrl').href = data.short_url;
        document.getElementById('shortUrl').textContent = data.short_url;
        document.getElementById('result').classList.remove('hidden');
      });
    </script>
  </body>
</html>