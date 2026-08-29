<div
    x-data="{
        value: @entangle($attributes->wire('model')).live,

        format(value) {
            if (value === null || value === '') {
                return '';
            }

            return Number(value).toLocaleString('id-ID');
        },

        update(event) {
            let rawValue = event.target.value.replace(/\D/g, '');

            this.value = rawValue;
            event.target.value = this.format(rawValue);
        }
    }"
    x-init="
        $watch('value', value => {
            if (document.activeElement !== $refs.input) {
                $refs.input.value = format(value);
            }
        });

        $nextTick(() => {
            $refs.input.value = format(value);
        });
    "
>
    <flux:input
        x-ref="input"
        {{ $attributes->except(['wire:model']) }}
        x-on:input="update($event)"
    />
</div>