<ul class="nav nav-tabs flex justify-around  flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <a href="/admin/detailed/report" class="{{ request()->is('admin/detailed/report') ? 'active' : '' }}  nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 py-2 my-2 hover:border-transparent focus:border-transparent  dark:text-slate-300">CAA</a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="/admin/detailed/report/ocean" class="{{ request()->is('admin/detailed/report/ocean') ? 'active' : '' }} nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 py-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300">OCEAN</a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="/admin/detailed/report/riasec" class="{{ request()->is('admin/detailed/report/riasec') ? 'active' : '' }}  nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 py-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300">RIASEC</a>
    </li>
    <li class="nav-item" role="presentation">
      <a href="/admin/detailed/report/english" class="{{ request()->is('admin/detailed/report/english') ? 'active' : '' }}  nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 py-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" >ENGLISH</a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="/admin/detailed/report/all" class="{{ request()->is('admin/detailed/report/all') ? 'active' : '' }} nav-link w-full block font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 py-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300">All</a>
      </li>
  </ul>