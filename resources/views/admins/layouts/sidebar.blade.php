<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      @php
       $permissionUser = App\Models\PermissionRole::getPermission('User', Auth::user()->role_id); 
       $permissionRole = App\Models\PermissionRole::getPermission('Role', Auth::user()->role_id); 
       $permissionCategory = App\Models\PermissionRole::getPermission('Category', Auth::user()->role_id); 
       $permissionProduct = App\Models\PermissionRole::getPermission('Product', Auth::user()->role_id);
       $permissionProductImage = App\Models\PermissionRole::getPermission('Product Image', Auth::user()->role_id); 
       $permissionSize = App\Models\PermissionRole::getPermission('Size', Auth::user()->role_id); 
       $permissionColor = App\Models\PermissionRole::getPermission('Color', Auth::user()->role_id); 
       $permissionProductVariant = App\Models\PermissionRole::getPermission('Product Variant', Auth::user()->role_id); 
       $permissionOrderStatus = App\Models\PermissionRole::getPermission('Order Status', Auth::user()->role_id); 
       $permissionOrder = App\Models\PermissionRole::getPermission('Order', Auth::user()->role_id);
       $permissionOrderItem = App\Models\PermissionRole::getPermission('Order Item', Auth::user()->role_id);
       $permissionComment = App\Models\PermissionRole::getPermission('Comment', Auth::user()->role_id);
       $permissionRating = App\Models\PermissionRole::getPermission('Rating', Auth::user()->role_id);
       $permissionBanner = App\Models\PermissionRole::getPermission('Banner', Auth::user()->role_id); 
       $permissionSettings = App\Models\PermissionRole::getPermission('Setting', Auth::user()->role_id); 
      @endphp
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/panel/dashboard') }}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      @if(!empty($permissionRole))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('roles.index') }}">
          <span>Roles</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionUser))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('users.index') }}">
          <span>Users</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionCategory))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('categories.index') }}">
          <span>Categories</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionProduct))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('products.index') }}">
          <span>Products</span>
        </a>
      </li>
      @endif 


      @if(!empty($permissionProductImage))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Product Images</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionSize))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Sizes</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionColor))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Colors</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionProductVariant))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Product Variants</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionOrderStatus))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Order Statuses</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionOrder))
      <li class="nav-item">
        <a href="{{ url('/panel/orders') }}" class="nav-link collapsed">
          <span>Orders</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionComment))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Comments</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionRating))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Ratings</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionBanner))
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('banners.index') }}">
          <span>Banners</span>
        </a>
      </li>
      @endif 
      @if(!empty($permissionSettings))
      <li class="nav-item">
        <a class="nav-link collapsed">
          <span>Settings</span>
        </a>
      </li>
      @endif 
    </ul>
  </aside>