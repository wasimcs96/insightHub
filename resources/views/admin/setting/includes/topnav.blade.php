<ul class="nav nav-pills flex items-center mt-5 flex-wrap list-none pl-0 mb-6 space-x-4 " id="pills-tabHorizontal" role="tablist">
    <li class="nav-item text-center" role="presentation">
        <a href="/admin/setting/weightage" class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0  dark:bg-slate-900 dark:text-slate-300  {{ request()->segment(3) === 'weightage' ? 'active' : '' }}" id="pills-home-tabHorizontal" aria-controls="pills-homeHorizontal" aria-selected="true">Manage Talent Weightage</a>
    </li>
    <li class="nav-item text-center" role="presentation">
        <a href="/admin/setting/job-description" class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-300 {{ request()->segment(3) === 'job-description' ? 'active' : '' }}" id="pills-contact-tabHorizontal" aria-controls="pills-contactHorizontal" aria-selected="false">Manage Job Description</a>
    </li>

    <li class="nav-item text-center" role="presentation">
        <a href="/admin/setting/team-dynamics" class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-300  {{ request()->segment(3) === 'team-dynamics' ? 'active' : '' }}" id="pills-profile-tabHorizontal" aria-controls="pills-profileHorizontal" aria-selected="false">Team Dynamics</a>
    </li>

    {{-- <li class="nav-item text-center" role="presentation">
      <a href="/admin/setting/matching" class="nav-link block font-medium font-Inter text-sm leading-tight capitalize rounded-md px-6 py-3 focus:outline-none focus:ring-0 dark:bg-slate-900 dark:text-slate-300  {{ request()->segment(3) === 'matching' ? 'active' : '' }}" id="pills-profile-tabHorizontal" aria-controls="pills-profileHorizontal" aria-selected="false">Talent Pool Matching</a>
    </li> --}}


</ul>
