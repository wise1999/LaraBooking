<div wire:ignore>
    <div x-data="{value: @entangle($attributes->wire('model')), instance: undefined}" x-init="() => {
        let parsedData = JSON.parse(value)
        let parsedSelected  = parsedData.selected

        function initSelectedDate() {
            let parsedSelected  = parsedData.selected
            return parsedSelected
        }

        function initDisabledDates() {
            let parsedDisable  = parsedData.disable

            parsedDisable.forEach(function (booking) {
                if (booking.includes('to')) {
                    let rangeDate = booking.split(' to ')
                    let arrayVal = {
                        from: rangeDate[0],
                        to: rangeDate[1]
                    }
                    parsedDisable.push(arrayVal)
                } else {
                    parsedDisable.push(booking)
                }
            });
            return parsedDisable
        }

            $watch('value', value => {

                let parsedData = JSON.parse(value)
                let parsedSelected  = parsedData.selected
                let parsedDisable  = parsedData.disable

                parsedDisable.forEach(function (booking) {
                    if (booking.includes('to')) {
                        let rangeDate = booking.split(' to ')
                        let arrayVal = {
                            from: rangeDate[0],
                            to: rangeDate[1]
                        }
                        parsedDisable.push(arrayVal)
                    } else {
                        parsedDisable.push(booking)
                    }
                });
               instance.set('disable', parsedDisable)
               instance.setDate(parsedSelected, true)
            })

        instance = flatpickr($refs.input, {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'Y-m-d',
            defaultDate: initSelectedDate(),
            disable: initDisabledDates(),
            onChange: function(selectedDates, dateStr, instance) {
                let daysInRange = document.getElementsByClassName('inRange');
                let daysLengthTotal = daysInRange.length + 1;
                let facilityPrice = document.getElementById('facility_price').value;
                let bookingTotal = document.getElementById('price');
                let calculation = facilityPrice * daysLengthTotal
                bookingTotal.value = currency(calculation, { fromCents: true }).format();
            }
        });
    }">
        <input x-ref="input" type="text" name="date" class="w-full px-2 py-1 text-gray-700 bg-gray-200 rounded" />
    </div>
</div>



@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('js/currency/currency.min.js') }}"></script>
@endpush
