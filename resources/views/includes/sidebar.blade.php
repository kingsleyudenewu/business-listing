<?php
$menu = [];
foreach (config('menu') as $key => $value) {
    $menu[] = $value;
}
?>


<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                @foreach($menu as $key => $value)

                    @if(!is_null($value['parent']) && is_array($value['parent']) &&
                    \Athlotek\UserManagement\Models\User::find(auth()->user()->id)
                    ->hasPermissionTo($value['permissions']))
                        <li>
                            <a href="javascript:void(0);" class="waves-effect">
                                <i class="{{ !is_null($value['icon']) ? $value['icon'] : ""
                                    }}"></i>
                                <span>
                                    {{ $value['label'] }}
                                    <span class="float-right menu-arrow">
                                        <i class="mdi mdi-chevron-right"></i>
                                    </span>
                                </span>
                            </a>
                            <ul class="submenu">
                                @foreach($value['parent'] as $children)
                                    @if(\Athlotek\UserManagement\Models\User::find(auth()->user()->id)
                    ->hasPermissionTo($children['permissions']))
                                        <li>
                                            <a href="{{ $children['route-name'] }}">
                                                {{ $children['label'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        @if(\Athlotek\UserManagement\Models\User::find(auth()->user()->id)
                    ->hasPermissionTo($value['permissions']))
                            <li>
                                <a href="@if($value['route-name'] == "") #!@else {{ route(
                            $value['route-name'] ) }} @endif"
                                   class="waves-effect">
                                    <i class="ti-home"></i><span>{{ $value['label'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
