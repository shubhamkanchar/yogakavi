@extends('admin.layout')

@section('style')
<style>
    body { background: #f0f4f8; font-family: 'Poppins', sans-serif; }

    /* ── Header bar ── */
    .diet-header {
        background: linear-gradient(135deg, #1a4f3a 0%, #2d7a56 100%);
        border-radius: 16px;
        padding: 24px 28px;
        color: #fff;
        box-shadow: 0 6px 24px rgba(26,79,58,.25);
    }
    .diet-header h2 { margin: 0; font-size: 1.5rem; font-weight: 700; }
    .diet-header p  { margin: 4px 0 0; opacity: .8; font-size: .9rem; }

    /* ── Tab nav ── */
    .diet-tabs { border: none; gap: 8px; }
    .diet-tabs .nav-link {
        border: 2px solid #dee2e6 !important;
        border-radius: 10px !important;
        color: #6c757d; font-weight: 600; font-size: .9rem;
        padding: 10px 22px; transition: all .2s;
    }
    .diet-tabs .nav-link.active {
        background: #1a4f3a !important; border-color: #1a4f3a !important;
        color: #fff !important; box-shadow: 0 4px 12px rgba(26,79,58,.3);
    }
    .diet-tabs .nav-link:hover:not(.active) { border-color: #1a4f3a !important; color: #1a4f3a; }

    /* ── Day card ── */
    .day-box {
        background: #fff; border: none !important;
        border-radius: 14px !important;
        box-shadow: 0 2px 12px rgba(0,0,0,.07);
        transition: box-shadow .2s;
    }
    .day-box:hover { box-shadow: 0 6px 20px rgba(0,0,0,.12); }
    .day-box .day-header {
        background: linear-gradient(90deg, #1a4f3a, #2d7a56);
        color: #fff; border-radius: 14px 14px 0 0;
        padding: 12px 18px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .day-box .day-body { padding: 18px; }

    .meal-card {
        background: #f8fffe; border: 1.5px solid #e0f0e8;
        border-radius: 10px; padding: 14px;
    }
    .meal-icon { font-size: 1.4rem; }
    .meal-label { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #1a4f3a; }

    /* ── Exchange table ── */
    #exchangeTab .section-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 12px rgba(0,0,0,.07); overflow: hidden;
    }
    .ex-header {
        background: linear-gradient(135deg, #1a4f3a, #2d7a56);
        color: #fff; padding: 16px 22px;
    }
    #exchangeTable thead th {
        background: #1a4f3a; color: #fff; font-size: .8rem;
        text-align: center; white-space: nowrap; padding: 10px 8px; border: none;
    }
    #exchangeTable tbody td { vertical-align: middle; padding: 8px 6px; font-size: .88rem; border-color: #e9ecef; }
    #exchangeTable tbody tr:hover { background: #f0faf4; }
    .ex-name { font-weight: 600; color: #1a4f3a; min-width: 130px; }
    .ex-no-input {
        width: 70px; text-align: center; font-weight: 700;
        border: 2px solid #b2dfdb; border-radius: 8px;
        padding: 4px 6px; font-size: .95rem;
        transition: border-color .2s;
    }
    .ex-no-input:focus { border-color: #1a4f3a; outline: none; box-shadow: 0 0 0 3px rgba(26,79,58,.15); }
    .calc-cell { color: #444; text-align: center; font-size: .87rem; }
    .total-row td { font-weight: 700; background: #e8f5e9 !important; font-size: .9rem; }
    .total-row .total-energy { color: #c62828; }
    .total-row .total-protein { color: #1565c0; }
    .total-row .total-carbs   { color: #e65100; }
    .total-row .total-fat     { color: #4a148c; }

    /* ── Live summary bar ── */
    .live-bar { background: #fff; border-radius: 12px; padding: 14px 20px; box-shadow: 0 2px 10px rgba(0,0,0,.08); }
    .live-bar .stat-badge {
        display: flex; flex-direction: column; align-items: center;
        background: #f0faf4; border-radius: 10px; padding: 10px 18px;
        min-width: 120px;
    }
    .live-bar .stat-label { font-size: .72rem; font-weight: 600; text-transform: uppercase; color: #888; }
    .live-bar .stat-val   { font-size: 1.3rem; font-weight: 700; color: #1a4f3a; }

    /* ── Save button ── */
    .btn-save {
        background: linear-gradient(135deg, #1a4f3a, #2d7a56);
        border: none; color: #fff; font-weight: 700;
        padding: 12px 32px; border-radius: 12px; font-size: 1rem;
        box-shadow: 0 4px 15px rgba(26,79,58,.35);
        transition: all .2s;
    }
    .btn-save:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(26,79,58,.45); color: #fff; }

    .form-select, .form-control { border-radius: 8px; border-color: #dee2e6; }
    .form-select:focus, .form-control:focus { border-color: #1a4f3a; box-shadow: 0 0 0 3px rgba(26,79,58,.12); }

    .btn-add-day { border: 2px dashed #1a4f3a; color: #1a4f3a; background: transparent; border-radius: 12px; padding: 12px; font-weight: 600; transition: all .2s; }
    .btn-add-day:hover { background: #1a4f3a; color: #fff; }

    @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:none; } }
    .day-box { animation: fadeIn .25s ease; }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">

    {{-- ── HEADER ── --}}
    <div class="diet-header mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2><i class="bi bi-clipboard2-heart-fill me-2"></i>Create Diet Plan</h2>
                <p>Design a personalised day-wise diet chart & food exchange plan for this client.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light fw-semibold">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button type="button" class="btn-save btn" id="saveDiet">
                    <i class="bi bi-floppy-fill me-1"></i> Save Diet Plan
                </button>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-3 fw-semibold shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.diet.store') }}" method="POST" id="dietForm">
        @csrf
        <input type="hidden" name="uuid" value="{{ $uuid }}">

        {{-- ── TABS ── --}}
        <ul class="nav diet-tabs mb-4" id="dietTabNav" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="tab-days" data-bs-toggle="tab" data-bs-target="#daysTab" type="button">
                    <i class="bi bi-calendar3 me-1"></i> Day-Wise Chart
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="tab-exchange" data-bs-toggle="tab" data-bs-target="#exchangeTab" type="button">
                    <i class="bi bi-bar-chart-steps me-1"></i> Food Plan (Exchange Groups)
                </button>
            </li>
        </ul>

        <div class="tab-content">

            {{-- ══════════════════════════════════════════
                 TAB 1 — Day-Wise Diet Chart
            ══════════════════════════════════════════ --}}
            <div class="tab-pane fade show active" id="daysTab">
                <div class="d-flex gap-2 mb-3 flex-wrap">
                    <button type="button" id="addDay" class="btn btn-outline-success fw-semibold rounded-3">
                        <i class="bi bi-plus-circle"></i> Add Day
                    </button>
                    <button type="button" id="autoFill" class="btn btn-outline-warning fw-semibold rounded-3">
                        <i class="bi bi-magic"></i> Auto-Fill 10 Days
                    </button>
                </div>

                <div id="daysContainer" class="d-flex flex-column gap-3"></div>

                {{-- Hidden Day Template --}}
                <div id="dayTemplate" class="day-box d-none">
                    <div class="day-header">
                        <span class="fw-bold fs-6"><i class="bi bi-sun"></i> Day <span class="day-label">1</span></span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <label class="mb-0 small fw-semibold opacity-75">Weekday:</label>
                                <select class="form-select form-select-sm weekday-select" data-name="days[0][weekday]" style="width:130px;">
                                    <option>Sunday</option><option>Monday</option><option>Tuesday</option>
                                    <option>Wednesday</option><option>Thursday</option><option>Friday</option><option>Saturday</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-light remove-day d-none rounded-pill px-3">
                                <i class="bi bi-trash3"></i> Remove
                            </button>
                        </div>
                    </div>
                    <div class="day-body">
                        <div class="row g-3">
                            @foreach([
                                ['key'=>'breakfast','icon'=>'☀️','label'=>'Breakfast','col'=>'breakfast'],
                                ['key'=>'lunch',    'icon'=>'🌤️','label'=>'Lunch',    'col'=>'lunch'],
                                ['key'=>'snacks',   'icon'=>'🍎','label'=>'Snacks',   'col'=>'snacks'],
                                ['key'=>'dinner',   'icon'=>'🌙','label'=>'Dinner',   'col'=>'dinner'],
                            ] as $meal)
                            <div class="col-md-6 col-xl-3">
                                <div class="meal-card h-100">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="meal-icon">{{ $meal['icon'] }}</span>
                                        <span class="meal-label">{{ $meal['label'] }}</span>
                                    </div>
                                    <div class="meal-div">
                                        <select class="form-select form-select-sm meal-select mb-2" data-name="days[0][{{ $meal['col'] }}]">
                                            <option value="">— Select Item —</option>
                                            @foreach($menus[$meal['col']] ?? [] as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                            <option value="__new">➕ Add New Item</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm meal-input d-none"
                                            placeholder="Type custom {{ $meal['label'] }}…">
                                    </div>
                                    <input type="number" min="0" step="0.1"
                                        class="form-control form-control-sm meal-weight mt-2"
                                        data-name="days[0][{{ $meal['col'] }}_weight]"
                                        placeholder="Weight (g) / Qty">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Add-Day button at bottom --}}
                <button type="button" id="addDayBottom" class="btn-add-day btn w-100 mt-3 py-3">
                    <i class="bi bi-plus-lg me-2"></i>Add Another Day
                </button>
            </div>

            {{-- ══════════════════════════════════════════
                 TAB 2 — Food Plan (Exchange Groups)
            ══════════════════════════════════════════ --}}
            <div class="tab-pane fade" id="exchangeTab">

                {{-- Live Summary Bar --}}
                <div class="live-bar d-flex flex-wrap gap-3 align-items-center mb-4">
                    <span class="fw-bold text-secondary small me-2">Live Totals:</span>
                    <div class="stat-badge">
                        <span class="stat-label">Energy</span>
                        <span class="stat-val" id="totalEnergy">0</span>
                        <small class="text-muted">kcal</small>
                    </div>
                    <div class="stat-badge">
                        <span class="stat-label">Protein</span>
                        <span class="stat-val" id="totalProtein">0</span>
                        <small class="text-muted">g</small>
                    </div>
                    <div class="stat-badge">
                        <span class="stat-label">Carbs</span>
                        <span class="stat-val" id="totalCarbs">0</span>
                        <small class="text-muted">g</small>
                    </div>
                    <div class="stat-badge">
                        <span class="stat-label">Fats</span>
                        <span class="stat-val" id="totalFats">0</span>
                        <small class="text-muted">g</small>
                    </div>
                </div>

                <div class="section-card">
                    <div class="ex-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold"><i class="bi bi-table me-2"></i>Food Exchange Plan</h5>
                            <small class="opacity-75">Enter the number of exchanges for each food group. Nutritional values are calculated automatically.</small>
                        </div>
                        <button type="button" id="addCustomExchange" class="btn btn-light btn-sm fw-semibold rounded-3">
                            <i class="bi bi-plus-circle me-1"></i>Add Custom Group
                        </button>
                    </div>
                    <div class="p-3 table-responsive">
                        <table class="table table-hover mb-0" id="exchangeTable">
                            <thead>
                                <tr>
                                    <th style="min-width:150px; text-align:left; padding-left:12px;">Exchange Group</th>
                                    <th>Exchange No.</th>
                                    <th>Amount (g)</th>
                                    <th>Energy (Kcal)</th>
                                    <th>Proteins (g)</th>
                                    <th>Carbs (g)</th>
                                    <th>Fats (g)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="exchangeBody">
                                @foreach($exchangeGroups as $i => $group)
                                <tr class="exchange-row" data-std-amount="{{ $group['std_amount'] }}" data-std-energy="{{ $group['std_energy'] }}" data-std-protein="{{ $group['std_protein'] }}" data-std-carbs="{{ $group['std_carbs'] }}" data-std-fat="{{ $group['std_fat'] }}">
                                    <td class="ex-name">
                                        {{ $group['name'] }}
                                        <input type="hidden" name="exchanges[{{ $i }}][name]" value="{{ $group['name'] }}">
                                        <input type="hidden" name="exchanges[{{ $i }}][std_amount]"  value="{{ $group['std_amount'] }}">
                                        <input type="hidden" name="exchanges[{{ $i }}][std_energy]"  value="{{ $group['std_energy'] }}">
                                        <input type="hidden" name="exchanges[{{ $i }}][std_protein]" value="{{ $group['std_protein'] }}">
                                        <input type="hidden" name="exchanges[{{ $i }}][std_carbs]"   value="{{ $group['std_carbs'] }}">
                                        <input type="hidden" name="exchanges[{{ $i }}][std_fat]"     value="{{ $group['std_fat'] }}">
                                    </td>
                                    <td class="text-center">
                                        <input type="number" min="0" step="0.5"
                                            class="ex-no-input"
                                            name="exchanges[{{ $i }}][exchange_no]"
                                            value="{{ $group['exchange_no'] }}"
                                            placeholder="0">
                                    </td>
                                    <td class="calc-cell amount-cell">0</td>
                                    <td class="calc-cell energy-cell">0</td>
                                    <td class="calc-cell protein-cell">0</td>
                                    <td class="calc-cell carbs-cell">0</td>
                                    <td class="calc-cell fat-cell">0</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td class="ps-3" colspan="2"><i class="bi bi-sigma me-1"></i>Total</td>
                                    <td class="text-center">—</td>
                                    <td class="text-center total-energy" id="footEnergy">0</td>
                                    <td class="text-center total-protein" id="footProtein">0</td>
                                    <td class="text-center total-carbs" id="footCarbs">0</td>
                                    <td class="text-center total-fat" id="footFat">0</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>{{-- end exchangeTab --}}
        </div>{{-- end tab-content --}}
    </form>
</div>
@endsection

@section('script')
<script type="module">
$(function() {

    /* ══════════════════════════════════════
       TAB 1 — Day-Wise Chart Logic
    ══════════════════════════════════════ */
    const weekdays = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
    const $template = $('#dayTemplate').clone().removeAttr('id').removeClass('d-none');

    function newDayElement(index, weekdayName = null, showRemove = true) {
        const $el = $template.clone();
        $el.find('.day-label').text(index + 1);
        $el.find('.remove-day').toggleClass('d-none', !showRemove);

        const $wd = $el.find('.weekday-select');
        $wd.attr('name', $wd.data('name').replace('0', index));
        if (weekdayName) $wd.val(weekdayName);

        $el.find('.meal-select').each(function() {
            const dname = $(this).data('name').replace('0', index);
            $(this).attr('name', dname).attr('data-original-name', dname);
        });
        $el.find('.meal-input').each(function() { $(this).removeAttr('name'); });
        $el.find('.meal-weight').each(function() {
            const dname = $(this).data('name').replace('0', index);
            $(this).attr('name', dname);
        });
        return $el;
    }

    function appendFirstDay() {
        $('#daysContainer').append(newDayElement(0, weekdays[0], false));
    }
    appendFirstDay();

    function addDay() {
        const cnt = $('#daysContainer .day-box').length;
        $('#daysContainer').append(newDayElement(cnt, weekdays[cnt % 7], true));
        // scroll to the new day
        $('html,body').animate({ scrollTop: $('#daysContainer .day-box').last().offset().top - 100 }, 300);
    }

    $('#addDay, #addDayBottom').on('click', addDay);

    $(document).on('click', '.remove-day', function() {
        $(this).closest('.day-box').fadeOut(200, function() {
            $(this).remove(); reindexDays();
        });
    });

    $(document).on('change', '.meal-select', function() {
        const $col = $(this).closest('.meal-div');
        const $input = $col.find('.meal-input');
        if ($(this).val() === '__new') {
            const orig = $(this).data('original-name');
            $(this).removeAttr('name');
            $input.attr('name', orig).removeClass('d-none').focus();
        } else {
            $(this).attr('name', $(this).data('original-name'));
            $input.removeAttr('name').addClass('d-none');
        }
    });

    $('#autoFill').on('click', function() {
        $('#daysContainer').empty();
        for (let i = 0; i < 10; i++) {
            $('#daysContainer').append(newDayElement(i, weekdays[i % 7], true));
        }
    });

    function reindexDays() {
        $('#daysContainer .day-box').each(function(idx) {
            $(this).find('.day-label').text(idx + 1);
            $(this).find('.weekday-select').attr('name', `days[${idx}][weekday]`);
            $(this).find('.meal-select').each(function() {
                const orig = $(this).data('original-name');
                if (!orig) return;
                const newName = orig.replace(/\[\d+\]/, `[${idx}]`);
                $(this).attr('data-original-name', newName);
                if ($(this).is('[name]')) $(this).attr('name', newName);
            });
            $(this).find('.meal-input').each(function() {
                if ($(this).is('[name]')) {
                    $(this).attr('name', $(this).attr('name').replace(/\[\d+\]/, `[${idx}]`));
                }
            });
            $(this).find('.meal-weight').each(function() {
                const dname = $(this).data('name').replace(/\[\d+\]/, `[${idx}]`);
                $(this).attr('name', dname);
            });
        });
    }

    /* ══════════════════════════════════════
       TAB 2 — Exchange Group Live Calc
    ══════════════════════════════════════ */
    function calcRow($row) {
        const exNo   = parseFloat($row.find('.ex-no-input').val()) || 0;
        const amount  = exNo * (parseFloat($row.data('std-amount'))  || 0);
        const energy  = exNo * (parseFloat($row.data('std-energy'))  || 0);
        const protein = exNo * (parseFloat($row.data('std-protein')) || 0);
        const carbs   = exNo * (parseFloat($row.data('std-carbs'))   || 0);
        const fat     = exNo * (parseFloat($row.data('std-fat'))     || 0);

        $row.find('.amount-cell').text(amount.toFixed(1));
        $row.find('.energy-cell').text(energy.toFixed(1));
        $row.find('.protein-cell').text(protein.toFixed(1));
        $row.find('.carbs-cell').text(carbs.toFixed(1));
        $row.find('.fat-cell').text(fat.toFixed(1));
    }

    function recalcTotals() {
        let totEnergy=0, totProtein=0, totCarbs=0, totFat=0;
        $('#exchangeBody .exchange-row').each(function() {
            totEnergy  += parseFloat($(this).find('.energy-cell').text())  || 0;
            totProtein += parseFloat($(this).find('.protein-cell').text()) || 0;
            totCarbs   += parseFloat($(this).find('.carbs-cell').text())   || 0;
            totFat     += parseFloat($(this).find('.fat-cell').text())     || 0;
        });
        $('#footEnergy').text(totEnergy.toFixed(1));
        $('#footProtein').text(totProtein.toFixed(1));
        $('#footCarbs').text(totCarbs.toFixed(1));
        $('#footFat').text(totFat.toFixed(1));
        // Live bar
        $('#totalEnergy').text(Math.round(totEnergy));
        $('#totalProtein').text(totProtein.toFixed(1));
        $('#totalCarbs').text(totCarbs.toFixed(1));
        $('#totalFats').text(totFat.toFixed(1));
    }

    // Init calc for pre-filled rows
    $('#exchangeBody .exchange-row').each(function() { calcRow($(this)); });
    recalcTotals();

    $(document).on('input change', '.ex-no-input', function() {
        calcRow($(this).closest('.exchange-row'));
        recalcTotals();
    });

    /* ── Add Custom Exchange Group ── */
    let customIdx = {{ count($exchangeGroups) }};
    $('#addCustomExchange').on('click', function() {
        const idx = customIdx++;
        const $row = $(`
        <tr class="exchange-row" data-std-amount="0" data-std-energy="0" data-std-protein="0" data-std-carbs="0" data-std-fat="0">
            <td>
                <input type="text" class="form-control form-control-sm custom-name" name="exchanges[${idx}][name]" placeholder="Group name…" style="min-width:130px;">
                <input type="hidden" name="exchanges[${idx}][std_amount]"  class="h-std-amount"  value="0">
                <input type="hidden" name="exchanges[${idx}][std_energy]"  class="h-std-energy"  value="0">
                <input type="hidden" name="exchanges[${idx}][std_protein]" class="h-std-protein" value="0">
                <input type="hidden" name="exchanges[${idx}][std_carbs]"   class="h-std-carbs"   value="0">
                <input type="hidden" name="exchanges[${idx}][std_fat]"     class="h-std-fat"     value="0">
            </td>
            <td class="text-center">
                <input type="number" min="0" step="0.5" class="ex-no-input" name="exchanges[${idx}][exchange_no]" value="0" placeholder="0">
            </td>
            <td><input type="number" min="0" step="0.1" class="form-control form-control-sm custom-std text-center" placeholder="Amt/ex" data-field="std_amount" style="width:70px;"></td>
            <td><input type="number" min="0" step="0.1" class="form-control form-control-sm custom-std text-center" placeholder="Kcal/ex" data-field="std_energy" style="width:70px;"></td>
            <td><input type="number" min="0" step="0.1" class="form-control form-control-sm custom-std text-center" placeholder="Prot/ex" data-field="std_protein" style="width:70px;"></td>
            <td><input type="number" min="0" step="0.1" class="form-control form-control-sm custom-std text-center" placeholder="Carbs/ex" data-field="std_carbs" style="width:70px;"></td>
            <td><input type="number" min="0" step="0.1" class="form-control form-control-sm custom-std text-center" placeholder="Fat/ex" data-field="std_fat" style="width:70px;"></td>
            <td><button type="button" class="btn btn-sm btn-outline-danger remove-exchange rounded-pill"><i class="bi bi-trash3"></i></button></td>
        </tr>`);
        $('#exchangeBody').append($row);
    });

    // Custom std fields update data- attributes and hidden inputs
    $(document).on('input', '.custom-std', function() {
        const $row = $(this).closest('.exchange-row');
        const field = $(this).data('field');
        const val = parseFloat($(this).val()) || 0;
        $row.attr(`data-${field.replace('_','-')}`, val);
        $row.find(`.h-${field.replace('_std_','std-').replace('_','-')}, input[name*="${field}"]`).last().val(val);
        calcRow($row); recalcTotals();
    });

    $(document).on('click', '.remove-exchange', function() {
        $(this).closest('tr').remove(); recalcTotals();
    });

    /* ── Save button ── */
    $('#saveDiet').on('click', function() { $('#dietForm').submit(); });
});
</script>
@endsection
