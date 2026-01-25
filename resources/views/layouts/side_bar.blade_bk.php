<nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion" style="    background-color: #e2e4f3;">
   <div class="sb-sidenav-menu">
      <div class="nav">
           <a  href="{{route('admin.home')}}" class="text-center">
            <img src="{{asset('admin/images/fire-logo.png')}}" style="width: 80px;" />
           
         </a>
         <a class="nav-link side-menu" href="{{route('admin.home')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
         </a>
          <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#location" aria-expanded="false" aria-controls="location">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Location 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>
         <div class="collapse" id="location" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="    margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.state')}}">State</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.district')}}">District</a>            
            </nav>
         </div>

   <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#department" aria-expanded="false" aria-controls="department">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Department 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>
         <div class="collapse" id="department" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="    margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.station')}}" >Stations</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.deputyDirector')}}" >Deputy Director </a>  
                <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.cfo')}}" >CFO </a>   
                <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.fso')}}" >FSO </a>         
            </nav>
         </div>


  <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#master" aria-expanded="false" aria-controls="master">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Master 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>
         <div class="collapse" id="master" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="    margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.category')}}" >Category</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.subcategory')}}" >Sub Category</a>  
                <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.type')}}" >Type </a>   
                     
            </nav>
         </div>

      </div>
   </div>
</nav>