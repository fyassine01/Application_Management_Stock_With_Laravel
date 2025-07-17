<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>@yield('titre')</title>
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}" />
    <!-- Boxicons CDN Link -->
    <link
      href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
        @include('admin/partials/menu_left')

        <section class="home-section">
        @include('admin/partials/menu_haut')
        <div class="home-content">
            @yield('page')
        </div> 
        </section>

        <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };

      ///////
    </script>

    <body>

