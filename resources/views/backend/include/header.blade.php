@php    $link = $_SERVER['PHP_SELF']; @endphp
@php    $link_array = explode('/',$link); @endphp
@php    $page = end($link_array); @endphp
<style>
.user-dp {
    width: 100%;
    cursor: pointer;
}
.user-dp .info {
    vertical-align: middle;
}
.user-panel ul.dp-mn {
    width: 100%;
    clear: both;
    display: none;
    margin-top: 15px;
    border-top: 1px solid #4f5962;
}
.user-panel ul.dp-mn .far, .user-panel ul.dp-mn p {
    display: inline-block;
    margin-right: 7px;
    margin-bottom: 0;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="javascript:;" class="brand-link">
    <img src="{{ asset('/backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Nifticals Dashboard</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3">
    <div class="user-dp">
      <div class="image">
        <img src="{{ asset('/backend/dist/img/Satirtha.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="javascript: ;" class="d-block">Super Admin</a>
        
      </div>
      
        
      </div>
      <ul class="nav nav-treeview dp-mn">
            <li class="nav-item">
              <a href="#"  class="nav-link @if($page == 'change-password') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Change Password</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{ route('admin.dashboard') }}" class="nav-link @if($page == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
       
        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'product-category') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Category
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.show-category') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Category</p>
             </a>
           </li>
         </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'product-sub-category') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Sub Category
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.show-sub-category') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Sub Category</p>
             </a>
           </li>
         </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'product-details') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Product
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.show-product') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Product</p>
             </a>
           </li>
         </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'auction-product') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Auction Product
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.auction.product') }}" class="nav-link @if($page == 'auction-product') active @endif">
               <i class="far fa-circle nav-icon"></i>
               <p>View Auction Product</p>
             </a>
           </li> -->
           <!-- <li class="nav-item">
             <a href="{{ route('admin.show-banner') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Auction </p>
             </a>
           </li>
         </ul>
        </li>
        
        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'subscriber') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Subscribers
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.show-subscriber') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Subscribers</p>
             </a>
           </li>
         </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'payment') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Payment
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.payment-show') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Payment</p>
             </a>
           </li>
         </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'banner') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Banner
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.show-banner') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Banner</p>
             </a>
           </li>
         </ul>
        </li>

        

        <li class="nav-item has-treeview">
          <a href="javascript: ;" class="nav-link @if($page == 'order-details') active @endif">
            <i class="nav-icon fas fa-edit"></i>
              <p>
              Order Details
              <i class="fas fa-angle-left right"></i>
            </p>
         </a>
         <ul class="nav nav-treeview">
           <li class="nav-item">
             <a href="{{ route('admin.order-details') }}" class="nav-link">
               <i class="far fa-circle nav-icon"></i>
               <p>View Order Details</p>
             </a>
           </li>
         </ul>
        </li>
        
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

  <!-- logout functions -->
  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf
  </form>
  <!-- end of logout function -->
</aside>
    