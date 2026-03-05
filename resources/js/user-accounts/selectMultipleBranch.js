import './bootstrap';

    const OPTIONS = [
      { value: 'apple',      label: '🍎 Apple' },
      { value: 'banana',     label: '🍌 Banana' },
      { value: 'cherry',     label: '🍒 Cherry' },
      { value: 'mango',      label: '🥭 Mango' },
      { value: 'orange',     label: '🍊 Orange' },
      { value: 'strawberry', label: '🍓 Strawberry' },
      { value: 'blueberry',  label: '🫐 Blueberry' },
      { value: 'peach',      label: '🍑 Peach' },
      { value: 'grape',      label: '🍇 Grape' },
      { value: 'watermelon', label: '🍉 Watermelon' },
      { value: 'kiwi',       label: '🥝 Kiwi' },
      { value: 'lemon',      label: '🍋 Lemon' },
    ];

    let selected = new Set();
    let isOpen = false;
    let filtered = [...OPTIONS];

    const trigger     = document.getElementById('selectTrigger');
    const dropdown    = document.getElementById('dropdown');
    const tagsContainer = document.getElementById('tagsContainer');
    const chevron     = document.getElementById('chevron');
    const clearBtn    = document.getElementById('clearBtn');
    const searchInput = document.getElementById('searchInput');
    const optionsList = document.getElementById('optionsList');
    const emptyState  = document.getElementById('emptyState');
    const selectAll   = document.getElementById('selectAll');
    const selectAllCheck = document.getElementById('selectAllCheck');
    const selectedCount = document.getElementById('selectedCount');
    const outputPreview = document.getElementById('outputPreview');
    const outputTags  = document.getElementById('outputTags');

    // --- Render Options ---
    function renderOptions() {
      optionsList.innerHTML = '';
      const q = searchInput.value.toLowerCase();
      filtered = OPTIONS.filter(o => o.label.toLowerCase().includes(q));

      emptyState.classList.toggle('hidden', filtered.length > 0);
      selectAll.classList.toggle('hidden', filtered.length === 0);

      filtered.forEach(opt => {
        const isSelected = selected.has(opt.value);
        const row = document.createElement('div');
        row.className = `option-row flex items-center gap-3 px-4 py-2.5 cursor-pointer ${isSelected ? 'selected' : ''}`;
        row.setAttribute('role', 'option');
        row.setAttribute('aria-selected', isSelected);
        row.dataset.value = opt.value;

        row.innerHTML = `
          <div class="w-4 h-4 rounded border flex items-center justify-center shrink-0 transition-colors ${isSelected ? 'bg-amber-600 border-amber-600' : 'border-stone-300'}">
            <svg class="${isSelected ? '' : 'hidden'}" width="9" height="7" viewBox="0 0 9 7" fill="none">
              <path d="M1 3.5l2.5 2.5L8 1" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="text-sm text-stone-700">${opt.label}</span>
        `;

        row.addEventListener('click', e => {
          e.stopPropagation();
          toggleOption(opt.value);
        });

        optionsList.appendChild(row);
      });

      // Update select-all state
      const allFilteredSelected = filtered.every(o => selected.has(o.value));
      const someSelected = filtered.some(o => selected.has(o.value));
      const checkIcon = selectAllCheck.querySelector('svg');
      if (allFilteredSelected && filtered.length > 0) {
        selectAllCheck.className = 'w-4 h-4 rounded border bg-amber-600 border-amber-600 flex items-center justify-center shrink-0 transition-colors';
        checkIcon.classList.remove('hidden');
      } else if (someSelected) {
        selectAllCheck.className = 'w-4 h-4 rounded border bg-amber-200 border-amber-400 flex items-center justify-center shrink-0 transition-colors';
        checkIcon.classList.add('hidden');
      } else {
        selectAllCheck.className = 'w-4 h-4 rounded border border-stone-300 flex items-center justify-center shrink-0 transition-colors';
        checkIcon.classList.add('hidden');
      }
    }

    // --- Toggle Option ---
    function toggleOption(value) {
      if (selected.has(value)) {
        selected.delete(value);
      } else {
        selected.add(value);
      }
      renderTags();
      renderOptions();
      updateMeta();
    }

    // --- Render Tags ---
    function renderTags() {
      const placeholder = tagsContainer.querySelector('.placeholder');
      if (placeholder) placeholder.remove();

      // Remove tags for deselected
      tagsContainer.querySelectorAll('[data-tag]').forEach(el => {
        if (!selected.has(el.dataset.tag)) {
          el.classList.add('tag-exit');
          el.addEventListener('animationend', () => el.remove(), { once: true });
        }
      });

      // Add new tags
      selected.forEach(val => {
        if (tagsContainer.querySelector(`[data-tag="${val}"]`)) return;
        const opt = OPTIONS.find(o => o.value === val);
        if (!opt) return;

        const tag = document.createElement('span');
        tag.dataset.tag = val;
        tag.className = 'tag-enter inline-flex items-center gap-1 bg-amber-50 border border-amber-200 text-amber-800 text-xs px-2 py-0.5 rounded-lg';
        tag.innerHTML = `
          <span>${opt.label}</span>
          <button data-remove="${val}" class="text-amber-400 hover:text-amber-700 transition-colors leading-none ml-0.5" tabindex="-1" aria-label="Remove ${opt.label}">
            <svg width="8" height="8" viewBox="0 0 8 8" fill="none">
              <path d="M1 1l6 6M7 1L1 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
          </button>
        `;

        tag.querySelector('[data-remove]').addEventListener('click', e => {
          e.stopPropagation();
          toggleOption(val);
        });

        tagsContainer.appendChild(tag);
      });

      // Show placeholder
      if (selected.size === 0 && !tagsContainer.querySelector('.placeholder')) {
        const ph = document.createElement('span');
        ph.className = 'placeholder text-stone-300 text-sm select-none';
        ph.textContent = 'Pick some fruits…';
        tagsContainer.prepend(ph);
      }

      clearBtn.classList.toggle('hidden', selected.size === 0);
    }

    // --- Update meta info ---
    function updateMeta() {
      const n = selected.size;
      selectedCount.textContent = n === 0 ? 'No items selected'
        : n === 1 ? '1 item selected'
        : `${n} items selected`;

      if (n > 0) {
        outputPreview.classList.remove('hidden');
        outputTags.innerHTML = '';
        selected.forEach(val => {
          const opt = OPTIONS.find(o => o.value === val);
          const chip = document.createElement('span');
          chip.className = 'inline-flex items-center bg-stone-100 text-stone-600 text-xs px-3 py-1 rounded-full border border-stone-200';
          chip.textContent = opt.label;
          outputTags.appendChild(chip);
        });
      } else {
        outputPreview.classList.add('hidden');
      }
    }

    // --- Open / Close ---
    function openDropdown() {
      isOpen = true;
      dropdown.classList.add('open');
      chevron.classList.add('rotated');
      trigger.classList.add('focused');
      trigger.setAttribute('aria-expanded', 'true');
      searchInput.focus();
      renderOptions();
    }

    function closeDropdown() {
      isOpen = false;
      dropdown.classList.remove('open');
      chevron.classList.remove('rotated');
      trigger.classList.remove('focused');
      trigger.setAttribute('aria-expanded', 'false');
      searchInput.value = '';
      filtered = [...OPTIONS];
    }

    // --- Select All ---
    selectAll.addEventListener('click', e => {
      e.stopPropagation();
      const allSelected = filtered.every(o => selected.has(o.value));
      if (allSelected) {
        filtered.forEach(o => selected.delete(o.value));
      } else {
        filtered.forEach(o => selected.add(o.value));
      }
      renderTags();
      renderOptions();
      updateMeta();
    });

    // --- Clear ---
    clearBtn.addEventListener('click', e => {
      e.stopPropagation();
      selected.clear();
      renderTags();
      renderOptions();
      updateMeta();
    });

    // --- Search ---
    searchInput.addEventListener('input', renderOptions);
    searchInput.addEventListener('click', e => e.stopPropagation());

    // --- Toggle on trigger click ---
    trigger.addEventListener('click', () => isOpen ? closeDropdown() : openDropdown());
    trigger.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); isOpen ? closeDropdown() : openDropdown(); }
      if (e.key === 'Escape') closeDropdown();
    });

    // --- Click outside ---
    document.addEventListener('click', e => {
      if (isOpen && !document.getElementById('multiSelectWrapper').contains(e.target)) {
        closeDropdown();
      }
    });

    // --- Init ---
    renderTags();
    updateMeta();