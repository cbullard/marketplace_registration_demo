<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        <link href="https://unpkg.com/tailwindcss@1.0.4/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
            margin: {
                '5px': '5px',
            }
        },
    }
  </script>
        <style>
        .body-bg {
            background-color: #fff;
        }
        </style>
    
        <div id="app">
            <seller-registration></seller-registration>
        </div>
</html>

<script src="{{ asset('js/vue/seller-registration/app.js') }}"></script>