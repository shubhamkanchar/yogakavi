@extends('admin.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4">
                <h2 class="mb-4 fw-bold">Create Day-Wise Diet Plan</h2>
            </div>
            <div class="col-md-8 text-md-end">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Back</a>
                <button type="button" id="addDay" class="btn btn-primary ms-2">+ Add Day</button>
                <button type="button" id="autoFill" class="btn btn-warning ms-2">Auto-Fill 10 Days</button>
                <button type="button" class="btn btn-success ms-2" id="saveDiet">Save Diet Plan</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success fw-bold">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.diet.store') }}" method="POST" id="dietForm">
            @csrf

            <input type="hidden" name="uuid" value="{{request()->uuid}}">
            <!-- Buttons -->
            

            <div id="daysContainer"></div>

            {{-- Hidden template outside the container (cloned when needed) --}}
            <div id="dayTemplate" class="day-box border rounded p-3 mb-4 shadow-sm d-none">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-md-1">
                        <h5 class="fw-bold">Day <span class="day-label">1</span></h5>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Weekday</label>
                        <select class="form-select weekday-select" data-name="days[0][weekday]">
                            <option>Sunday</option>
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                        </select>
                    </div>
                    <div class="col-md-8 text-md-end">
                        <button type="button" class="btn btn-danger btn-sm remove-day d-none">Remove</button>
                    </div>
                </div>

                <div class="row mt-3 gx-3 gy-2">
                    <!-- Breakfast -->
                    <div class="meal-div col-md-4">
                        <label class="form-label">Breakfast</label>
                        <select class="form-select meal-select" data-name="days[0][breakfast]">
                            <option value="">Select Item</option>
                            @foreach ($menus['breakfast'] ?? [] as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                            <option value="__new">➕ Add New</option>
                        </select>
                        <input type="text" class="form-control mt-2 meal-input d-none"
                            placeholder="Enter new breakfast" />
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" min="0" class="form-control meal-weight"
                            data-name="days[0][breakfast_weight]" placeholder="grams">
                    </div>

                    <!-- Lunch -->
                    <div class="meal-div col-md-4">
                        <label class="form-label">Lunch</label>
                        <select class="form-select meal-select" data-name="days[0][lunch]">
                            <option value="">Select Item</option>
                            @foreach ($menus['lunch'] ?? [] as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                            <option value="__new">➕ Add New</option>
                        </select>
                        <input type="text" class="form-control mt-2 meal-input d-none" placeholder="Enter new lunch" />
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" min="0" class="form-control meal-weight"
                            data-name="days[0][lunch_weight]" placeholder="grams">
                    </div>

                    <!-- Snacks -->
                    <div class="meal-div col-md-4">
                        <label class="form-label">Snacks</label>
                        <select class="form-select meal-select" data-name="days[0][snacks]">
                            <option value="">Select Item</option>
                            @foreach ($menus['snacks'] ?? [] as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                            <option value="__new">➕ Add New</option>
                        </select>
                        <input type="text" class="form-control mt-2 meal-input d-none" placeholder="Enter new snacks" />
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" min="0" class="form-control meal-weight"
                            data-name="days[0][snacks_weight]" placeholder="grams">
                    </div>

                    <!-- Dinner -->
                    <div class="meal-div col-md-4">
                        <label class="form-label">Dinner</label>
                        <select class="form-select meal-select" data-name="days[0][dinner]">
                            <option value="">Select Item</option>
                            @foreach ($menus['dinner'] ?? [] as $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                            <option value="__new">➕ Add New</option>
                        </select>
                        <input type="text" class="form-control mt-2 meal-input d-none" placeholder="Enter new dinner" />
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Weight (g)</label>
                        <input type="number" min="0" class="form-control meal-weight"
                            data-name="days[0][dinner_weight]" placeholder="grams">
                    </div>

                </div>
            </div>

        </form>
    </div>
@endsection
@section('script')
    <script type="module">
        $(function() {

            const weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // clone template into a JS variable so we don't depend on DOM location
            const $template = $("#dayTemplate").clone().removeAttr('id').removeClass('d-none');

            // helper to generate unique day element with correct names
            function newDayElement(index, weekdayName = null, showRemove = true) {
                const $el = $template.clone();

                // set label
                $el.find('.day-label').text(index + 1);

                // remove button visibility
                if (showRemove) {
                    $el.find('.remove-day').removeClass('d-none');
                } else {
                    $el.find('.remove-day').addClass('d-none');
                }

                // set weekday select name and selected option
                const $weekdaySelect = $el.find('.weekday-select');
                const weekdayDataName = $weekdaySelect.data('name').replace('0', index);
                $weekdaySelect.attr('name', weekdayDataName);
                if (weekdayName) $weekdaySelect.val(weekdayName);

                // for each meal select, update names using data-name
                $el.find('.meal-select').each(function() {
                    const dname = $(this).data('name').replace('0', index);
                    $(this).attr('name', dname);
                    $(this).attr('data-original-name', dname); // store original
                });

                // meal input (custom text) - set name but hide initially
                $el.find('.meal-input').each(function(i) {
                    // find corresponding select's name to mirror
                    const select = $(this).closest('.meal-div').find('.meal-select');
                    const name = select.data('name').replace('0', index); // e.g. days[index][breakfast]
                    // note: we won't set name initially (unless user picks __new)
                    $(this).removeAttr('name');
                });

                // meal weights - set name using data-name
                $el.find('.meal-weight').each(function() {
                    const dname = $(this).data('name').replace('0', index);
                    $(this).attr('name', dname);
                });

                return $el;
            }

            // append first day by default
            function appendFirstDay() {
                const $first = newDayElement(0, weekdays[0], false); // no remove for first
                $("#daysContainer").append($first);
            }

            appendFirstDay();

            // add day button
            $("#addDay").on('click', function() {
                const currentCount = $("#daysContainer .day-box").length;
                const weekdayName = weekdays[currentCount % 7];
                const $new = newDayElement(currentCount, weekdayName, true);
                $("#daysContainer").append($new);
            });

            // remove day
            $(document).on('click', '.remove-day', function() {
                $(this).closest('.day-box').remove();
                // update labels and names to keep indexes contiguous
                reindexDays();
            });

            // handle meal-select change to show input for new item
            $(document).on('change', '.meal-select', function() {
                const $col = $(this).closest('.meal-div');
                const $input = $col.find('.meal-input');
                const selected = $(this).val();

                // restore name attributes when switching from new -> existing
                if (selected === '__new') {
                    // transfer name from select to input
                    const originalName = $(this).data('original-name');
                    $(this).removeAttr('name');
                    $input.attr('name', originalName).removeClass('d-none');
                    $input.focus();
                } else {
                    // if switching back to existing option
                    const originalName = $(this).data('original-name');
                    $(this).attr('name', originalName);
                    $input.removeAttr('name').addClass('d-none');
                }
            });

            // Auto-fill 15 days (keeps weekdays cycling)
            $("#autoFill").on('click', function() {
                $("#daysContainer").empty();
                for (let i = 0; i < 10; i++) {
                    const weekdayName = weekdays[i % 7];
                    const $new = newDayElement(i, weekdayName, true);
                    $("#daysContainer").append($new);
                }
            });

            // Reindex when days removed to ensure form names are sequential: days[0], days[1], ...
            function reindexDays() {
                $("#daysContainer .day-box").each(function(idx) {
                    $(this).find('.day-label').text(idx + 1);

                    // weekday select
                    const $weekday = $(this).find('.weekday-select');
                    const wname = $weekday.attr('name').replace(/\[\d+\]/, '[' + idx + ']');
                    $weekday.attr('name', wname);

                    // meal selects
                    $(this).find('.meal-select').each(function() {
                        const original = $(this).data(
                            'original-name'); // days[0][breakfast] pattern
                        if (original) {
                            const newName = original.replace(/\[\d+\]/, '[' + idx + ']');
                            // if currently not used (because custom input holds name), update data-original-name
                            $(this).attr('data-original-name', newName);
                            // if select visible (not removed name), update name
                            if (!$(this).is('[name]')) {
                                // select currently has no name (custom input is active). do nothing
                            } else {
                                $(this).attr('name', newName);
                            }
                        }
                    });

                    // meal inputs (custom typed)
                    $(this).find('.meal-input').each(function() {
                        // if input currently has a name, update it to new index
                        if ($(this).is('[name]')) {
                            const n = $(this).attr('name').replace(/\[\d+\]/, '[' + idx + ']');
                            $(this).attr('name', n);
                        }
                    });

                    // weights
                    $(this).find('.meal-weight').each(function() {
                        const dname = $(this).data('name'); // e.g. days[0][breakfast_weight]
                        const newName = dname.replace(/\[\d+\]/, '[' + idx + ']');
                        $(this).attr('name', newName);
                    });
                });
            }

            $(document).on('click','#saveDiet',function(){
                $('#dietForm').submit();
            })
        });
    </script>
@endsection
