
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
          <ul class="header-megamenu nav">
              <li class="btn-group nav-item d-md-none">
                  <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu" role="button">
                      <span class="icon-Align-left"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                  </a>
              </li>
          </ul> 
        </div>
          
        <div class="navbar-custom-menu r-side">
          <ul class="nav navbar-nav">	
              <li class="btn-group nav-item d-lg-inline-flex d-none">
                  <a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link full-screen" title="Full Screen">
                      <i class="icon-Expand-arrows"><span class="path1"></span><span class="path2"></span></i>
                  </a>
              </li>	  
              <li class="btn-group d-lg-inline-flex d-none">
                  <div class="app-menu">
                      <div class="search-bx mx-5">
                          <livewire:search.search-form />
                      </div>
                  </div>
              </li>
            
            <!-- User Account-->
            <li class="dropdown user user-menu">
              <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="User">
                  <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
              </a>
              <ul class="dropdown-menu animated flipInX">
                <li class="user-body">
                   <a class="dropdown-item" href="#"><i class="ti-user text-muted mr-2"></i> Profile</a>
                   <div class="dropdown-divider"></div>
                      <!-- Authentication -->
                      <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="dropdown-item" href="route('logout')"
                        onclick="event.preventDefault();  this.closest('form').submit();"><i class="ti-lock text-muted mr-2"></i> {{ __('Log Out') }}</a>
                    </form>
                </li>
              </ul>
            </li>	
            
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="{{ route('settings.index') }}"  title="Setting" class="waves-effect waves-light">
                    <i class="icon-Settings"><span class="path1"></span><span class="path2"></span></i>
                </a>
            </li>
              
          </ul>
        </div>
      </nav>