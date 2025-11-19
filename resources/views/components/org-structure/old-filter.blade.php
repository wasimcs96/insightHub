<div id="offcanvasRight"
  class="offcanvas offcanvas-end"
  data-bs-scroll="false">
    <div class="offcanvas-header">
        <div class="d-flex gap-2 align-items-center">
            <h5 class="offcanvas-title">Filters <span class="total-filter-count">(0)</span></h5>
            {{-- <p class="m-0 clear-filters" id="clear-filters-button">Clear filters</p> --}}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="padding-bottom: 120px;">

        <!-- Business Unit -->
        <div class="filter-block mb-4" data-type="Business Unit" data-key="bu">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Business Unit <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear filters</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box" data-select="box">
                    <span class="selected-label">0 Business Unit(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search for Business Unit">
                    </div>
                    <div class="options-list" data-list="bu"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        <hr>

        <!-- Company/Division -->
        <div class="filter-block mb-4" data-type="Company/Division" data-key="company">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Company/Division <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear filters</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Company/Division(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Company/Division">
                    </div>
                    <div class="options-list" data-list="company"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        <hr>

        <!-- Departments -->
        <div class="filter-block mb-4" data-type="Departments" data-key="department">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">Departments <span class="filter-count">(0)</span></h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear filters</p>
            </div>
            <div class="select-wrapper">
                <div class="select-box disabled" data-select="box">
                    <span class="selected-label">0 Departments(s) selected</span>
                    <span class="arrow"><iconify-icon icon="fluent:chevron-down-16-filled" width="16" height="16" style="color: #78829D;"></iconify-icon></span>
                </div>
                <div class="dropdown" style="display:none;">
                    <div class="search-input d-flex align-items-center gap-2 py-4 px-3">
                        <iconify-icon icon="stash:search-solid" width="16" height="16"></iconify-icon>
                        <input type="text" class="search-box border-0" placeholder="Search For Departments">
                    </div>
                    <div class="options-list" data-list="department"></div>
                    <div class="dropdown-footer">
                        <button class="btn-reset" data-action="reset">Reset</button>
                        <button class="btn-filter" data-action="apply">Filter</button>
                    </div>
                </div>
                <div class="selected-tags d-flex flex-wrap gap-2 mt-3" data-tags="true"></div>
            </div>
        </div>

        <hr>

        {{-- Vacancy Status --}}
{{-- Vacancy Status --}}
<div class="filter-block mb-4" data-type="Vacancy Status" data-key="vacancy">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="filter-side-heading mb-0">Vacancy Status <span class="filter-count">(0)</span></h5>
        <p class="m-0 clear-filters text-decoration-underline section-clear">Clear filters</p>
    </div>
    <div class="form-group">
        <select class="form-control" id="vacancyStatus" name="vacancy_status">
            <option value="">All Statuses</option>
            <option value="vacant">Vacant</option>
            <option value="filled">Filled</option>
        </select>
    </div>
</div>
<hr>
        
       

        <!-- Levels -->
        {{-- <div class="filter-block mb-4" data-type="Levels" data-key="levels">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="filter-side-heading mb-5">
                    Position Level <span class="filter-count" id="total-filter-level-count">(0)</span>
                </h5>
                <p class="m-0 clear-filters text-decoration-underline section-clear">Clear filters</p>
            </div>

            <!-- First 5 levels visible -->
            <div class="levels-grid" id="levels-top"></div>
            <!-- Remaining levels hidden initially -->
            <div class="levels-container" id="levels-more" style="display:none;"></div>
            <div class="show-more-btn">Show More</div>
        </div> --}}

        <div class="d-flex gap-3 footer-btn">
            <button type="button" class="clear-filter" id="footer-clear">Clear Filters</button>
            <button id="apply-filters-button" class="apply-filters" type="button">Apply Filters</button>
        </div>

        <pre id="filters-json" class="mt-3 bg-light p-2 rounded small d-none" style="max-height:140px;overflow:auto;">{}</pre>
    </div>
</div>
@push('scripts')
<script>
function debounce(fn, delay=300){
  let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
}
(function(){

      const showBtn = document.getElementById('showDetailsBtn');
      document.addEventListener('DOMContentLoaded', function () {
        
        const detailsPanel = document.getElementById('detailsPanel');
        let isLoaded = false;

        showBtn.style.display = 'flex';
        detailsPanel.style.display = 'none';

        showBtn.addEventListener('click', function() {
            showBtn.style.display = 'none';
            detailsPanel.style.display = 'flex';
        });
      });

        function loadOrganizationDetails(data) {
            detailsPanel.innerHTML = '<div class="text-center p-4"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>';

            if (data) {
                detailsPanel.innerHTML = buildDetailsHTML(data);
                isLoaded = true;
                attachCollapseListener();
            } else {
                detailsPanel.innerHTML = '<div class="alert alert-danger">Failed to load data</div>';
            }
        }

        function buildDetailsHTML(data) {
            return `
                <div class="elements-chart-organization elements-chart-inner">
                    <div class="d-flex justify-content-between mb-4 gap-2">
                        <h4 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${data.headerText}">${data.headerText}</h4>
                        <p id="collapseBtn" class="m-0 d-flex align-items-center gap-1" type="button"
                            style="color: #F7941C; text-decoration-line: underline; cursor: pointer;">
                            <iconify-icon icon="f7:chevron-left-2" width="14" height="14"></iconify-icon> Collapse
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <div class="tags-elements d-flex align-items-center gap-1">
                            <img src="/admin/media/svg/org-chart-svg/department-chart.svg" alt="department">
                            <p class="m-0">${data.departments}</p>
                        </div>
                        <div class="tags-elements d-flex align-items-center gap-1">
                            <img src="/admin/media/svg/org-chart-svg/job-position-chart.svg" alt="job-position">
                            <p class="m-0">${data.jobPositions}</p>
                        </div>
                        <div class="tags-elements d-flex align-items-center gap-1">
                            <img src="/admin/media/svg/org-chart-svg/employee-chart.svg" alt="employee">
                            <p class="m-0">${data.employees}/${data.totalPositions}</p>
                        </div>
                        <div class="tags-elements d-flex align-items-center gap-1">
                            <img src="/admin/media/svg/org-chart-svg/vacancy-chart.svg" alt="vacancy">
                            <p class="m-0">${data.vacancies}</p>
                        </div>
                        <div class="tags-elements d-flex align-items-center gap-1">
                            <img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg" alt="critical-job-position">
                            <p class="m-0">${data.criticalPositions}</p>
                        </div>
                    </div>
                </div>

                <div class="elements-chart-position elements-chart-inner">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="d-flex align-items-center gap-3 mb-4">Open Positions</h4>
                    </div>
                    <div class="row mb-3">
                        <p class="m-0 col-8 heading">Job Position</p>
                        <p class="col-4 m-0 text-center heading">Vacancy</p>
                    </div>
                    ${buildOpenPositionsHTML(data.openPositions)}
                    ${data.openPositions.length > 3 ? '<a href="/admin/talent-acquisition/job-board" target="_blank"><p class="m-0 more-details-btn">More Details</p></a>' : ''}
                </div>
            `;
        }

        function buildOpenPositionsHTML(positions) {
          return positions.map(position => {
              const titleLength = position.title.length;
              const displayTitle = titleLength > 30 ? position.title.substring(0, 30) + '...' : position.title;
              
              return `
                  <div class="row mb-3">
                      <div class="col-8">
                          <p class="m-0 content ${position.isCritical ? 'd-flex align-items-center gap-2' : ''}">
                              <span class="job-position-name" 
                                    data-full-title="${position.title}" 
                                    title="${position.title}">
                                  ${displayTitle}
                              </span>
                              ${position.isCritical ? '<img src="/admin/media/svg/org-chart-svg/critical-job-position-chart.svg" alt="critical-job-position">' : ''}
                          </p>
                      </div>
                      <p class="col-4 m-0 content text-center">${position.vacancy}</p>
                  </div>
              `;
          }).join('');
      }

        function attachCollapseListener() {
            const collapseBtn = document.getElementById('collapseBtn');
            if (collapseBtn) {
                collapseBtn.addEventListener('click', function() {
                    detailsPanel.style.display = 'none';
                    showBtn.style.display = 'flex';
                });
            }
        }

  const DUMMY = {
    bu: [
      {id:1, name:"Business Support Partners"},
      {id:2, name:"Commissary Business Operations"},
      {id:3, name:"Store Business Operations - Conti's"},
      {id:4, name:"Store Business Operations - Wendy's"},
      {id:5, name:"Store Business Operations - Masuma"},
    ],
    companiesByBU: {
      1: [ {id:6, name:"Conti's BSP"} ],
      2: [ {id:7, name:"Conti's CBO"} ],
      3: [ {id:8, name:"Conti's Specialty Foods, Inc. (SBO-Conti's)"}, {id:9, name:"Conti's Various Companies"} ],
      4: [ {id:10, name:"Masuma Food Industry Inc."} ],
      5: [ {id:11, name:"Wendy's Group"} ],
    },
    departmentsByCompany: {
      6:[{id:11,name:'Delivery'},{id:12,name:'Human Resources'}],
      7:[{id:13,name:'Inventory Management'}],
      8:[{id:14,name:'Operations'}],
      9:[{id:15,name:'Purchasing'}],
      10:[{id:16,name:'Finance'}],
      11:[{id:17,name:'QA'}],
    },
    levelLabels: {
      '1':'Level 1','2':'Level 2','3':'Level 3','4':'Level 4','5':'Level 5','6':'Level 6','7':'Level 7','8':'Level 8','9':'Level 9','10':'Level 10'
    },
    levelCounts: {
      default: {'1':60,'2':20,'3':20,'4':20,'5':6,'6':2,'7':0,'8':0,'9':0,'10':0},
      byBU: {
        1:{'1':40,'2':10,'3':5,'4':5,'5':0,'6':0,'7':0,'8':0,'9':0,'10':0},
        2:{'1':5,'2':10,'3':15,'4':0,'5':0,'6':2},
        3:{'1':8,'2':8,'3':4,'4':0,'5':1},
        4:{'1':12,'2':6,'3':4,'4':2,'5':5},
        5:{'1':6,'2':4,'3':2,'4':1,'5':0}
      }
    }
  };

  const state = { buIds: [], companyIds: [], departmentIds: [], levels: [], vacancy_status: '' };

  const $  = (s,scope=document)=>scope.querySelector(s);
  const $$ = (s,scope=document)=>Array.from(scope.querySelectorAll(s));

  const LEVELS_ENABLED = !!document.querySelector('[data-key="levels"]');

  function buildOptions(listEl, items, selectedIds = []){
        if(!listEl) return;
        listEl.innerHTML = (items || []).map(it=>`
            <label class="checkbox-option">
            <div class="w-100">
                <label class="custom-checkbox m-0">
                <input type="checkbox" value="${it.id}" data-label="${it.name}" ${selectedIds.includes(it.id) ? 'checked' : ''}>
                <span class="checkmark"></span>
                ${it.name}
                </label>
            </div>
            </label>
        `).join('');
        if(!items || !items.length){
            listEl.innerHTML = '<div class="p-2 text-muted">No data</div>';
        }
    }

 const API = { 
    bu: '{{ url('/admin/ajax/organization-chart-filter/business-unit') }}',
    company: '{{ url('/admin/ajax/organization-chart-filter/company-division') }}',
    department: '{{ url('/admin/ajax/organization-chart-filter/departments') }}',
    headcountCodes: '{{ url('/admin/ajax/organization-chart-filter/headcount-codes') }}'
  };
 
 async function loadBusinessUnits(term = ''){
  const listEl = document.querySelector('[data-list="bu"]');
  if(!listEl) return;
  listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
  try {
    const url = term ? `${API.bu}?q=${encodeURIComponent(term)}` : API.bu;
    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
    if(!res.ok) throw new Error('BU load failed');
    const data = await res.json();
    buildOptions(listEl, data.data, state.buIds);
  } catch (e) {
    console.warn('BU fetch failed, using fallback', e);
    buildOptions(listEl, DUMMY.bu, state.buIds);
  }
}

async function loadCompanies(buIds, term = '') {
  const listEl = document.querySelector('[data-list="company"]');
  if (!listEl) return;

  listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
  try {
    const res = await fetch(API.company, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ bu_ids: buIds, q: term,_token: '{{ csrf_token() }}' })
    });
    if (!res.ok) throw new Error('Company/Division load failed');
    const data = await res.json();
    const items = Array.isArray(data) ? data : (data.data || []);
    buildOptions(listEl, items, state.companyIds);
  } catch (e) {
    console.warn('Company/Division fetch failed:', e);
    buildOptions(listEl, [], state.companyIds);
  }
}

async function loadDepartments(companyIds, buIds = [], term = '') {
  const listEl = document.querySelector('[data-list="department"]');
  if (!listEl) return;

  listEl.innerHTML = '<div class="p-2 text-muted">Loading…</div>';
  try {
    const res = await fetch(API.department, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        company_ids: companyIds,
        bu_ids: buIds,
        q: term,
        _token: '{{ csrf_token() }}'
      })
    });
    if (!res.ok) throw new Error('Departments load failed');
    const data = await res.json();
    const items = Array.isArray(data) ? data : (data.data || []);
    buildOptions(listEl, items, state.departmentIds);
  } catch (e) {
    console.warn('Departments fetch failed:', e);
    buildOptions(listEl, [], state.departmentIds);
  }
}

  apply();
  loadBusinessUnits();

  // Handle vacancy status select change
  document.getElementById('vacancyStatus')?.addEventListener('change', function() {
    state.vacancy_status = this.value;
    updateVacancyCount();
    updateHeaderCount();
  });

  function updateVacancyCount() {
    const countSpan = document.querySelector('[data-key="vacancy"] .filter-count');
    if (countSpan) {
      countSpan.textContent = state.vacancy_status ? '(1)' : '(0)';
    }
  }

  document.addEventListener('click', (e)=>{
    const box = e.target.closest('[data-select="box"]');
    if(box){
      const wrap = box.closest('.select-wrapper');
      const dd = wrap.querySelector('.dropdown');
      const isOpen = dd.style.display==='block';
      $$('.dropdown').forEach(x=>x.style.display='none');
      dd.style.display = isOpen ? 'none' : 'block';
      return;
    }
    if(!e.target.closest('.dropdown')) $$('.dropdown').forEach(x=>x.style.display='none');
  });

  $$('.search-box').forEach(inp=>{
    inp.addEventListener('input', function(){
      const term = this.value.toLowerCase();
      $$('.options-list .checkbox-option', this.closest('.dropdown')).forEach(opt=>{
        opt.style.display = opt.innerText.toLowerCase().includes(term) ? '' : 'none';
      });
    });
  });

  function updateSection(block){
    if(!block) return;
    const sectionName = block.getAttribute('data-type');
    const key = block.getAttribute('data-key');
    
    if (key === 'vacancy') {
      updateVacancyCount();
      return;
    }
    
    const label = block.querySelector('.selected-label');
    const countSpan = block.querySelector('.filter-count');
    const tags = block.querySelector('[data-tags]');
    const checked = $$('.options-list input[type="checkbox"]:checked', block);

    if(label) label.textContent = `${checked.length} ${sectionName}(s) selected`;
    if(countSpan) countSpan.textContent = `(${checked.length})`;

    if(tags){
      tags.innerHTML = '';
      checked.forEach(cb=>{
        const chip = document.createElement('span');
        chip.className = 'tag-custom-chips mr-1 d-flex align-items-center';
        chip.textContent = cb.dataset.label;
        const x = document.createElement('span');
        x.className = 'cursor-pointer mt-1';
        x.innerHTML = '<iconify-icon icon="maki:cross" width="12" height="12"></iconify-icon>';
        x.onclick = ()=>{ cb.checked=false; onApply(block); };
        chip.appendChild(x);
        tags.appendChild(chip);
      });
    }
  }

  function updateHeaderCount(){
    const sectionsUsed = [
      state.buIds.length,
      state.companyIds.length,
      state.departmentIds.length,
      LEVELS_ENABLED ? state.levels.length : 0,
      state.vacancy_status ? 1 : 0
    ].filter(n => n > 0).length;

    document.querySelectorAll('.total-filter-count').forEach(el => {
      if (sectionsUsed > 0) {
        el.textContent = `(${sectionsUsed})`;
      } else {
        el.textContent = ''; 
      }
    });
  }

  function setEnabled(block, enabled){
    if(!block) return;
    block.querySelector('[data-select="box"]')?.classList.toggle('disabled', !enabled);
  }

  function onApply(block){
    const key = block.dataset.key;
    const checked = $$('.options-list input[type="checkbox"]:checked', block).map(i=>parseInt(i.value));

    if(key==='bu'){
      state.buIds = checked;
      state.companyIds = []; state.departmentIds = [];
      loadCompanies(state.buIds);
      buildOptions($('[data-list="department"]'), []);
      setEnabled(document.querySelector('[data-key="company"]'), state.buIds.length>0);
      setEnabled(document.querySelector('[data-key="department"]'), false);
      updateSection(document.querySelector('[data-key="company"]'));
      updateSection(document.querySelector('[data-key="department"]'));
    }

    if(key==='company'){
      state.companyIds = checked;
      state.departmentIds = [];
      loadDepartments(state.companyIds, state.buIds);
      setEnabled(document.querySelector('[data-key="department"]'), state.companyIds.length>0);
      updateSection(document.querySelector('[data-key="department"]'));
    }

    if(key==='department'){
      state.departmentIds = checked;
    }

    updateSection(block);
    updateHeaderCount();
    if (LEVELS_ENABLED) updateLevelCounts();
  }

  function onReset(block){
    const key = block.dataset.key;
    
    if (key === 'vacancy') {
      state.vacancy_status = '';
      document.getElementById('vacancyStatus').value = '';
      updateSection(block);
      updateHeaderCount();
      return;
    }
    
    $$('.options-list input[type="checkbox"]', block).forEach(cb=>cb.checked=false);

    if(key==='bu'){
      state.buIds=[]; state.companyIds=[]; state.departmentIds=[];
      buildOptions($('[data-list="company"]'), []);
      buildOptions($('[data-list="department"]'), []);
      setEnabled(document.querySelector('[data-key="company"]'), false);
      setEnabled(document.querySelector('[data-key="department"]'), false);
      updateSection(document.querySelector('[data-key="company"]'));
      updateSection(document.querySelector('[data-key="department"]'));
    }
    if(key==='company'){
      state.companyIds=[]; state.departmentIds=[];
      buildOptions($('[data-list="department"]'), []);
      setEnabled(document.querySelector('[data-key="department"]'), false);
      updateSection(document.querySelector('[data-key="department"]'));
    }
    if(key==='department') state.departmentIds=[];

    updateSection(block);
    updateHeaderCount();
    if (LEVELS_ENABLED) updateLevelCounts();
  }

  $$('.filter-block').forEach(block=>{
    const dd = block.querySelector('.dropdown');
    dd?.addEventListener('click', (e)=>{
      const action = e.target.getAttribute('data-action');
      if(action==='apply'){ onApply(block); dd.style.display='none'; }
      if(action==='reset'){ onReset(block); }
    });
    block.querySelector('.section-clear')?.addEventListener('click', ()=> onReset(block));
  });

  function renderLevels(){
    if(!LEVELS_ENABLED) return;
    const top  = document.querySelector('#levels-top');
    const more = document.querySelector('#levels-more');
    if(!top || !more) return;
    top.innerHTML=''; more.innerHTML='';
  }

  function currentLevelCounts(){
    if(state.buIds.length===1){
      return Object.assign({}, DUMMY.levelCounts.default, DUMMY.levelCounts.byBU[state.buIds[0]]||{});
    }
    return DUMMY.levelCounts.default;
  }

  function updateLevelCounts(){
    if(!LEVELS_ENABLED) return;
    const counts = currentLevelCounts();
    $$('[data-level-count]').forEach(el=>{
      const lvl = el.getAttribute('data-level-count');
      el.textContent = counts[lvl] || 0;
    });
  }

  document.addEventListener('change', (e)=>{
    if(!e.target.classList.contains('level-cb')) return;
    state.levels = $$('.level-cb:checked').map(i=>i.value);
    const lvlCountEl = document.getElementById('total-filter-level-count');
    if(lvlCountEl) lvlCountEl.textContent = `(${state.levels.length})`;
    updateHeaderCount();
  });

  function clearAll(){
    $$('input[type="checkbox"]').forEach(cb => cb.checked = false);

    state.buIds = [];
    state.companyIds = [];
    state.departmentIds = [];
    state.levels = [];
    state.vacancy_status = '';

    // Reset vacancy dropdown
    document.getElementById('vacancyStatus').value = '';

    setEnabled(document.querySelector('[data-key="company"]'), false);
    setEnabled(document.querySelector('[data-key="department"]'), false);

    $$('.filter-block').forEach(block => {
      const section = block.getAttribute('data-type');
      const labelEl = block.querySelector('.selected-label');
      const countEl = block.querySelector('.filter-count');
      const tagsEl = block.querySelector('[data-tags]');
      
      if (block.getAttribute('data-key') !== 'vacancy') {
        if (labelEl) labelEl.textContent = `0 ${section}(s) selected`;
      }
      if (countEl) countEl.textContent = '(0)';
      if (tagsEl) tagsEl.innerHTML = '';
    });

    const lvlCountEl = document.getElementById('total-filter-level-level-count');
    if (lvlCountEl) lvlCountEl.textContent = '(0)';

    updateHeaderCount();
    if (typeof updateLevelCounts === 'function') updateLevelCounts();

    const out = document.getElementById('filters-json');
    if (out) out.textContent = '{}';

    apply();
  }

  document.getElementById('footer-clear')?.addEventListener('click', clearAll);
  document.querySelectorAll('.clear-filter').forEach(btn=>btn.addEventListener('click', clearAll));

