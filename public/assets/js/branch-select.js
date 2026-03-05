const BRANCHES = [
  { id: 1, name: 'main',         color: '#3ddc97', type: 'default'     },
  { id: 2, name: 'develop',      color: '#6366f1', type: 'integration' },
  { id: 3, name: 'feature/auth', color: '#f59e0b', type: 'feature'     },
  { id: 4, name: 'feature/ui',   color: '#f59e0b', type: 'feature'     },
  { id: 5, name: 'hotfix/login', color: '#f43f5e', type: 'hotfix'      },
  { id: 6, name: 'release/v2.1', color: '#a78bfa', type: 'release'     },
  { id: 7, name: 'staging',      color: '#38bdf8', type: 'env'         },
];

const OLD_SELECTION = [1, 2];
let selected = new Set(OLD_SELECTION);
let isOpen = false;

const wrapper      = document.getElementById('wrapper');
const trigger      = document.getElementById('trigger');
const dropdown     = document.getElementById('dropdown');
const optionsEl    = document.getElementById('options');
const searchEl     = document.getElementById('search');
const placeholder  = document.getElementById('placeholder');
const hiddenInputs = document.getElementById('hiddenInputs');
const countLabel   = document.getElementById('countLabel');
const selectAllBtn = document.getElementById('selectAllBtn');
const chevron      = document.getElementById('chevron');

function buildOptions() {
  optionsEl.innerHTML = '';
  BRANCHES.forEach(b => {
    const el = document.createElement('div');
    el.dataset.id = b.id;
    el.setAttribute('role', 'option');
    el.className = 'flex items-center gap-2.5 px-2.5 py-2 rounded-lg cursor-pointer text-sm transition-colors duration-100 ' +
      (selected.has(b.id) ? 'bg-indigo-500/10' : 'hover:bg-white/5');
    el.innerHTML = `
      <div class="w-4 h-4 rounded-[4px] border flex items-center justify-center shrink-0 transition-all duration-100 ${selected.has(b.id) ? 'bg-indigo-500 border-indigo-500' : 'bg-gray-900 border-gray-600'}">
        <svg class="${selected.has(b.id) ? '' : 'hidden'} text-white" width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <span class="w-2 h-2 rounded-full shrink-0" style="background:${b.color}"></span>
      <span class="flex-1 text-gray-200 font-mono text-[13px]">${b.name}</span>
      <span class="text-gray-600 text-[11px] font-mono">${b.type}</span>
    `;
    el.addEventListener('click', () => toggleOption(b.id));
    optionsEl.appendChild(el);
  });
}

function toggleOption(id) {
  selected.has(id) ? selected.delete(id) : selected.add(id);
  updateUI();
}

function updateUI() {
  trigger.querySelectorAll('.pill').forEach(p => p.remove());

  if (selected.size === 0) {
    placeholder.classList.remove('hidden');
  } else {
    placeholder.classList.add('hidden');
    selected.forEach(id => {
      const b = BRANCHES.find(x => x.id === id);
      if (!b) return;
      const pill = document.createElement('span');
      pill.className = 'pill inline-flex items-center gap-1.5 bg-indigo-500/10 border border-indigo-500/30 text-indigo-300 text-xs font-medium px-2.5 py-1 rounded-md';
      pill.innerHTML = `
        <span class="w-1.5 h-1.5 rounded-full shrink-0" style="background:${b.color}"></span>
        <span class="font-mono">${b.name}</span>
        <button type="button" data-id="${b.id}" class="ml-0.5 text-indigo-400 hover:text-rose-400 transition-colors duration-100 focus:outline-none leading-none">
          <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      `;
      pill.querySelector('button').addEventListener('click', e => {
        e.stopPropagation();
        selected.delete(id);
        updateUI();
      });
      trigger.insertBefore(pill, chevron);
    });
  }

  optionsEl.querySelectorAll('[data-id]').forEach(el => {
    const id = Number(el.dataset.id);
    const isSel = selected.has(id);
    el.className = 'flex items-center gap-2.5 px-2.5 py-2 rounded-lg cursor-pointer text-sm transition-colors duration-100 ' +
      (isSel ? 'bg-indigo-500/10' : 'hover:bg-white/5');
    const box  = el.querySelector('div');
    const tick = el.querySelector('svg');
    box.className = `w-4 h-4 rounded-[4px] border flex items-center justify-center shrink-0 transition-all duration-100 ${isSel ? 'bg-indigo-500 border-indigo-500' : 'bg-gray-900 border-gray-600'}`;
    tick.classList.toggle('hidden', !isSel);
  });

  countLabel.textContent = `${selected.size} selected`;
  selectAllBtn.textContent = BRANCHES.every(b => selected.has(b.id)) ? 'Clear all' : 'Select all';

  hiddenInputs.innerHTML = '';
  selected.forEach(id => {
    const inp = document.createElement('input');
    inp.type = 'hidden'; inp.name = 'branch_ids[]'; inp.value = id;
    hiddenInputs.appendChild(inp);
  });
}

function open() {
  if (isOpen) return;
  isOpen = true;
  dropdown.classList.remove('hidden');
  trigger.classList.add('border-indigo-500', 'ring-2', 'ring-indigo-500/20');
  trigger.setAttribute('aria-expanded', 'true');
  chevron.style.transform = 'translateY(-50%) rotate(180deg)';
  searchEl.value = '';
  filterOptions('');
  requestAnimationFrame(() => searchEl.focus());
}

function close() {
  if (!isOpen) return;
  isOpen = false;
  dropdown.classList.add('hidden');
  trigger.classList.remove('border-indigo-500', 'ring-2', 'ring-indigo-500/20');
  trigger.setAttribute('aria-expanded', 'false');
  chevron.style.transform = 'translateY(-50%) rotate(0deg)';
}

function filterOptions(q) {
  const query = q.toLowerCase();
  let visible = 0;
  optionsEl.querySelectorAll('[data-id]').forEach(el => {
    const b = BRANCHES.find(x => x.id === Number(el.dataset.id));
    const match = b.name.toLowerCase().includes(query);
    el.classList.toggle('hidden', !match);
    if (match) visible++;
  });
  let noRes = optionsEl.querySelector('.no-results');
  if (visible === 0) {
    if (!noRes) {
      noRes = document.createElement('p');
      noRes.className = 'no-results text-center text-gray-600 text-sm py-5';
      noRes.textContent = 'No branches found';
      optionsEl.appendChild(noRes);
    }
  } else {
    noRes?.remove();
  }
}

trigger.addEventListener('click', e => {
  if (e.target.closest('.pill button')) return;
  isOpen ? close() : open();
});
trigger.addEventListener('keydown', e => {
  if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); isOpen ? close() : open(); }
  if (e.key === 'Escape') close();
});
searchEl.addEventListener('input', e => filterOptions(e.target.value));
searchEl.addEventListener('keydown', e => { if (e.key === 'Escape') close(); });
selectAllBtn.addEventListener('click', () => {
  const allSel = BRANCHES.every(b => selected.has(b.id));
  allSel ? selected.clear() : BRANCHES.forEach(b => selected.add(b.id));
  updateUI();
});
document.addEventListener('mousedown', e => { if (!wrapper.contains(e.target)) close(); });

buildOptions();
updateUI();