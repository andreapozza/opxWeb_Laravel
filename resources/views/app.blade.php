<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script>
      const APP_NAME = "{{ config('app.name') }}";
    </script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
  </head>
  <body class="bg-amber-600 font-sans leading-normal tracking-normal">
    @inertia

    @if (app()->isLocal())
      <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
    @endif
  </body>
</html>