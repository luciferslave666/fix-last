@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-stone-300 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm transition-colors duration-200']) !!}>