function closeOffcanvas() {
  const el = document.getElementById('offcanvasRight');
  const inst = bootstrap?.Offcanvas?.getInstance(el) || bootstrap?.Offcanvas?.getOrCreateInstance(el);
  inst?.hide();
}

  async function apply() {
        showOverlay(); 
        var user_id = requestData.user_id;
        const payload = {
          business_unit_ids: state.buIds,
          company_ids: state.companyIds,
          department_ids: state.departmentIds,
          position_levels: state.levels,
          user_id:user_id ?? null,
          vacancy_status: state.vacancy_status
        };
        const out = document.getElementById('filters-json');
        if(out) out.textContent = JSON.stringify(payload, null, 2);
        console.log('Apply Filters:', payload);

        try {
              const res = await fetch(API.headcountCodes, {
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ...payload,_token: '{{ csrf_token() }}' })
              });
              if (!res.ok) throw new Error('Headcount Codes load failed');
              const data = await res.json();

              requestData.selectedHeadcountCodes = data.headcount_codes;
              if (data) {
                loadOrganizationDetails(data.organizationData);
              }

              if (isEditMode == false) {
                  console.log("Switch is ON");
                  console.log(originalOrgChart);

                  if (originalOrgChart) {
                      await renderOrgChart(originalOrgChart);
                  }
              } else {
                  if (editedOrgChart) {
                      await renderOrgChart(editedOrgChart);
                  }
              }
              await revealPathAndFocusMultiple(requestData.selectedHeadcountCodes);
              await closeOffcanvas();
              await hideOverlay();
                        
        } catch (error) {
            await hideOverlay();
        }
  }

  document.getElementById('apply-filters-button')?.addEventListener('click', ()=>{
    apply();
  });

  setEnabled(document.querySelector('[data-key="company"]'), false);
  setEnabled(document.querySelector('[data-key="department"]'), false);

  if (LEVELS_ENABLED) { renderLevels(); updateLevelCounts(); }

  // Name Search Filter Code 
  const input = document.getElementById('searchInput');
  const dropdown = document.getElementById('dropdownList');
  const clearBtn = document.getElementById('clearBtn');
  let abortController1 = null;
  let selectedUserId = null;
  let selectedUserName = null;
  let currentPage = 1;
  let lastKeyword = '';
  let hasMorePages = false;

  function createItem(user) {
    const item = document.createElement('div');
    item.className = 'dropdown-item';
    item.textContent = user.name;
    item.dataset.userId = user.id;
    item.dataset.userName = user.name;
    item.addEventListener('click', async () => {
        input.value = user.name;
        selectedUserId = user.id;
        selectedUserName = user.name;
        dropdown.classList.add('d-none');
        clearBtn.classList.remove('d-none');
        headcountCode = user.headcount_code;
        
        console.log(`Selected User ID: ${selectedUserId}, Name: ${headcountCode}`);
        requestData.user_id = selectedUserId;
        await revealPathAndFocusSingle([headcountCode], { strictReset: true });
        await apply();
        await zoomToNode(headcountCode);
    });
    return item;
  }

  function createShowMoreButton() {
    const btn = document.createElement('div');
    btn.className = 'dropdown-item show-more';
    btn.style.textAlign = 'center';
    btn.style.cursor = 'pointer';
    btn.textContent = 'Show More';
    btn.addEventListener('click', () => {
        currentPage += 1;
        fetchDropdownResults(lastKeyword, true);
    });
    return btn;
  }

  function fetchDropdownResults(keyword, append = false) {
    if (abortController1) abortController1.abort();
    abortController1 = new AbortController();

    if (!keyword.trim()) {
        dropdown.classList.add('d-none');
        dropdown.innerHTML = '';
        clearBtn.classList.add('d-none');
        selectedUserId = null;
        return;
    }

    if (!append) {
        dropdown.innerHTML = '<div class="dropdown-item">Searching...</div>';
        currentPage = 1;
    }

    clearBtn.classList.remove('d-none');
    lastKeyword = keyword;

    fetch(`/api/search-users?keyword=${encodeURIComponent(keyword)}&page=${currentPage}`, {
        method: 'GET',
        signal: abortController1.signal
    })
    .then(response => response.json())
    .then(result => {
        if (!append) {
            dropdown.innerHTML = '';
        }

        const oldShowMore = dropdown.querySelector('.show-more');
        if (oldShowMore) oldShowMore.remove();

        result.data.forEach(user => {
            dropdown.appendChild(createItem(user));
        });

        if (result.has_more) {
            dropdown.appendChild(createShowMoreButton());
        }

        hasMorePages = result.has_more;
        dropdown.classList.remove('d-none');
    })
    .catch(err => {
        if (err.name !== 'AbortError') {
            console.error('Fetch error:', err);
        }
    });
  }

  input.addEventListener('input', () => {
      fetchDropdownResults(input.value);
  });

  input.addEventListener('focus', () => {
      if (input.value.trim()) {
          dropdown.classList.remove('d-none');
      }
      clearBtn.classList.toggle('d-none', input.value === '');
  });

  clearBtn.addEventListener('click', () => {
      input.value = '';
      selectedUserId = null;
      selectedUserName = null;
      currentPage = 1;
      dropdown.classList.add('d-none');
      clearBtn.classList.add('d-none');
      requestData.user_id = null;
      apply();
  });

  document.addEventListener('click', (e) => {
      if (!e.target.closest('.search-dropdown') && !e.target.closest('#dropdownList')) {
          dropdown.classList.add('d-none');
      }
  });

  document.getElementById('filter-btn').addEventListener('click',(e)=>{
      const offcanvasEl = document.getElementById('offcanvasRight');
      const bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
      hideOverlay();
      bsOffcanvas.show();
  });

})();
</script>
@endpush