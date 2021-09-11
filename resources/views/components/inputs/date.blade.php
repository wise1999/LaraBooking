    <div wire:ignore>
        <div x-data="{value: @entangle($attributes->wire('model')), instance: undefined}" x-init="() => {
            $watch('value', value => {
                instance.clear()
                let bookingTotal = document.getElementById('price');
                bookingTotal.value = null;

                value.forEach(function (booking) {
                    if (booking.includes('to')) {
                        let rangeDate = booking.split(' to ')
                        let arrayVal = {
                            from: rangeDate[0],
                            to: rangeDate[1]
                        }
                        value.push(arrayVal)
                    } else {
                        value.push(booking)
                    }
                });
                return instance.set('disable', value)
            })
            instance = flatpickr($refs.input, {
                mode: 'range',
                minDate: 'today',
                dateFormat: 'Y-m-d',
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
