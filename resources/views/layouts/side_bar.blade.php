<nav class="sb-sidenav accordion sb-sidenav-dark " id="sidenavAccordion" style="background-color: #e2e4f3;">
   <div class="sb-sidenav-menu">
      <div class="nav">
         <a  href="{{route('department.account')}}" class="text-center">
         <img src="/admin/images/fire-logo.png" style="width: 80px;" />


         </a>
         
         <a class="nav-link side-menu" href="{{route('department.account')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
         </a>

         <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#location" aria-expanded="false" aria-controls="location">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Location 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>

         <div class="collapse" id="location" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="margin-left: .5rem;">
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
            <nav class="sb-sidenav-menu-nested nav" style="margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.station')}}" >Fire Stations</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.deputyDirector')}}" >Deputy Director </a>  
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.cfo')}}" >CFO</a>   
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.fso')}}" >FSO</a>         
            </nav>
         </div>

         <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#master" aria-expanded="false" aria-controls="master">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Master 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>

         <div class="collapse" id="master" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.category')}}">Category</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.subcategory')}}">Sub Category</a>  
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('admin.type')}}">Type </a>   
            </nav>
         </div>

         <a class="nav-link collapsed side-menu" href="#" data-toggle="collapse" data-target="#fireActivity" aria-expanded="false" aria-controls="fireActivity">
            <div class="sb-nav-link-icon"><i class="fas fa-truck-moving"></i></div>
            Fire Activities 
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
         </a>

         <div class="collapse" id="fireActivity" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav" style="margin-left: .5rem;">
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('department.standby')}}" >Stand By</a>
               <a class="nav-link sub_nav_link side-menu-sub" href="{{route('department.awareness')}}" >Awareness Program </a> <a class="nav-link sub_nav_link side-menu-sub" href="{{route('department.incident')}}" >Incident Report</a>   
            </nav>
         </div>

         <a class="nav-link side-menu" href="{{route('department.fireReport')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Fire Report
         </a>

         <a class="nav-link side-menu" href="{{route('department.rescue')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Rescue Report
         </a>

         <a class="nav-link side-menu" href="{{route('department.relief')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Relief Report
         </a>

         <a class="nav-link side-menu" href="{{route('department.hydrant')}}">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Fire Hydrant Report
         </a>

      </div>
   </div>
</nav>