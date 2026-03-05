<x-app-layout title="AstraMC Trucks & Equipments">

    {{-- Breadcrumb + Add Button --}}
    <div class="flex items-center justify-between mb-4">
        <x-breadcrumb :items="[
            ['label' => 'Dashboard', 'active' => false],
            ['label' => 'Human Resource', 'active' => false],
            ['label' => 'Employees', 'active' => true]
        ]" />

        <x-add-link href="{{ route('employees.create') }}">
            <x-addIcon />
            Employee
        </x-add-link>

    </div>

    {{-- Card wrapper --}}
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">

        {{-- ── Toolbar ── --}}
        <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 bg-gray-50 border-b border-gray-200">

            {{-- Status filter tabs --}}
            <div class="inline-flex border border-gray-200 rounded-lg overflow-hidden text-xs font-medium">
                @foreach(['All','Pending','Received','Cancelled'] as $tab)
                <button
                    onclick="filterStatus(this, '{{ strtolower($tab) }}')"
                    data-status="{{ strtolower($tab) }}"
                    class="status-tab px-3.5 py-1.5 transition
                           {{ $tab === 'All' ? 'bg-blue-600 text-white' : 'bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700' }}">
                    {{ $tab }}
                </button>
                @endforeach
            </div>

            {{-- Search --}}
            <div class="relative">
                <x-icons.searchIcon />
                <x-forms.input-search type="text" id="search-input" oninput="searchTable()" placeholder="Search…"/>
            </div>
        </div>

        {{-- ── Table ── --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm" id="main-table">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 w-10">#</th>
                        @foreach(['ID.','Name','Position','Branch','Date Hired','Status'] as $col)
                        <th class="px-4 py-3 text-left text-[0.68rem] font-bold uppercase tracking-widest text-gray-400 cursor-pointer select-none whitespace-nowrap group"
                            onclick="sortTable(this)">
                            <span class="inline-flex items-center gap-1.5">
                                {{ $col }}
                                <x-sortIcon />
                            </span>
                        </th>
                        @endforeach

                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100" id="table-body">
                    @foreach ($employees as $i => $employee)
                    <tr class="hover:bg-gray-50 transition-colors duration-100 table-row"
                        data-status="{{-- strtolower($transmittal->status) --}}">

                        <td class="px-4 py-3 text-xs text-gray-400 font-mono">$i + 1</td>

                        <td class="px-4 py-3 text-xs">
                            <a href="{{ route('employees.show', $employee->id) }}"
                               class="text-blue-600 hover:text-blue-800 font-semibold font-mono hover:underline">
                                {{ $employee->employee_id }}
                            </a>
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-700 font-medium">
                            {{ $employee->position }}
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ $employee->branch }}
                        </td>

                        <td class="px-4 py-3 text-xs text-gray-500">
                            {{ $employee->date_hired }}
                        </td>

                        <td class="px-4 py-3 text-xs">
                            @php
                                $s = strtolower($employee->emp_status);
                                $badge = match($s) {
                                    'approved','received' => 'bg-green-100 text-green-700 border border-green-200',
                                    'pending'            => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                    'cancelled'          => 'bg-red-100 text-red-600 border border-red-200',
                                    default              => 'bg-gray-100 text-gray-600 border border-gray-200',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1.5 {{ $badge }} text-[0.65rem] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full whitespace-nowrap">
                                {{ $employee->emp_status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Empty state --}}
            <div id="empty-state" class="hidden w-full flex flex-col items-center justify-center py-14 text-center">
                <x-icons.fileIcon />
                <p class="text-xs text-gray-300 font-medium">No records found</p>
            </div>
        </div>

        {{-- ── Pagination Footer ── --}}
        <div class="flex flex-wrap items-center justify-between gap-4 px-5 py-3 bg-gray-50 border-t border-gray-200">

            <p class="text-xs text-gray-400" id="showing-label">
                Showing <span id="show-from">1</span>–<span id="show-to">{{-- count($transmittals) --}}</span>
                of <span id="show-total">{{-- count($transmittals) --}}</span> entries
            </p>

            <div class="flex items-center gap-3">
                {{-- Per page --}}
                <div class="flex items-center gap-2 text-xs text-gray-400">
                    Show
                    <select id="per-page" onchange="changePerPage()"
                            class="text-xs text-gray-700 border border-gray-200 rounded-md h-7 px-1.5 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-100 transition">
                        <option>10</option>
                        <option>20</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    rows
                </div>

                {{-- Page buttons --}}
                <ul class="flex items-center gap-1" id="pagination-btns"></ul>
            </div>
        </div>

    </div>

<script>
// ──────────────────────────────────────────────
// State
// ──────────────────────────────────────────────
let currentPage   = 1;
let perPage       = 10;
let activeStatus  = 'all';
let searchQuery   = '';
let sortStates    = {};

const allRows = () => Array.from(document.querySelectorAll('#table-body .table-row'));

function visibleRows() {
    return allRows().filter(row => {
        const statusMatch  = activeStatus === 'all' || row.dataset.status === activeStatus;
        const searchMatch  = !searchQuery || row.textContent.toLowerCase().includes(searchQuery);
        return statusMatch && searchMatch;
    });
}

// ──────────────────────────────────────────────
// Render
// ──────────────────────────────────────────────
function render() {
    const rows  = visibleRows();
    const total = rows.length;
    const start = (currentPage - 1) * perPage;
    const end   = Math.min(start + perPage, total);

    // Hide all, show slice
    allRows().forEach(r => r.classList.add('hidden'));
    rows.slice(start, end).forEach(r => r.classList.remove('hidden'));

    // Re-number visible rows
    rows.slice(start, end).forEach((r, i) => {
        r.cells[0].textContent = start + i + 1;
    });

    // Labels
    document.getElementById('show-from').textContent  = total ? start + 1 : 0;
    document.getElementById('show-to').textContent    = end;
    document.getElementById('show-total').textContent = total;

    // Empty state
    document.getElementById('empty-state').classList.toggle('hidden', total > 0);

    buildPagination(total);
}

function buildPagination(total) {
    const pages = Math.max(1, Math.ceil(total / perPage));
    const ul    = document.getElementById('pagination-btns');
    ul.innerHTML = '';

    const btn = (label, page, disabled = false, active = false) => {
        const li = document.createElement('li');
        li.innerHTML = `<button
            class="inline-flex items-center justify-center min-w-[28px] h-7 px-2 rounded-md text-xs font-medium border transition
                   ${active  ? 'bg-blue-600 border-blue-600 text-white shadow-sm shadow-blue-200' :
                     disabled? 'bg-gray-50 border-gray-200 text-gray-300 cursor-not-allowed' :
                               'bg-white border-gray-200 text-gray-600 hover:border-blue-400 hover:text-blue-600'}"
            ${disabled ? 'disabled' : ''}
            onclick="goPage(${page})">${label}</button>`;
        ul.appendChild(li);
    };

    btn('‹', currentPage - 1, currentPage === 1);

    const range = paginationRange(currentPage, pages);
    range.forEach(p => {
        if (p === '…') {
            const li = document.createElement('li');
            li.innerHTML = `<span class="px-1 text-xs text-gray-300">…</span>`;
            ul.appendChild(li);
        } else {
            btn(p, p, false, p === currentPage);
        }
    });

    btn('›', currentPage + 1, currentPage === pages);
}

function paginationRange(cur, total) {
    if (total <= 7) return Array.from({length: total}, (_, i) => i + 1);
    if (cur <= 4) return [1,2,3,4,5,'…',total];
    if (cur >= total - 3) return [1,'…',total-4,total-3,total-2,total-1,total];
    return [1,'…',cur-1,cur,cur+1,'…',total];
}

// ──────────────────────────────────────────────
// Controls
// ──────────────────────────────────────────────
function goPage(p) {
    const pages = Math.ceil(visibleRows().length / perPage);
    currentPage = Math.min(Math.max(1, p), pages);
    render();
}

function changePerPage() {
    perPage = parseInt(document.getElementById('per-page').value);
    currentPage = 1;
    render();
}

function filterStatus(btn, status) {
    activeStatus = status;
    currentPage  = 1;
    document.querySelectorAll('.status-tab').forEach(b => {
        const active = b === btn;
        b.classList.toggle('bg-blue-600',   active);
        b.classList.toggle('text-white',    active);
        b.classList.toggle('bg-white',      !active);
        b.classList.toggle('text-gray-500', !active);
    });
    render();
}

function searchTable() {
    searchQuery = document.getElementById('search-input').value.toLowerCase().trim();
    currentPage = 1;
    render();
}

function sortTable(th) {
    const table    = th.closest('table');
    const tbody    = table.querySelector('tbody');
    const headers  = Array.from(table.querySelectorAll('th'));
    const colIndex = headers.indexOf(th);

    sortStates[colIndex] = !sortStates[colIndex];
    const asc = sortStates[colIndex];

    // Reset all icons
    table.querySelectorAll('.sort-icon').forEach(ic => ic.classList.remove('fill-blue-500'));
    th.querySelector('.sort-icon').classList.add('fill-blue-500');

    const rows = Array.from(tbody.querySelectorAll('tr'));
    rows.sort((a, b) => {
        const at = a.cells[colIndex]?.textContent.trim() ?? '';
        const bt = b.cells[colIndex]?.textContent.trim() ?? '';
        if (!isNaN(at) && !isNaN(bt)) return asc ? at - bt : bt - at;
        return asc ? at.localeCompare(bt) : bt.localeCompare(at);
    });
    rows.forEach(r => tbody.appendChild(r));
    render();
}

// Init
render();
</script>

</x-app-layout>
