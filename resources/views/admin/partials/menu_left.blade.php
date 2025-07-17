<div class="sidebar">
      <div class="logo-details">
        <i class="bx bxs-box"></i> 
        <span class="logo_name">Gestion Stock</span> 
      </div>
      <ul class="nav-links">
        <li>
          <a href="{{route('admin.dashboard')}}" class="links_name">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('produits')}}">
            <i class="bx bx-package"></i> <span class="links_name">Produits</span> 
          </a>
        </li>
        <li>
          <a href="{{route('mouvements')}}">
            <i class="bx bx-transfer"></i> <span class="links_name">Mouvements</span> 
          </a>
        </li>
        <li>
          <a href="{{route('profil')}}">
            <i class="bx bx-user"></i> <span class="links_name">Profil</span> 
          </a>
        </li>

      </li>
      <li>

        <a href="{{route('admin.users')}}">
          <i class="bx bx-shield"></i> <span class="links_name">Users</span> 
        </a>
        <a href="{{route('admin.commandes.index')}}">
          <i class="bx bx-list-ul"></i> <span class="links_name">Commandes</span> 
        </a>

      </li>



      <li class="log_out">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="bx bx-log-out"></i> <span class="links_name">Se déconnecter</span>
        </a>
        <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
          @csrf
        </form>
      </li>
      
      </ul>
    </div>

  