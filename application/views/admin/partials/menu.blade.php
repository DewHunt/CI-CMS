@php
    use App\Menu;
    use App\MenuAction;
    use App\UserRoles;

    $userMenus = Menu::where('status',1)->orderBy('order_by','ASC')->get();
    $roleId =  Auth::user()->role;
    $userRoles = UserRoles::where('id',$roleId)->first();
    $routeName = \Request::route()->getName();
    $userMenuAction = MenuAction::where('action_link',$routeName)->first();

    if ($userMenuAction)
    {
        $childMenuRoute = Menu::where('id',@$userMenuAction->parent_menu_id)->first();
        $parentMenuRoute = Menu::where('id',@$childMenuRoute->parent_menu)->first();
        $rootMenuRoute = Menu::where('id',@$parentMenuRoute->parent_menu)->first();
    }
    else
    {
        $childMenuRoute = Menu::where('menu_link',@$routeName)->first();
        $parentMenuRoute = Menu::where('id',@$childMenuRoute->parent_menu)->first();
        $rootMenuRoute = Menu::where('id',@$parentMenuRoute->parent_menu)->first();
    }
@endphp
            <aside class="left-sidebar">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            @foreach ($userMenus as $rootMenu)
                                @php
                                    $rolePermission = explode(',', $userRoles->permission);
                                @endphp

                                @if (in_array($rootMenu->id, $rolePermission))
                                    @if ($rootMenu->parent_menu == null)
                                        @php
                                            // $rootMenuLink = $rootMenu->menu_link;
                                            $parentMenus = Menu::orderBy('order_by','ASC')
                                                ->where('parent_menu',$rootMenu->id)
                                                ->where('status',1)
                                                ->get();

                                            $countParentMenu = count(@$parentMenus);

                                            if (@$rootMenuRoute->id == $rootMenu->id || @$parentMenuRoute->id == $rootMenu->id)
                                            {
                                                $rootMenuActive = 'active';
                                                $expandRoot = 'in';
                                            }
                                            else
                                            {
                                                $rootMenuActive = '';
                                                $expandRoot = '';
                                            }
                                        @endphp

                                        <li>
                                            @if (@$countParentMenu > 0)
                                                <a class="has-arrow waves-effect waves-dark {{$rootMenuActive}}" href="javascript:void(0)" aria-expanded="false">
                                                    <i class="ti-layout-grid2"></i>
                                                    <span class="hide-menu">{{ $rootMenu->menu_name }}</span>
                                                </a>
                                                <ul aria-expanded="false" class="collapse {{$expandRoot}}">
                                                    @foreach ($parentMenus as $parentMenu)
                                                        @php
                                                            $rolePermission = explode(',', $userRoles->permission);
                                                        @endphp

                                                        @if (in_array($parentMenu->id, $rolePermission))
                                                            @if ($parentMenu->parent_menu == null)
                                                                @php
                                                                    // $rootMenuLink = $rootMenu->menu_link;
                                                                    $childMenus = Menu::orderBy('order_by','ASC')
                                                                        ->where('parent_menu',$parentMenu->id)
                                                                        ->where('status',1)
                                                                        ->get();

                                                                    $countChildMenu = count(@$childMenus);

                                                                    if (@$parentMenuRoute->id == $parentMenu->id || @$childMenuRoute->id == $parentMenu->id)
                                                                    {
                                                                        $childMenuActive = 'active';
                                                                        $expandChild = 'in';
                                                                    }
                                                                    else
                                                                    {
                                                                        $childMenuActive = '';
                                                                        $expandChild = '';
                                                                    }
                                                                @endphp
                                                            @endif

                                                            <li>
                                                                @if (@$countChildMenu > 0)
                                                                    <a class="has-arrow waves-effect waves-dark {{$childMenuActive}}" href="javascript:void(0)" aria-expanded="false">
                                                                        <i class="ti-layout-grid2"></i>
                                                                        <span class="hide-menu">{{ $parentMenu->menu_name }}</span>
                                                                    </a>
                                                                    <ul aria-expanded="false" class="collapse {{ $expandChild }}">
                                                                        @foreach (@$childMenus as $childMenu)
                                                                            @php
                                                                                $rolePermission = explode(',', $userRoles->permission);
                                                                            @endphp

                                                                            @if (in_array($childMenu->id, $rolePermission))
                                                                                @php
                                                                                    if (@$childMenuRoute->id == $childMenu->id)
                                                                                    {
                                                                                        $activeMenu = 'active';
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $activeMenu = '';
                                                                                    }
                                                                                @endphp
                                                                                <li>
                                                                                    <a href="{{ route($parentMenu->menu_link) }}">{{ $parentMenu->menu_name }}</a>
                                                                                </li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                @else
                                                                    <li>
                                                                        <a class="waves-effect waves-dark" href="{{ route($parentMenu->menu_link) }}" aria-expanded="false">
                                                                            <i class="fa fa-arrow-right text-danger"></i> <span class="hide-menu">{{ $parentMenu->menu_name }}</span>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @else
                                                <li>
                                                    <a class="waves-effect waves-dark" href="{{ route($rootMenu->menu_link) }}" aria-expanded="false">
                                                        <i class="ti-layout-grid2 text-danger"></i>
                                                        <span class="hide-menu">{{ $rootMenu->menu_name }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </li>
                                    @endif
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>